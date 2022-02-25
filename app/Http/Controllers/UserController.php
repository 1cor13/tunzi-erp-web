<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Permission;
use App\Models\Country;
use App\Models\Message;
use App\Models\Company;
use App\Models\Gender;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Mail;
use Auth;

class UserController extends Controller
{
    /**
     * Display the constructor of the resource.
     *
     * @return Response
     */
    public function __construct()
    {
        $this->middleware('role:super-admin|admin')->except('update','changePassword','show');
        $this->middleware('permission:create_user',['only'=>['create','store']]);
        $this->middleware('permission:delete_user',['only'=>'destroy']);
        $this->middleware('permission:edit_user',['only'=>['update','edit']]);
    }

    /**
     * Change the password of the current user.
     *
     * @return Response
     */
    public function changePassword(Request $request)
    {
        request()->validate([
            'id'                =>  'required',
            'previous_password' =>  ['required', 'string'],
            'password'          =>  ['required', 'string', 'min:8'],
        ]);

        $user = User::find($request->id);

        if ($request->id != Auth::user()->id) {
            return redirect()->route('profile',compact(['user']))->with('danger','C\'mon you cannot do that, it is illegal! Account might get blocked');
        }else {
            if ($request->confirm_password != $request->password) {
                return redirect()->route('profile',compact(['user']))->with('info','Your newly created passwords do not match!!!');
            }
            else{
                if (Hash::check($request->previous_password, Auth::user()->password)) {
                    $user = User::find($request->id);
                    $user->password = Hash::make($request->password);
                    $user->save();

                    return redirect()->back()->with('success','Your password has beeen updated successfully!');
                }
                else{
                    return redirect()->back()->with('danger','Your old password does not match our records!');
                }
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeRole(Request $request, $id)
    {
        request()->validate([
            'id'    => 'required'
        ]);

        $user = User::findOrFail($id);

        if($user) {
             DB::table('role_user')->where('user_id',$id)->delete();
             DB::table('permission_user')->where('user_id',$id)->delete();

            foreach ($request->roles as $role) {
                $user->attachRole(Role::where('id',$role)->first());
            }
            if($request->permissions) {
                foreach ($request->permissions as $perms) {
                    $user->attachPermission(Permission::where('id',$perms)->first());
                }
            }
        }
        return back()->with('success', 'User roles and permissions updated successfully');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {
        $data->roles = Role::latest()->get();
        $data->genders = Gender::latest()->get();
        $data->countries = Country::latest()->get();
        $data->companies = Company::latest()->get();
        $data->permissions = Permission::latest()->get();

        if ($data->view == 'trashed') {
            $data->users = User::with(['roles', 'user_gender', 'country'])->onlyTrashed()->latest()->get();
        }
        elseif ($data->view == 'with-trashed') {
            $data->users = User::with(['roles', 'user_gender', 'country'])->withTrashed()->latest()->get();
        }
        else {
            $data->users = User::with(['roles', 'user_gender', 'country'])->latest()->get();
        }
        return view('admin.users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        // if ( !Auth::user()->hasPermission('create_user') ) {
        //     return back()->with('danger', 'Sorry you do not have permission to creare a user');
        // }

        // $data = new Request();
        // $data->gender = Gender::latest()->get();
        // $data->country = Country::latest()->get();
        // $data->roles = Role::latest()->get();
        // $data->roles = Role::all();
        // $data->genders = Gender::all();
        // $data->countries = Country::all();

        return view('admin.users.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ( !Auth::user()->hasPermission('create_user') ) {
            return back()->with('danger', 'Sorry you do not have permission to create a user');
        }

        request()->validate([
            'name'      => 'required',
            'email'     => 'required|unique:users',
            'password'  => 'required|min:6',
            'role'      => 'required',
        ]);

        $oldUser = User::where('username', $request->username)->first();
        if ($oldUser && $request->username) {
            return back()->with('danger', 'operation failed, there is a user with the same username. Please chose another.');
        }

        $user = User::create($request->except('receive_messages','account_auth','email_notifications','role'));
        $user->attachRole(Role::where('name', ($request->role ?? 'client'))->first());

        $user->receive_messages = $request->receive_messages ? true : false;
        $user->account_auth = $request->account_auth ? true : false;
        $user->email_notifications = $request->email_notifications ? true : false;
        $user->save();

        // Mail::to($request->email)->send(new RegisterUser($user->name, $user->account_no, $user->email, $user->api_token));

        return back()->with('success', 'User Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('users.index')->with('danger', 'User Not Found!');
        }

        $data = new Request();
        $data->updated = $user->updated_at->toDayDateTimeString();
        $data->gender = Gender::latest()->get();
        $data->country = Country::latest()->get();

        return view('admin.users.show', compact(['user','data']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if ( !Auth::user()->hasPermission('edit_user') ) {
        //     return back()->with('danger', 'Sorry you do not have permission to edit a user from ' . config('app.name'));
        // }

        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users.index')->with('danger', 'User Not Found!');
        }
        
        $data = new Request();
        $data->updated = $user->updated_at->toDayDateTimeString();
        $data->gender = Gender::latest()->get();
        $data->country = Country::latest()->get();
        $data->roles = Role::latest()->get();

        return view('admin.users.edit', compact(['user']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'      =>  'required',
            'email'     =>  'required',
            'phone'     =>  'required'
        ]);

        $user  = User::find($id);
        $user->name     = $request->get('name');
        $user->email    = $request->get('email');

        $user->phone    = $request->phone;
        $user->bio      = $request->bio;
        $user->api_token   = $request->api_token;
        $user->gender_id   = $request->gender_id;
        $user->account_no     = $request->account_no;
        $user->country_id = $request->country_id;
        $user->date_of_birth    = $request->date_of_birth;
        $user->occupation = $request->occupation;
        $user->receive_messages = $request->receive_messages ? true : false;
        $user->account_auth = $request->account_auth ? true : false;
        $user->email_notifications = $request->email_notifications ? true : false;
        $user->facebook_link  = $request->facebook_link;
        $user->twitter_link  = $request->twitter_link;
        $user->linkedin_link    = $request->linkedin_link;
        $user->status   = $request->status;
        $user->save();

        return redirect()->back()->with('success','User profile updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ( !Auth::user()->hasPermission('delete_user') ) {
            return back()->with('danger', 'Sorry you do not have permission to delete a user from ' . config('app.name'));
        }

        $user = User::where('id', $id)->withTrashed()->first();

        DB::table('role_user')->where('user_id',$id)->delete();
        DB::table('messages')->where('sender_id',$id)->delete();
        DB::table('messages')->where('receiver_id',$id)->delete();

        if ($user->trashed()) {
            $user->forceDelete();
        }
        else {
            $user->delete();
        }

        return redirect()->route('users.index')->with('success', 'User profile deleted successfully');
    }
}

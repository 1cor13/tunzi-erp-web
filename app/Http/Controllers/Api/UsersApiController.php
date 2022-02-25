<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\UserResourceCollection;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Country;
use App\Models\District;
use App\Models\Role;
use App\Models\User;
use Auth;

class UsersApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->user()){
            if(!$request->user()->hasPermission('create_user')) {
                return response()->json([
                    'error'  => 'Restricted Access'
                ], Response::HTTP_FORBIDDEN)->header('Content-Type', 'application/json');
            }

            if (sizeof(User::all()) < 1) {
                return response()->json([
                    'error' => 'No user found yet'
                ], Response::HTTP_NOT_FOUND);
            }
            return UserResourceCollection::collection(User::latest()->paginate(30));
        }
        return response()->json([ 'error' => 'Unauthenticated' ], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User();

        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone    = $request->phone;

        $user->source   = $request->source;
        $user->bio      = $request->bio;
        $user->occupation   = $request->occupation;
        $user->username     = $request->username;
        $user->nationality_id = $request->nationality ?? 1;
        $user->gender_id    = 1;
        $user->date_of_birth = null;                  // birthday
        $user->linkedin_link = $request->linkedin_link;
        $user->facebook_link = $request->facebook;
        $user->twitter_link = $request->twitter;
        $user->instagram_link = $request->instagram_link;
        $user->whatsapp_link = $request->whatsapp_link;
        $user->status   = 'active';
        $user->save();

        $user->attachRole(Role::where('name', $request->role)->first());

        // Mail::to($user->email)
        //     ->send(new RegisterUser($user->name, $user->account_no, $user->email));

        Company::create([
            'user_id'           => $user->id;
            'company_name'      => $request->co_name ?? (explode(' ', $request->name)[0]) .'\'s',
            'company_email'     => $request->co_email ?? $request->email,
            'company_phone'     => $request->co_phone,
            'company_description' => $request->description,
            'user_id'           => $user->id,
            'country_id'       => Country::where('country_name', 'Uganda')->first()->id,
            'district_id'       => District::where('district_name', 'Kampala')->first()->id,
            'reg_status'        => 'pending',
        ]);

        return response()->json([
            'message' => 'User account and profile created successfully!',
            'data'  => new UserResource($user)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if($request->user()){
            $user = User::find($id);

            if (!$user) {
                return response()->json([
                    'error' => 'User not found!!'
                ], Response::HTTP_NOT_FOUND);
            }

            return new UserResource($user);
        }
        return response()->json([ 'error' => 'Unauthenticated' ], Response::HTTP_UNAUTHORIZED);
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
        if(!$this->gotUser->hasPermission('edit_own_profile') || !$this->gotUser->hasPermission('edit_user')) {
            return response()->json([
                'error'  => 'Restricted Access'
            ], Response::HTTP_FORBIDDEN)->header('Content-Type', 'application/json');
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'error' => 'User not found!'
            ], Response::HTTP_NOT_FOUND);
        }

        $user->update($request->all());

        return response()->json([
            'data' => new UserResource($user)
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if(!$this->gotUser->hasPermission('delete_user')) {
            return response()->json([
                'error'  => 'Restricted Access'
            ], Response::HTTP_FORBIDDEN)->header('Content-Type', 'application/json');
        }

        $user = User::find($id);
        
        if (!$user) {
            return response()->json([
                'error' => 'User account not found!'
            ], Response::HTTP_NOT_FOUND);
        }

        $user->delete();
        
        return response()->json(
            ['message' => 'User account deleted successfully.'],
            Response::HTTP_PARTIAL_CONTENT
        );
    }
}

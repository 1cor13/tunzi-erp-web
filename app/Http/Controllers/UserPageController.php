<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\CompanyUser;
use App\Models\Message;
use App\Models\Gallery;
use App\Models\Image;
use App\Models\Gender;
use App\Models\Company;
use App\Models\Language;
use App\Models\Country;
use App\Models\Village;
use App\Models\Currency;
use App\Models\User;
use App\Models\Role;
use File;

class UserPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.companystatus',['only'=>'test']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function profile()
    {
        $user = Auth::user();
        return view('user.settings.profile', compact(['user']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function update_image(Request $request)
    {
        request()->validate([
            'profile_image' => 'required'
        ]);

        if ($user_image = $request->file('profile_image')) {
            $oldUser = Auth::user();
            $filename = time() . '.' . $user_image->getClientOriginalName();
            $user_image->move( 'files/uploads/images/profiles/', $filename );
            $user = Auth::user();

            if (!$user->gallery_id) {
                $gallery = Gallery::create([
                    'user_id'  => $user->id,
                    'gallery_name'  => 'User profile images',
                    'status'  => 'active'
                ]);

                Image::create([
                    'user_id'   => $user->id,
                    'gallery_id' => $gallery->id,
                    'image_name' => $filename,
                    'image_path' => 'files/uploads/images/profiles/'. $filename,
                    'ft_position' => 1
                ]);
                $user->gallery_id = $gallery->id;
            }
            else{
                Image::create([
                    'user_id'   => $user->id,
                    'gallery_id'=> $user->gallery_id,
                    'image_name' => $filename,
                    'image_path' => 'files/uploads/images/profiles/'. $filename,
                    'ft_position' => sizeof($user->user_gallery->images) + 1
                ]);
            }

            $user->image_path = $filename;
            $user->save();
        }

        return back()->with('success','Your profile picture has been updated!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function registerCompany(Request $data){
        if ($data->expectsJson() || $data->is('api/*')) {
            return response()->json([
                'error'  => 'Your profile is not complete',
                'messgae'=> 'Please complete final registration with company to proceed'
            ], Response::HTTP_UNAUTHORIZED)->header('Content-Type', 'application/json');
        } else {
            $data->companies = Company::latest()->get();
            $data->countries = Country::latest()->get();
            $data->currencies   = Currency::latest()->get();
            $data->languageList = Language::latest()->get();
            $data->villageList  = Village::latest()->get();
            $data->genders  = Gender::latest()->get();
            $data->title = 'Register your business or join your team';
            $data->description = 'Thank you for joining ' 
                . config('app.name') 
                . ', and verifying your account. Its time for the final section to go!';
            return view('company', compact('data'))->with('info', 'Please complete final registration with company to proceed');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeUserCompany(Request $request)
    {
        $request->validate([
            'user_id'   => 'required',
        ]);

        if( $request->type ) {
            $oldCompany = Company::where('email', $request->company_email)->first();

            if ($oldCompany) {
                return back()->with('danger', 'There is an already existing company with the same email provided');
            }

            $otherLangs = '';
            if ($request->other_languages) {
                foreach($request->other_languages as $k => $lang) {
                    $otherLangs .= $lang . (++$k != sizeof($request->other_languages) ? ',' : '');
                }
            }
            if (!$request->company_name) {
                return back()->with('danger', 'The company name is missing, since you\'re creating a new one!');
            }
            elseif (!$request->company_email) {
                return back()->with('danger', 'The company email is missing, since you\'re creating a new one!');
            }
            $company = Company::create([
                'user_id'   => $request->user_id,
                'name'      => $request->company_name,
                'email'      => $request->company_email,
                'phone'      => $request->company_phone,
                'tax_number'    => $request->companyTin,
                'language_id'   => $request->language,
                'other_languages'   => $otherLangs,
                'country_id'    => $request->country_id,
                'address'      => $request->companyAddress,
            ]);

            CompanyUser::create([
                'user_id'   => Auth::user()->id,
                'company_id'=> $company->id,
                'role'      => 'Owner',
                'code'      => $this->getRandCode(),
                'status'    => 'verified'
            ]);

            $user = User::findOrFail(Auth::user()->id);
            $user->name = $request->user_name;
            $user->phone = $request->user_phone;
            $user->occupation = $request->user_occupation;
            $user->gender_id = $request->gender_id;
            $user->country_id = $request->country_id;
            $user->date_of_birth = $request->date_of_birth;
            $user->status = $request->user_status;
            $user->account_no = $request->user_code;
            $user->prefix = $request->prefix;
            $user->save();

            $user->attachRole(Role::where('name','company_admin')->first());
            return redirect()->route('home')->with('success', 'Hello '. Auth::user()->name .', your account is fully set up and your company profile is ready!');
        }

        if( empty($request->user_code) ) {
            return back()->with('danger', 'Your request / invitation code is missing');
        }
        elseif( empty($request->user_id) ) {
            return back()->with('danger', 'User requester is not defined');
        }
        elseif( empty($request->company_id) ) {
            return back()->with('danger', 'Company not specified');
        }

        $previousReq = CompanyUser::where('code', $request->user_code)->first();

        if(empty($previousReq)){
            return back()->with('warning', 'The was no such invitation with that code, please contact your administrator for assistance');
        }

        if($previousReq->user_id != $request->user_id || $previousReq->company_id != $request->company_id){
            return back()->with('warning', 'The invitation to that company seems alteres with. Please contact your administrator to rectif this');
        }

        $previousReq->status = 'verified';
        $previousReq->save();

        $user = User::findOrFail(Auth::user()->id);
        $user->name = $request->user_name;
        $user->phone = $request->user_phone;
        $user->occupation = $request->user_occupation;
        $user->gender_id = $request->gender_id;
        $user->country_id = $request->country_id;
        $user->date_of_birth = $request->date_of_birth;
        $user->status = $request->user_status;
        $user->account_no = $request->user_code;
        $user->prefix = $request->prefix;
        $user->save();

        return redirect()->route('home')->with('success', 'Hello '. Auth::user()->name .', your account is fully fuctional!');

        // return [
        //     'user_id'   => $request->user_id,
        //     'company_id'=> $request->company_id,
        //     'code' => $request->user_code,
        //     'name'      => $request->user_name,
        //     'email'     => $request->user_email,
        //     'gender_id' => $request->gender_id,
        //     'phone'     => $request->user_phone,
        //     'occupation'   => $request->user_occupation,
        //     'address'   => $request->user,
        //     'date_of_birth' => $request->user_dob,
        //     'status'    => $request->user_status,
        // ];
    }

    private function getRandCode() {
        $new = mt_rand(10000,99999);
        if (CompanyUser::where('code', $new)->first()) {
            return $this->getRandCode();
        }
        return $new;
    }

    /*----------  -------------- ----------  -------------- |*| ----------  -------------- ----------  --------------*/

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function inventory(Request $data)
    {
        $data->appName = Auth::user()->userCompanies() ? Auth::user()->userCompanies()[0]->name : config('app.name');
        return view('system.companies.inventories.index', compact(['data']));
    }
}

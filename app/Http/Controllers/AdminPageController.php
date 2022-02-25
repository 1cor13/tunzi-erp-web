<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Insurance;
use App\Models\Partner;
use App\Models\Role;
use App\Models\Company;
use App\Models\User;

class AdminPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin_data = new Request;
        $admin_data->userscount     = User::all()->count();
        $admin_data->companycount    = Company::all()->count();
        $admin_data->partnerscount  = Partner::all()->count();
        $admin_data->insurancescount    = Insurance::all()->count();

        $admin_data->users  = User::with('roles')->latest()->take(10)->get();
        $admin_data->roles  = Role::latest()->take(10)->get();
        $admin_data->companies    = Company::with('users')->latest()->take(10)->get();
        $admin_data->partners   = Partner::latest()->take(10)->get();
        $admin_data->insurances = Insurance::latest()->take(10)->get();

        $admin_data->perm_count = array();
        $admin_data->user_count = array();

        foreach ($admin_data->roles as $rol) {
            $admin_data->perm_count[] = DB::table('permission_role')->where('role_id', $rol->id)->count();
            $admin_data->user_count[] = DB::table('role_user')->where('role_id', $rol->id)->count();
        }

        return view('admin.index', compact(['admin_data']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request) {

        request()->validate([
            'item_id'      => 'required',
            'item_section' => 'required'

        ]);

        if ($request->item_section == 'companies') {
            $company = Company::where('id', $request->item_id)->withTrashed()->first();
            if (!$company) { return back()->with('danger', 'Company profile not found it is either missing or deleted'); }
            $company->restore();
        }
        elseif ($request->item_section == 'users') {
            $item = User::where('id', $request->item_id)->withTrashed()->first();
            if (!$item) { return back()->with('danger', 'User profile not found it is either missing or deleted'); }
            $item->restore();
        }

        return back()->with('success', 'Item restored from trash successfully');
    }
}

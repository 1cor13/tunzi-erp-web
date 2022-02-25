<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display the constructor of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('role:super-admin|admin');
        $this->middleware('permission:create_role',['only'=>'create','store']);
        $this->middleware('permission:delete_role',['only'=>'destroy']);
        $this->middleware('permission:edit_role',['only'=>['update','edit']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::latest()->get();
        $admin_data = new Request;
        $admin_data->permissions = Permission::all();

        $admin_data->perm_count = array();
        $admin_data->user_count = array();

        foreach ($roles as $rol) {
            $admin_data->perm_count[] = DB::table('permission_role')->where('role_id', $rol->id)->count();
            $admin_data->user_count[] = DB::table('role_user')->where('role_id', $rol->id)->count();
        }

        return view('admin.roles.index', compact(['roles','admin_data']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::latest()->get();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name'          => 'required',
            'permission'    => 'required',
        ]);
        $role = Role::create($request->except(['permission','_token']));

        foreach ($request->permission as $key => $value) {
            $role->attachPermission($value);
        }

        return redirect()->route('roles.index')->with('success','User role added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        if (!$role) {
            return redirect()->route('roles.index')->with('danger', 'User role not found!');
        }
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        if (!$role) {
            return redirect()->route('roles.index')->with('danger', 'User role not found!');
        }
        $permissions = Permission::all();

        $permission_role = $role->permissions()->pluck('id','id')->toArray();
        $roles = Role::latest()->get();

        return view('admin.roles.edit', compact(['role','permissions','permission_role','roles']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'name'      =>  'required',
            'permission'=>  'required',
        ]);

        $role               = Role::find($id);
        $role->name         = $request->name;
        $role->display_name = $request->display_name;
        $role->description  = $request->description;
        $role->save();

        DB::table('permission_role')->where('role_id',$id)->delete();

        foreach ($request->permission as $key => $value) {
            $role->attachPermission($value);
        }

        return redirect()->route('roles.index')->with('success','Role Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);

        $role->delete();
        
        DB::table('permission_role')->where('role_id',$id)->delete();
        // DB::table('permission_role')->where('role_id',$id)->delete();
        return redirect()->route('roles.index')->with('danger', 'User Role Deleted Successfully');
    }
}

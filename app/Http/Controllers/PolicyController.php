<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Illuminate\Http\Request;
use App\Models\Department;

class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {
        $data->departments = Department::latest()->get();

        if ($data->view_type == 'trashed') {
            $data->policies = Policy::onlyTrashed()->latest()->get();
        }
        elseif ($data->view_type == 'with-trashed') {
            $data->policies = Policy::withTrashed()->latest()->get();
        }
        else {
            $data->policies = Policy::latest()->get();
        }
        return view('system.companies.policies.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.policies.create', compact('data'));
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
            'policy_name' => 'required|max:255',
            'department_id' => 'required',
            'policy_description' => 'required',
            'image'  => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);        

        $path = $request->file('image')->store('public/images');

        $policy = new Policy; 

        $policy->policy_name = $request->get('policy_name');
        $policy->department_id = $request->get('department_id');
        $policy->policy_description = $request->get('policy_description');
        $policy->image = $path;
        $policy->save();    

        return back()->with('success', 'Policy Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.policies.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $policy = Policy::find($id);
        return view('system.companies.policies.edit', compact('policy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'policy_name' => 'required|max:255',
            'department_id' => 'required',
            'policy_description' => 'required',
        ]);        

        $policy = Policy::find($id);

        if($request->hasFile('image')){
            $request->validate([
              'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            $path = $request->file('image')->store('public/images');
            $policy->image = $path;
        }

        $policy->policy_name = $request->get('policy_name');
        $policy->department_id = $request->get('department_id');
        $policy->policy_description = $request->get('policy_description');
        $policy->save();    

        return back()->with('success', 'Policy updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $policy = Policy::find($id);
        $policy->delete();        

        return back()->with('success', 'Policy Deleted!');
    }
}

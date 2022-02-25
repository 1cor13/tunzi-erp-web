<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Employee;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {   
        $data->departments = Department::latest()->get();

        return view('system.companies.employment.departments.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.employment.departments.create', compact('data'));
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
            'department_name' => 'required|max:255',
            'description' => 'required',
        ]);        

        Department::create($request->all());    

        return back()->with('success', 'Department created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.employment.departments.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dep = Department::find($id);
        return view('system.companies.employment.departments.edit', compact('dep'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'department_name' => 'required',
            'description' => 'required',
        ]);        

        $dep = Department::find($id);

        // Department::update($request->all());
        $dep->department_name = $request->get('department_name');
        $dep->save();    

        return back()->with('success', 'Department updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dep = Department::find($id);
        $dep->delete();        

        return back()->with('success', 'Department Deleted!');
    }
}

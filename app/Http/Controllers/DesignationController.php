<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {   
        $data->employees = Employee::latest()->get();
        $data->departments = Department::latest()->get();

        $data->designations = Designation::onlyTrashed()->latest()->get();
        
        return view('system.companies.employment.designations.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.employment.designations.create', compact('data'));
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
            'designation_name' => 'required|max:255',
            'department_id' => 'required',
            'description' => 'required',
        ]);        

        Designation::create($request->all());    

        return back()->with('success', 'Designation Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.employment.designations.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $des = Designation::find($id);
        return view('system.companies.employment.designations.edit', compact('des'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'designation_name'=>'required',
            'department_id'=>'required',
            'description' => 'required',
        ]);        

        $des = Designation::find($id);

        $des->designation_name = $request->get('designation_name');
        $des->department_id = $request->get('department_id');
        $des->save();    

        return back()->with('success', 'Designation updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $des = Designation::find($id);
        $des->delete();        

        return back()->with('success', 'Designation Deleted!');
    }
}

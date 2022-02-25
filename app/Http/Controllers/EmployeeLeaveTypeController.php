<?php

namespace App\Http\Controllers;

use App\Models\EmployeeLeaveType;
use Illuminate\Http\Request;

class EmployeeLeaveTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {
        $data->letypes = EmployeeLeaveType::latest()->get();

        return view('system.companies.employment.leavetypes.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.employment.leavetypes.create', compact('data'));
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
            'leave_type_name' => 'required',
            'number_of_days' => 'required',
        ]);        

        EmployeeLeaveType::create($request->all());    

        return back()->with('success', 'EmployeeLeaveType created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeeLeaveType  $employeeLeaveType
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.employment.leavetypes.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeeLeaveType  $employeeLeaveType
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeLeaveType $employeeLeaveType)
    {
        $letype = EmployeeLeaveType::find($id);
        return view('system.companies.employment.leavetypes.edit', compact('letype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeeLeaveType  $employeeLeaveType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'leave_type_name' => 'required',
            'number_of_days' => 'required',
        ]);

        $letype = EmployeeLeaveType::find($id);

        $letype->leave_type_name = $request->get('leave_type_name');
        $letype->number_of_days = $request->get('number_of_days');
        $letype->save();    

        return back()->with('success', 'EmployeeLeaveType updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeLeaveType  $employeeLeaveType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $letype = EmployeeLeaveType::find($id);
        $letype->delete();        

        return back()->with('success', 'EmployeeLeaveType Deleted!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Company;
use App\Models\User;

use App\Models\EmployeeHoliday;
use App\Models\Customer;
use App\Models\Project;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {   
        $data->departments = Department::latest()->get();
        $data->designations = Designation::latest()->get();
        $data->companies = Company::latest()->get();
        $data->users = User::latest()->get();
        $data->holidays = EmployeeHoliday::latest()->get();
        $data->customers = Customer::latest()->get();
        $data->projects = Project::latest()->get();

        $data->employees = Employee::onlyTrashed()->latest()->get();

        return view('system.companies.employment.employees.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.employment.employees.create', compact('data'));
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
            'first_name'=>'required',
            'last_name'=>'required',
            'username'=>'required',
            'email'     => 'required|unique:employees',
            'password'  => 'required|min:6',
            'joining_date'=>'required',
            'employee_phone'=>'required',
            'department_id'=>'required',
            'designation_id'=>'required',
        ]);        

        Employee::create($request->all());    

        return back()->with('success', 'Employee Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.employment.employees.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $emp = Employee::find($id);
        return view('system.companies.employment.employees.edit', compact('emp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'username'=>'required',
            'email'     => 'required|unique:employees',
            'password'  => 'required|min:6',
            'joining_date'=>'required',
            'employee_phone'=>'required',
            'department_id'=>'required',
            'designation_id'=>'required',
        ]);          

        $emp = Employee::find($id);

        // Employee::update($request->all()); 
        $emp->first_name = $request->get('first_name');
        $emp->last_name = $request->get('last_name');
        $emp->username = $request->get('username');
        $emp->email = $request->get('email');
        $emp->password = $request->get('password');
        $emp->confirm_password = $request->get('confirm_password');
        $emp->joining_date = $request->get('joining_date');
        $emp->employee_phone = $request->get('employee_phone');
        $emp->department_id = $request->get('department_id');
        $emp->designation_id = $request->get('designation_id');
        $emp->save();   

        return back()->with('success', 'Employee updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $emp = Employee::find($id);
        $emp->delete();        

        return back()->with('success', 'Employee Deleted!');
    }
}

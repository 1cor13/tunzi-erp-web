<?php

namespace App\Http\Controllers;

use App\Models\EmployeeLeave;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeeLeaveType;
use App\Models\User;

class EmployeeLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {
        $data->letypes = EmployeeLeaveType::latest()->get();
        $data->users = User::latest()->get();
        $data->employees = Employee::latest()->get();

        if ($data->view_type == 'trashed') {
            $data->employees = Employee::onlyTrashed()->latest()->get();
        }
        elseif ($data->view_type == 'with-trashed') {
            $data->leaves = EmployeeLeave::withTrashed()->latest()->get();
        }
        else {
            $data->leaves = EmployeeLeave::latest()->get();
        }
        return view('system.companies.employment.leaves.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.employment.leaves.create', compact('data'));
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
            'employee_leave_type_id'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'number_of_days'     => 'required',
            'remaining_leaves'  => 'required',
            'leave_reason'=>'required',
            'user_id'=>'required',
            'status'=>'required',
        ]);        

        EmployeeLeave::create($request->all());    

        return back()->with('success', 'EmployeeLeave Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeeLeave  $employeeLeave
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.employment.leaves.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeeLeave  $employeeLeave
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $leave = EmployeeLeave::find($id);
        return view('system.companies.employment.leaves.edit', compact('leave'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeeLeave  $employeeLeave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'employee_leave_type_id'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'number_of_days'     => 'required',
            'remaining_leaves'  => 'required',
            'leave_reason'=>'required',
            'user_id'=>'required',
            'status'=>'required',
        ]); 

        $leave = EmployeeLeave::find($id);

        // Designation::update($request->all());
        $leave->employee_leave_type_id = $request->get('employee_leave_type_id');
        $leave->start_date = $request->get('start_date');
        $leave->end_date = $request->get('end_date');
        $leave->number_of_days = $request->get('number_of_days');
        $leave->remaining_leaves = $request->get('remaining_leaves');
        $leave->leave_reason = $request->get('leave_reason');
        $leave->user_id = $request->get('user_id');
        $leave->status = $request->get('status');
        $leave->save();    

        return back()->with('success', 'EmployeeLeave updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeLeave  $employeeLeave
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $leave = EmployeeLeave::find($id);
        $leave->delete();        

        return back()->with('success', 'EmployeeLeave Deleted!');
    }
}

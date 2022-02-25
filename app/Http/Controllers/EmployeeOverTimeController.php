<?php

namespace App\Http\Controllers;

use App\Models\EmployeeOverTime;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;

class EmployeeOverTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {
        $data->employees = Employee::latest()->get();
        $data->users = User::latest()->get();

        if ($data->view_type == 'trashed') {
            $data->overtimes = EmployeeOverTime::onlyTrashed()->latest()->get();
        }
        elseif ($data->view_type == 'with-trashed') {
            $data->overtimes = EmployeeOverTime::withTrashed()->latest()->get();
        }
        else {
            $data->overtimes = EmployeeOverTime::latest()->get();
        }
        return view('system.companies.employment.overtimes.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.employment.overtimes.create', compact('data'));
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
            'overtime_date' => 'required',
            'overtime_hours' => 'required',
            'description' => 'required',
            'status' => 'required',
            'employee_id' => 'required',
            'user_id' => 'required',
        ]);        

        EmployeeOverTime::create($request->all());    

        return back()->with('success', 'EmployeeOverTime Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeeOverTime  $employeeOverTime
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.employment.overtimes.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeeOverTime  $employeeOverTime
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $overtime = EmployeeOverTime::find($id);
        return view('system.companies.employment.overtimes.edit', compact('overtime'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeeOverTime  $employeeOverTime
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'overtime_date' => 'required',
            'overtime_hours' => 'required',
            'description' => 'required',
            'status' => 'required',
            'employee_id' => 'required',
            'user_id' => 'required',
        ]);         

        $overtime = EmployeeOverTime::find($id);

        $overtime->overtime_date = $request->get('overtime_date');
        $overtime->overtime_hours = $request->get('overtime_hours');
        $overtime->description = $request->get('description');
        $overtime->status = $request->get('status');
        $overtime->employee_id = $request->get('employee_id');
        $overtime->user_id = $request->get('user_id');
        $overtime->save();    

        return back()->with('success', 'EmployeeOverTime updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeOverTime  $employeeOverTime
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $overtime = EmployeeOverTime::find($id);
        $overtime->delete();        

        return back()->with('success', 'EmployeeOverTime Deleted!');
    }
}

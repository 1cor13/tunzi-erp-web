<?php

namespace App\Http\Controllers;

use App\Models\EmployeeTimeSheet;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Project;

class EmployeeTimeSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {
        $data->employees = Employee::latest()->get();
        $data->projects = Project::latest()->get();

        if ($data->view_type == 'trashed') {
            $data->timesheets = EmployeeTimeSheet::onlyTrashed()->latest()->get();
        }
        elseif ($data->view_type == 'with-trashed') {
            $data->timesheets = EmployeeTimeSheet::withTrashed()->latest()->get();
        }
        else {
            $data->timesheets = EmployeeTimeSheet::latest()->get();
        }
        return view('system.companies.employment.timesheets.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.employment.timesheets.create', compact('data'));
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
            'deadline' => 'required',
            'total_hours' => 'required',
            'remaining_hours' => 'required',
            'timesheet_date' => 'required',
            'timesheet_hours' => 'required',
            'description' => 'required',
            'project_id' => 'required',
            'employee_id' => 'required',
        ]);        

        EmployeeTimeSheet::create($request->all());    

        return back()->with('success', 'EmployeeTimeSheet Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeeTimeSheet  $employeeTimeSheet
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.employment.timesheets.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeeTimeSheet  $employeeTimeSheet
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $timesheet = EmployeeTimeSheet::find($id);
        return view('system.companies.employment.timesheets.edit', compact('timesheet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeeTimeSheet  $employeeTimeSheet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'deadline' => 'required',
            'total_hours' => 'required',
            'remaining_hours' => 'required',
            'timesheet_date' => 'required',
            'timesheet_hours' => 'required',
            'description' => 'required',
            'project_id' => 'required',
            'employee_id' => 'required',
        ]);         

        $timesheet = EmployeeTimeSheet::find($id);

        $timesheet->deadline = $request->get('deadline');
        $timesheet->total_hours = $request->get('total_hours');
        $timesheet->remaining_hours = $request->get('remaining_hours');
        $timesheet->timesheet_date = $request->get('timesheet_date');
        $timesheet->timesheet_hours = $request->get('timesheet_hours');
        $timesheet->description = $request->get('description');
        $timesheet->project_id = $request->get('project_id');
        $timesheet->employee_id = $request->get('employee_id');
        $timesheet->save();    

        return back()->with('success', 'EmployeeTimeSheet updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeTimeSheet  $employeeTimeSheet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $timesheet = EmployeeTimeSheet::find($id);
        $timesheet->delete();        

        return back()->with('success', 'EmployeeTimeSheet Deleted!');
    }
}

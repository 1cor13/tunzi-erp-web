<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use Illuminate\Http\Request;
use App\Models\Employee;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {
        $data->employees = Employee::latest()->get();

        if ($data->view_type == 'trashed') {
            $data->salaries = Salary::onlyTrashed()->latest()->get();
        }
        elseif ($data->view_type == 'with-trashed') {
            $data->salaries = Salary::withTrashed()->latest()->get();
        }
        else {
            $data->salaries = Salary::latest()->get();
        }
        return view('system.companies.employment.salaries.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.employment.salaries.create', compact('data'));
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
            'net_salary' => 'required',
            'basic_salary' => 'required',
            'employee_id' => 'required',
            'status' => 'required',
        ]);        

        Salary::create($request->all());    

        return back()->with('success', 'Salary Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.employment.salaries.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $salary = Salary::find($id);
        return view('system.companies.employment.salaries.edit', compact('salary'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'net_salary' => 'required',
            'basic_salary' => 'required',
            'employee_id' => 'required',
            'status' => 'required',
        ]);        

        $salary = Salary::find($id);

        $salary->net_salary = $request->get('net_salary');
        $salary->basic_salary = $request->get('basic_salary');
        $salary->employee_id = $request->get('employee_id');
        $salary->status = $request->get('status');
        $salary->save();    

        return back()->with('success', 'Salary updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $salary = Salary::find($id);
        $salary->delete();        

        return back()->with('success', 'Salary Deleted!');
    }
}

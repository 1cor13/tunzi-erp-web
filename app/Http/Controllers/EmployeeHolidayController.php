<?php

namespace App\Http\Controllers;

use App\Models\EmployeeHoliday;
use Illuminate\Http\Request;

class EmployeeHolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {
        $data->holidays = EmployeeHoliday::latest()->get();

        return view('system.companies.employment.holidays.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.employment.holidays.create', compact('data'));
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
            'holiday_name' => 'required|max:255',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
        ]);        

        EmployeeHoliday::create($request->all());    

        return back()->with('success', 'Holiday Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeeHoliday  $employeeHoliday
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.employment.holidays.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeeHoliday  $employeeHoliday
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hol = EmployeeHoliday::find($id);
        return view('system.companies.employment.holidays.edit', compact('hol'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeeHoliday  $employeeHoliday
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'holiday_name' => 'required|max:255',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
        ]); 

        $hol = EmployeeHoliday::find($id);

        // EmployeeHoliday::update($request->all()); 
        $hol->holiday_name = $request->get('holiday_name');
        $hol->start_date = $request->get('start_date');
        $hol->end_date = $request->get('end_date');
        $hol->status = $request->get('status');
        $hol->save();   

        return back()->with('success', 'Holiday updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeHoliday  $employeeHoliday
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hol = EmployeeHoliday::find($id);
        $hol->delete();        

        return back()->with('success', 'Holiday Deleted!');
    }
}

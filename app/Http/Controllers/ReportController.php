<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use PDF;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {   
        $data->reports = Report::latest()->get();

        return view('system.companies.reports.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.reports.create', compact('data'));
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
            'name' => 'required|max:255',
            'type' => 'required',
            'description' => 'required',
            'group_by' => 'required',
            'period' => 'required',
            'basis' => 'required',
            'chart' => 'required',
        ]);        

        Report::create($request->all());    

        return back()->with('success', 'Report created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.reports.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $report = Report::find($id);
        return view('system.companies.reports.edit', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => 'required|max:255',
            'type' => 'required',
            'description' => 'required',
            'group_by' => 'required',
            'period' => 'required',
            'basis' => 'required',
            'chart' => 'required',
        ]);        

        $report = Report::find($id);

        $report->name = $request->get('name');
        $report->type = $request->get('type');
        $report->description = $request->get('description');
        $report->group_by = $request->get('group_by');
        $report->period = $request->get('period');
        $report->basis = $request->get('basis');
        $report->chart = $request->get('chart');
        $report->save();    

        return back()->with('success', 'Report updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $report = Report::find($id);
        $report->delete();        

        return back()->with('success', 'Report Deleted!');
    }

    public function pdf()
    {
        // retreive all records from db
        $report = Report::latest()->get();

        // share data to view
        view()->share('report', $report);

        // Send data to the view using loadView function of PDF facade
        $pdf = PDF::loadView('system.companies.reports.pdf', $report);

        // If you want to store the generated pdf to the server then you can use the store function
        $pdf->save(storage_path().'_filename.pdf');

         // download PDF file with download method
        return $pdf->download('report.pdf');
    }
}

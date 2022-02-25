<?php

namespace App\Http\Controllers;

use App\Models\JobType;
use Illuminate\Http\Request;

class JobTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {
        $data->jobtypes = JobType::latest()->get();
        return view('system.companies.perform.jobtypes.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.perform.jobtypes.create', compact('data'));
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
            'type' => 'required|max:255',
            'description' => 'required',
            'status' => 'required',
        ]);        

        JobType::create($request->all());    

        return back()->with('success', 'JobType Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TrainingType  $trainingType
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.perform.jobtypes.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TrainingType  $trainingType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jobtype = JobType::find($id);
        return view('system.companies.perform.jobtypes.edit', compact('jobtype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TrainingType  $trainingType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'type' => 'required|max:255',
            'description' => 'required',
            'status' => 'required',
        ]);        

        $jobtype = JobType::find($id);

        $jobtype->type = $request->get('type');
        $jobtype->description = $request->get('description');
        $jobtype->status = $request->get('status');
        $jobtype->save();    

        return back()->with('success', 'JobType updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TrainingType  $trainingType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jobtype = JobType::find($id);
        $jobtype->delete();        

        return back()->with('success', 'JobType Deleted!');
    }
}

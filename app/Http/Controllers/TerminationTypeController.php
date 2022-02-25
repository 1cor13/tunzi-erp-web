<?php

namespace App\Http\Controllers;

use App\Models\TerminationType;
use Illuminate\Http\Request;


class TerminationTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {
        $data->termtypes = TerminationType::latest()->get();
        
        return view('system.companies.employment.terminationtypes.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.employment.terminationtypes.create', compact('data'));
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

        TerminationType::create($request->all());    

        return back()->with('success', 'TerminationType Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TrainingType  $trainingType
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.employment.terminationtypes.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TrainingType  $trainingType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $termtype = TerminationType::find($id);
        return view('system.companies.employment.terminationtypes.edit', compact('termtype'));
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

        $termtype = TerminationType::find($id);

        $termtype->type = $request->get('type');
        $termtype->description = $request->get('description');
        $termtype->status = $request->get('status');
        $termtype->save();    

        return back()->with('success', 'TerminationType updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TrainingType  $trainingType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $termtype = TerminationType::find($id);
        $termtype->delete();        

        return back()->with('success', 'TerminationType Deleted!');
    }
}

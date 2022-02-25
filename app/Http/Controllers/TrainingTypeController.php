<?php

namespace App\Http\Controllers;

use App\Models\TrainingType;
use Illuminate\Http\Request;

class TrainingTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {
        $data->tratypes = TrainingType::latest()->get();
        return view('system.companies.perform.trainingtypes.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.perform.trainingtypes.create', compact('data'));
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

        TrainingType::create($request->all());    

        return back()->with('success', 'TrainingType Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TrainingType  $trainingType
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.perform.trainingtypes.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TrainingType  $trainingType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tratype = TrainingType::find($id);
        return view('system.companies.perform.trainingtypes.edit', compact('tratype'));
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

        $tratype = TrainingType::find($id);

        $tratype->type = $request->get('type');
        $tratype->description = $request->get('description');
        $tratype->status = $request->get('status');
        $tratype->save();    

        return back()->with('success', 'TrainingType updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TrainingType  $trainingType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tratype = TrainingType::find($id);
        $tratype->delete();        

        return back()->with('success', 'TrainingType Deleted!');
    }
}

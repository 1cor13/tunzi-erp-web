<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Trainer;
use App\Models\TrainingType;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {
        $data->employees = Employee::latest()->get();
        $data->trainers = Trainer::latest()->get();
        $data->tratypes = TrainingType::latest()->get();

        if ($data->view_type == 'trashed') {
            $data->trainings = Training::onlyTrashed()->latest()->get();
        }
        elseif ($data->view_type == 'with-trashed') {
            $data->trainings = Training::withTrashed()->latest()->get();
        }
        else {
            $data->trainings = Training::latest()->get();
        }
        return view('system.companies.perform.trainings.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.perform.trainings.create', compact('data'));
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
            'training_cost'=>'required',
            'start_date'=>'required',
            'end_date' => 'required',
            'status' => 'required',
        ]);         

        Training::create($request->all());    

        return back()->with('success', 'Training Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.perform.trainings.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $training = Training::find($id);
        return view('system.companies.perform.trainings.edit', compact('training'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'training_cost'=>'required',
            'start_date'=>'required',
            'end_date' => 'required',
            'status' => 'required',
        ]);        

        $training = Training::find($id);

        $training->training_cost = $request->get('training_cost');
        $training->start_date = $request->get('start_date');
        $training->end_date = $request->get('end_date');
        $training->status = $request->get('status');
        $training->save();    

        return back()->with('success', 'Training updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $training = Training::find($id);
        $training->delete();        

        return back()->with('success', 'Training Deleted!');
    }
}

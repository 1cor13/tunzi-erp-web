<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;
use App\Models\GoalType;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {
        $data->goaltypes = GoalType::latest()->get();

        if ($data->view_type == 'trashed') {
            $data->goals = Goal::onlyTrashed()->latest()->get();
        }
        elseif ($data->view_type == 'with-trashed') {
            $data->goals = Goal::withTrashed()->latest()->get();
        }
        else {
            $data->goals = Goal::latest()->get();
        }
        return view('system.companies.perform.goals.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.perform.goals.create', compact('data'));
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
            'goal_type_id'=>'required',
            'subject'=>'required',
            'start_date'=>'required',
            'end_date'     => 'required',
            'status'  => 'required',
        ]);       

        Goal::create($request->all());    

        return back()->with('success', 'Goal Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.perform.goals.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $goal = Goal::find($id);
        return view('system.companies.perform.goals.edit', compact('goal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'goal_type_id'=>'required',
            'subject'=>'required',
            'start_date'=>'required',
            'end_date'     => 'required',
            'status'  => 'required',
        ]);           

        $goal = Goal::find($id);
 
        $goal->goal_type_id = $request->get('goal_type_id');
        $goal->subject = $request->get('subject');
        $goal->start_date = $request->get('start_date');
        $goal->end_date = $request->get('end_date');
        $goal->status = $request->get('status');
        $goal->save();   

        return back()->with('success', 'Goal updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $goal = Goal::find($id);
        $goal->delete();        

        return back()->with('success', 'Goal Deleted!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\GoalType;
use Illuminate\Http\Request;

class GoalTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {
        $data->goaltypes = GoalType::latest()->get();
        
        return view('system.companies.perform.goaltypes.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.perform.goaltypes.create', compact('data'));
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
            'goal_type_name' => 'required|max:255',
            'status' => 'required',
        ]);        

        GoalType::create($request->all());    

        return back()->with('success', 'GoalType Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GoalType  $goalType
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.perform.goaltypes.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GoalType  $goalType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $goaltype = GoalType::find($id);
        return view('system.companies.perform.goaltypes.edit', compact('goaltype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GoalType  $goalType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'goal_type_name' => 'required|max:255',
            'status' => 'required',
        ]);         

        $goaltype = GoalType::find($id);

        $goaltype->goal_type_name = $request->get('goal_type_name');
        $goaltype->status = $request->get('status');
        $goaltype->save();    

        return back()->with('success', 'GoalType updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GoalType  $goalType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $goaltype = GoalType::find($id);
        $goaltype->delete();        

        return back()->with('success', 'GoalType Deleted!');
    }
}

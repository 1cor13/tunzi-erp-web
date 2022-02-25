<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trainer;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {
        $data->trainers = Trainer::latest()->get();
        return view('system.companies.perform.trainers.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.perform.trainers.create', compact('data'));
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
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|unique:trainers',
            'phone' => 'required',
            'role' => 'required',
            'status' => 'required',
        ]);        

        Trainer::create($request->all());    

        return back()->with('success', 'Trainer Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trainer  $trainer
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.perform.trainers.show', compact('data'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trainer  $trainer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trainer = Trainer::find($id);
        return view('system.companies.perform.trainers.edit', compact('trainer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trainer  $trainer
     * @return \Illuminate\Http\Response
     $trainer->phone = $request->get('phone');*/
    public function update(Request $request, $id)
    {
        request()->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|unique:trainers',
            'phone' => 'required',
            'role' => 'required',
            'status' => 'required',
        ]);         

        $trainer = Trainer::find($id);

        $trainer->first_name = $request->get('first_name');
        $trainer->last_name = $request->get('last_name');
        $trainer->email = $request->get('email');
        $trainer->phone = $request->get('phone');
        $trainer->role = $request->get('role');
        $trainer->status = $request->get('status');
        $trainer->save();    

        return back()->with('success', 'Trainer updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trainer  $trainer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trainer = Trainer::find($id);
        $trainer->delete();        

        return back()->with('success', 'Trainer Deleted!');
    }
}

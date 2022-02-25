<?php

namespace App\Http\Controllers;

use App\Models\Termination;
use Illuminate\Http\Request;

use App\Models\Employee;
use App\Models\TerminationType;

class TerminationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {
        $data->employees = Employee::latest()->get();
        $data->termtypes = TerminationType::latest()->get();

        if ($data->view_type == 'trashed') {
            $data->terminations = Termination::onlyTrashed()->latest()->get();
        }
        elseif ($data->view_type == 'with-trashed') {
            $data->terminations = Termination::withTrashed()->latest()->get();
        }
        else {
            $data->terminations = Termination::latest()->get();
        }
        return view('system.companies.employment.terminations.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.employment.terminations.create', compact('data'));
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
            'termination_date'=>'required',
            'termination_reason'=>'required',
            'notice_date' => 'required',
            'employee_id' => 'required',
            'termination_type_id' => 'required',
            'status' => 'required',
        ]);         

        Termination::create($request->all());    

        return back()->with('success', 'Termination Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Termination  $termination
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.employment.terminations.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Termination  $termination
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $termination = Termination::find($id);
        return view('system.companies.employment.terminations.edit', compact('termination'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Termination  $termination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'termination_date'=>'required',
            'termination_reason'=>'required',
            'notice_date' => 'required',
            'employee_id' => 'required',
            'termination_type_id' => 'required',
            'status' => 'required',
        ]);         

        $termination = Termination::find($id);

        $termination->termination_date = $request->get('termination_date');
        $termination->termination_reason = $request->get('termination_reason');
        $termination->notice_date = $request->get('notice_date');
        $termination->employee_id = $request->get('employee_id');
        $termination->termination_type_id = $request->get('termination_type_id');
        $termination->status = $request->get('status');
        $termination->save();    

        return back()->with('success', 'Termination updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Termination  $termination
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $termination = Termination::find($id);
        $termination->delete();        

        return back()->with('success', 'Termination Deleted!');
    }
}

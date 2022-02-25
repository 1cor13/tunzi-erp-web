<?php

namespace App\Http\Controllers;

use App\Models\Resignation;
use Illuminate\Http\Request;
use App\Models\Employee;

class ResignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {   
        $data->employees = Employee::latest()->get();

        if ($data->view_type == 'trashed') {
            $data->resigns = Resignation::onlyTrashed()->latest()->get();
        }
        elseif ($data->view_type == 'with-trashed') {
            $data->resigns = Resignation::withTrashed()->latest()->get();
        }
        else {
            $data->resigns = Resignation::latest()->get();
        }
        return view('system.companies.employment.resignations.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.employment.resignations.create', compact('data'));
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
            'employee_id'=>'required',
            'resignation_date'=>'required',
            'resignation_reason'=>'required'
        ]);        

        Resignation::create($request->all());    

        return back()->with('success', $request->employee_id . '\'s Resignation Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resignation  $resignation
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.employment.resignations.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resignation  $resignation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $resign = Resignation::find($id);
        return view('system.companies.employment.resignations.edit', compact('resign'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resignation  $resignation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'employee_id'=>'required',
            'resignation_date'=>'required',
            'resignation_reason'=>'required'
        ]);        

        $resign = Resignation::find($id);

        Resignation::update($request->all());    

        return back()->with('success', $request->employee_id . '\'s Resignation updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resignation  $resignation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resign = Resignation::find($id);
        $resign->delete();        

        return back()->with('success' . '\'s Resignation Deleted!');
    }
}

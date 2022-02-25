<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Designation;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {
        $data->employees = Employee::latest()->get();
        $data->departments = Department::latest()->get();
        $data->designations = Designation::latest()->get();

        if ($data->view_type == 'trashed') {
            $data->promotions = Promotion::onlyTrashed()->latest()->get();
        }
        elseif ($data->view_type == 'with-trashed') {
            $data->promotions = Promotion::withTrashed()->latest()->get();
        }
        else {
            $data->promotions = Promotion::latest()->get();
        }
        return view('system.companies.employment.promotions.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.employment.promotions.create', compact('data'));
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
            'employee_id' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
            'promotion_date' => 'required',
        ]);        

        Promotion::create($request->all());    

        return back()->with('success', 'Promotion Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.employment.promotions.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prom = Promotion::find($id);
        return view('system.companies.employment.promotions.edit', compact('prom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promotion $promotion)
    {
        request()->validate([
            'employee_id' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
            'promotion_date' => 'required',
        ]); 

        $prom = Promotion::find($id);

        // Designation::update($request->all());
        $prom->employee_id = $request->get('employee_id');
        $prom->department_id = $request->get('department_id');
        $prom->designation_id = $request->get('designation_id');
        $prom->promotion_date = $request->get('promotion_date');
        $prom->save();    

        return back()->with('success', 'Promotion updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prom = Promotion::find($id);
        $prom->delete();        

        return back()->with('success', 'Promotion Deleted!');
    }
}

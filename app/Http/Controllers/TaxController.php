<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;


class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {
        $data->taxes = Tax::latest()->get();
        return view('system.companies.bankings.taxes.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.bankings.taxes.create', compact('data'));
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
            'name' => 'required',
            'rate' => 'required',
            'type' => 'required',
            'status' => 'required',
        ]);        

        Tax::create($request->all());    

        return back()->with('success', 'Tax created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.bankings.taxes.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tax = Tax::find($id);
        return view('system.companies.bankings.taxes.edit', compact('tax'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => 'required',
            'rate' => 'required',
            'type' => 'required',
            'status' => 'required',
        ]);        

        $tax = Tax::find($id);

        $tax->name = $request->get('name');
        $tax->rate = $request->get('rate');
        $tax->type = $request->get('type');
        $tax->status = $request->get('status');
        $tax->save();    

        return back()->with('success', 'Tax updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tax = Tax::find($id);
        $tax->delete();        

        return back()->with('success', 'Tax Deleted!');
    }
}

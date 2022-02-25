<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {   
        $data->currencies = Currency::latest()->get();

        return view('system.companies.settings.currencies.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.settings.currencies.create', compact('data'));
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
            'name' => 'required|max:255',
            'code' => 'required',
            'rate' => 'required',
            'precision' => 'required',
            'symbol' => 'required',
            'decimal_mark' => 'required',
            'status' => 'required'
        ]);        

        Currency::create($request->all());    

        return back()->with('success', 'Currency created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.settings.currencies.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $currency = Currency::find($id);
        return view('system.companies.settings.currencies.edit', compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => 'required|max:255',
            'code' => 'required',
            'rate' => 'required',
            'precision' => 'required',
            'symbol' => 'required',
            'decimal_mark' => 'required',
            'status' => 'required'
        ]);        

        $currency = Currency::find($id);

        $currency->name = $request->get('name');
        $currency->code = $request->get('code');
        $currency->rate = $request->get('rate');
        $currency->precision = $request->get('precision');
        $currency->symbol = $request->get('symbol');
        $currency->symbol_position = $request->get('symbol_position');
        $currency->decimal_mark = $request->get('decimal_mark');
        $currency->status = $request->get('status');
        $currency->default_currency = $request->get('default_currency');
        $currency->save();    

        return back()->with('success', 'Currency updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $currency = Currency::find($id);
        $currency->delete();        

        return back()->with('success', 'Currency Deleted!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Currency;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {
        $data->currencies = Currency::latest()->get();
        $data->customers = Customer::latest()->get();
        
        return view('system.companies.sales.customers.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.sales.customers.index', compact('data'));
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
            'name'=>'required',
            'phone'=>'required',
            'email'=> 'required|unique:customers',
            'password'  => 'required|min:6',
            'status'=>'required',
            'currency_id'=>'required',
        ]);       

        Customer::create($request->all());    

        return back()->with('success', 'Customer Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.sales.customers.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('system.companies.sales.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'name'=>'required',
            'phone'=>'required',
            'email'=> 'required|unique:customers',
            'password'  => 'required|min:6',
            'status'=>'required',
            'currency_id'=>'required',
        ]);           

        $customer = Customer::find($id);
 
        $customer->name = $request->get('name');
        $customer->email = $request->get('email');
        $customer->tax_number = $request->get('tax_number');
        $customer->phone = $request->get('phone');
        $customer->website = $request->get('website');
        $customer->address = $request->get('address');
        $customer->reference = $request->get('reference');
        $customer->password = $request->get('password');
        $customer->status = $request->get('status');
        $customer->currency_id = $request->get('currency_id');
        $customer->save();   

        return back()->with('success', 'Customer updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();        

        return back()->with('success', 'Customer Deleted!');
    }
}

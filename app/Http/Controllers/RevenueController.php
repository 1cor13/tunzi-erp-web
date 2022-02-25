<?php

namespace App\Http\Controllers;

use App\Models\Revenue;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Customer;
use App\Models\Category;
use App\Models\Invoice;

class RevenueController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {
        $data->accounts = Account::latest()->get();
        $data->customers = Customer::latest()->get();
        $data->categories = Category::latest()->get();
        $data->invoices = Invoice::latest()->get();

        $data->revenues = Revenue::latest()->get();

        return view('system.companies.bankings.revenues.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.bankings.revenues.create', compact('data'));
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
            'date'=>'required',
            'amount'=>'required',
            // 'account_id'=>'required',
            // 'category_id'=>'required',
            // 'pay_method'=>'required',
            // 'customer_id'=>'required',
            // 'invoice_id'=>'required',
        ]);       

        Revenue::create($request->all());    

        return back()->with('success', 'Revenue Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.bankings.revenues.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $revenue = Customer::find($id);
        return view('system.companies.bankings.revenues.edit', compact('revenue'));
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
            'date'=>'required',
            'amount'=>'required',
            'account_id'=>'required',
            'category_id'=>'required',
            'pay_method'=>'required',
            'customer_id'=>'required',
            'invoice_id'=>'required',
        ]);           

        $revenue = Revenue::find($id);
 
        $revenue->date = $request->get('date');
        $revenue->amount = $request->get('amount');
        $revenue->description = $request->get('description');
        $revenue->recurring = $request->get('recurring');
        $revenue->pay_method = $request->get('pay_method');
        $revenue->reference = $request->get('reference');
        $revenue->attachment = $request->get('attachment');
        $revenue->account_id = $request->get('account_id');
        $revenue->customer_id = $request->get('customer_id');
        $revenue->category_id = $request->get('category_id');
        $revenue->invoice_id = $request->get('invoice_id');
        $revenue->save();   

        return back()->with('success', 'Revenue updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $revenue = Revenue::find($id);
        $revenue->delete();        

        return back()->with('success', 'Revenue Deleted!');
    }
}

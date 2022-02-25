<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Currency;
use App\Models\Category;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {
        $data->companies = Company::latest()->get();
        $data->customers = Customer::latest()->get();
        $data->products = Product::latest()->get();
        $data->currencies = Currency::latest()->get();
        $data->categories = Category::latest()->get();
        $data->invoices = Invoice::latest()->get();

        return view('system.companies.bankings.invoices.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.bankings.invoices.create', compact('data'));
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
            'company_id' => 'required',
            'customer_id' => 'required',
            'invoice_date' => 'required',
            'invoice_number' => 'required',
            'due_date' => 'required',
        ]);        

        Invoice::create($request->all());    

        return back()->with('success', 'Invoice Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.bankings.invoices.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = Invoice::find($id);
        return view('system.companies.bankings.invoices.edit', compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'company_id' => 'required',
            'customer_id' => 'required',
            'invoice_date' => 'required',
            'invoice_number' => 'required',
            'due_date' => 'required',
        ]);        

        $invoice = Invoice::find($id);

        $invoice->company_id = $request->get('company_id');
        $invoice->customer_id = $request->get('customer_id');
        $invoice->invoice_date = $request->get('invoice_date');
        $invoice->invoice_number = $request->get('invoice_number');
        $invoice->due_date = $request->get('due_date');
        $invoice->product_id = $request->get('product_id');
        $invoice->quantity = $request->get('quantity');
        $invoice->amount = $request->get('amount');
        $invoice->subtotal = $request->get('subtotal');
        $invoice->discount = $request->get('discount');
        $invoice->total = $request->get('total');
        $invoice->currency_id = $request->get('currency_id');
        $invoice->notes = $request->get('notes');
        $invoice->footer = $request->get('footer');
        $invoice->recurring = $request->get('recurring');
        $invoice->category_id = $request->get('category_id');
        $invoice->attachment = $request->get('attachment');
        $invoice->status = $request->get('status');
        $invoice->save();    

        return back()->with('success', 'Invoice updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoice = Invoice::find($id);
        $invoice->delete();        

        return back()->with('success', 'Invoice Deleted!');
    }
}

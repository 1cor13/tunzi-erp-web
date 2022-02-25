<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\Vendor;
use App\Models\Currency;
use App\Models\Product;
use App\Models\Category;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {
        $data->vendors = Vendor::latest()->get();
        $data->currencies = Currency::latest()->get();
        $data->products = Product::latest()->get();
        $data->categories = Category::latest()->get();
        $data->bills = Bill::latest()->get();

        return view('system.companies.bankings.bills.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.bankings.bills.create', compact('data'));
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
            'bill_date' => 'required',
            'amount' => 'required',
            'vendor_id' => 'required',
            'due_date' => 'required',
            'bill_number' => 'required',
        ]);        

        Bill::create($request->all());    

        return back()->with('success', 'Bill Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.bankings.bills.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bill = Bill::find($id);
        return view('system.companies.bankings.bills.edit', compact('bill'));
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
            'bill_date' => 'required',
            'amount' => 'required',
            'vendor_id' => 'required',
            'due_date' => 'required',
            'bill_number' => 'required',
        ]);        

        $bill = Bill::find($id);

        $bill->bill_date = $request->get('bill_date');
        $bill->bill_number = $request->get('bill_number');
        $bill->due_date = $request->get('due_date');
        $bill->order_number = $request->get('order_number');
        $bill->quantity = $request->get('quantity');
        $bill->amount = $request->get('amount');
        $bill->subtotal = $request->get('subtotal');
        $bill->discount = $request->get('discount');
        $bill->total = $request->get('total');
        $bill->currency_id = $request->get('currency_id');
        $bill->product_id = $request->get('product_id');
        $bill->category_id = $request->get('category_id');
        $bill->vendor_id = $request->get('vendor_id');
        $bill->notes = $request->get('notes');
        $bill->recurring = $request->get('recurring');
        $bill->attachment = $request->get('attachment');
        $bill->status = $request->get('status');
        $bill->save();    

        return back()->with('success', 'Bill updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bill = Bill::find($id);
        $bill->delete();        

        return back()->with('success', 'Bill Deleted!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Vendor;
use App\Models\Category;
use App\Models\Bill;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {
        $data->accounts = Account::latest()->get();
        $data->vendors = Vendor::latest()->get();
        $data->categories = Category::latest()->get();
        $data->bills = Bill::latest()->get();
        $data->payments = Payment::latest()->get();

        return view('system.companies.bankings.payments.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.bankings.payments.create', compact('data'));
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
            'date' => 'required',
            'amount' => 'required',
            'account_id' => 'required',
            'category_id' => 'required',
            'bill_id' => 'required',
            'pay_method' => 'required',
        ]);        

        Payment::create($request->all());    

        return back()->with('success', 'Payment Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.bankings.payments.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment = Payment::find($id);
        return view('system.companies.bankings.payments.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'date' => 'required',
            'amount' => 'required',
            'account_id' => 'required',
            'category_id' => 'required',
            'bill_id' => 'required',
            'pay_method' => 'required',
        ]);     

        $payment = Payment::find($id);

        $payment->date = $request->get('date');
        $payment->amount = $request->get('amount');
        $payment->description = $request->get('description');
        $payment->recurring = $request->get('recurring');
        $payment->pay_method = $request->get('pay_method');
        $payment->reference = $request->get('reference');
        $payment->attachment = $request->get('attachment');
        $payment->account_id = $request->get('account_id');
        $payment->category_id = $request->get('category_id');
        $payment->bill_id = $request->get('bill_id');
        $payment->vendor_id = $request->get('vendor_id');
        $payment->save();    

        return back()->with('success', 'Payment updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment = Payment::find($id);
        $payment->delete();        

        return back()->with('success', 'Payment Deleted!');
    }
}

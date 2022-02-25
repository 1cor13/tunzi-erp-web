<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Revenue;
use App\Models\Payment;
use App\Models\Account;
use App\Models\Category;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {   
        $data->revenues = Revenue::latest()->get();
        $data->payments = Payment::latest()->get();
        $data->accounts = Account::latest()->get();
        $data->categories = Category::latest()->get();
        $data->transactions = Transaction::latest()->get();

        return view('system.companies.bankings.transactions.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.bankings.transactions.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $revenue = Revenue::find($id);
        $payment = Payment::find($id);
        return view('system.companies.bankings.transactions.edit', compact('revenue', 'payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

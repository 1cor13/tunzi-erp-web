<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transfer;
use App\Models\Account;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {   
        $data->transfers = Transfer::latest()->get();
        $data->accounts = Account::latest()->get();

        return view('system.companies.bankings.transfers.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.bankings.transfers.create', compact('data'));
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
            'account_id' => 'required',
            'amount' => 'required',
            'date' => 'required',
            'pay_method' => 'required',
        ]);        

        Transfer::create($request->all());    

        return back()->with('success', 'Transfer Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.bankings.transfers.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transfer = Transfer::find($id);
        return view('system.companies.bankings.transfers.edit', compact('transfer'));
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
        request()->validate([
            'account_id' => 'required',
            'amount' => 'required',
            'date' => 'required',
            'pay_method' => 'required',
        ]);         

        $transfer = Transfer::find($id);

        $transfer->amount = $request->get('amount');
        $transfer->date = $request->get('date');
        $transfer->description = $request->get('description');
        $transfer->pay_method = $request->get('pay_method');
        $transfer->reference = $request->get('reference');
        $transfer->account_id = $request->get('account_id');
        $transfer->save();    

        return back()->with('success', 'Transfer updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transfer = Transfer::find($id);
        $transfer->delete();        

        return back()->with('success', 'Transfer Deleted!');
    }
}

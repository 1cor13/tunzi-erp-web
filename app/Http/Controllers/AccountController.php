<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Currency;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {   
        $data->currencies = Currency::latest()->get();
        $data->accounts = Account::latest()->get();

        return view('system.companies.bankings.accounts.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.bankings.accounts.create', compact('data'));
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
            'name' => 'required|unique:accounts',
            'number' => 'required',
            'currency_id' => 'required',
            'opening_balance' => 'required',
        ]);        

        Account::create($request->all());    

        return back()->with('success', 'Account Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.bankings.accounts.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $account = Account::find($id);
        return view('system.companies.bankings.accounts.edit', compact('account'));
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
            'name' => 'required|unique:accounts',
            'number' => 'required',
            'currency_id' => 'required',
            'opening_balance' => 'required',
        ]);        

        $account = Account::find($id);

        $account->name = $request->get('name');
        $account->number = $request->get('number');
        $account->currency_id = $request->get('chart_account_id');
        $account->opening_balance = $request->get('chart_account_id');
        $account->bank_name = $request->get('chart_account_id');
        $account->bank_phone = $request->get('chart_account_id');
        $account->bank_address = $request->get('chart_account_id');
        $account->default_account = $request->get('chart_account_id');
        $account->status = $request->get('chart_account_id');
        $account->save();    

        return back()->with('success', 'Account updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $account = Account::find($id);
        $account->delete();        

        return back()->with('success', 'Account Deleted!');
    }
}

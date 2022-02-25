<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use App\Models\Client;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {
        $data->clients = Client::latest()->get();

        if ($data->view_type == 'trashed') {
            $data->expenses = Expense::onlyTrashed()->latest()->get();
        }
        elseif ($data->view_type == 'with-trashed') {
            $data->expenses = Expense::withTrashed()->latest()->get();
        }
        else {
            $data->expenses = Expense::latest()->get();
        }
        return view('system.companies.hr.expenses.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.hr.expenses.create', compact('data'));
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
            'item_name' => 'required',
            'purchase_from' => 'required',
            'purchase_date' => 'required',
            'paid_by' => 'required',
            'amount' => 'required',
            'status' => 'required',
            'client_id' => 'required',
            'image'  => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            
        ]);        

        $path = $request->file('image')->store('public/images');

        $expense = new Expense; 

        $expense->item_name = $request->get('item_name');
        $expense->purchase_from = $request->get('purchase_from');
        $expense->purchase_date = $request->get('purchase_date');
        $expense->paid_by = $request->get('paid_by');
        $expense->amount = $request->get('amount');
        $expense->status = $request->get('status');
        $expense->client_id = $request->get('client_id');
        $expense->image = $path;
        $expense->save();    

        return back()->with('success', 'Expense Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.hr.expenses.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expense = Expense::find($id);
        return view('system.companies.hr.expenses.edit', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'item_name' => 'required',
            'purchase_from' => 'required',
            'purchase_date' => 'required',
            'paid_by' => 'required',
            'amount' => 'required',
            'status' => 'required',
            'client_id' => 'required',
            
        ]);     

        $expense = Expense::find($id);

        if($request->hasFile('image')){
            $request->validate([
              'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            $path = $request->file('image')->store('public/images');
            $expense->image = $path;
        }

        $expense->item_name = $request->get('item_name');
        $expense->purchase_from = $request->get('purchase_from');
        $expense->purchase_date = $request->get('purchase_date');
        $expense->paid_by = $request->get('paid_by');
        $expense->amount = $request->get('amount');
        $expense->status = $request->get('status');
        $expense->client_id = $request->get('client_id');
        $expense->save();    

        return back()->with('success', 'Expense updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense = Expense::find($id);
        $expense->delete();        

        return back()->with('success', 'Expense Deleted!');
    }
}

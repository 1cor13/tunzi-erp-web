<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Models\Currency;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {
        $data->currencies = Currency::latest()->get();
        $data->vendors = Vendor::latest()->get();

        return view('system.companies.bankings.vendors.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.bankings.vendors.create', compact('data'));
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
            'name'=>'required|max:255',
            'email' => 'required|unique:vendors',
            'currency_id'=>'required',
        ]);        

        Vendor::create($request->all());    

        return back()->with('success', 'Vendor Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    { 
        return view('system.companies.bankings.vendors.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vendor = Vendor::find($id);
        return view('system.companies.bankings.vendors.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'name'=>'required|max:255',
            'email' => 'required|unique:vendors',
            'currency_id'=>'required',
        ]); 

        $vendor = Vendor::find($id);

        $vendor->name = $request->get('name');
        $vendor->email = $request->get('email');
        $vendor->tax_number = $request->get('tax_number');
        $vendor->phone = $request->get('phone');
        $vendor->website = $request->get('website');
        $vendor->address = $request->get('address');
        $vendor->reference = $request->get('reference');
        $vendor->picture = $request->get('picture');
        $vendor->status = $request->get('status');
        $vendor->currency_id = $request->get('currency_id');
        $vendor->save();    

        return back()->with('success', 'Vendor updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendor = Vendor::find($id);
        $vendor->delete();        

        return back()->with('success', 'Vendor Deleted!');
    }
}

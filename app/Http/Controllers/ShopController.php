<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Village;
use App\Models\Company;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {
        $data->villages = Village::latest()->get();
        $data->categories = Category::latest()->get();
        $data->companies = Company::latest()->get();

        if ($data->view_type == 'trashed') {
            $data->shops = Shop::onlyTrashed()->latest()->get();
        }
        elseif ($data->view_type == 'with-trashed') {
            $data->shops = Shop::withTrashed()->latest()->get();
        }
        else {
            $data->shops = Shop::latest()->get();
        }
        return view('system.companies.inventories.shops.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.inventories.shops.create', compact('data'));
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
            'shop_name'     => 'required',
            'shop_phone'    => 'required|unique:shops',
            'shop_email'    => 'required',
            'time_open'     => 'required',
            'time_closed'   => 'required',
            'status'    => 'required',
        ]);

        Shop::create($request->all());    

        return back()->with('success', 'Shop Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.inventories.shops.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shop = Shop::find($id);
        return view('system.companies.inventories.shops.edit', compact('shop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'shop_name'    => 'required',
            'shop_phone'   => 'required|unique:shops',
            'shop_email'    => 'required',
            'time_open'    => 'required',
            'time_closed'    => 'required',
            'status'    => 'required',
        ]);

        $shop = Shop::find($id);

        $shop->shop_name = $request->get('shop_name');
        $shop->shop_email = $request->get('shop_email');
        $shop->shop_phone = $request->get('shop_phone');
        $shop->time_open = $request->get('time_open');
        $shop->time_closed = $request->get('time_closed');
        $shop->status = $request->get('status');
        $shop->save();

        return back()->with('success', 'Shop updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shop = Shop::find($id);
        $shop->delete();        

        return back()->with('success', 'Shop Deleted!');
    }
}

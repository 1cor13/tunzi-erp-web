<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {
        $data->employees = Employee::latest()->get();
        $data->users = User::latest()->get();

        if ($data->view_type == 'trashed') {
            $data->assets = Asset::onlyTrashed()->latest()->get();
        }
        elseif ($data->view_type == 'with-trashed') {
            $data->assets = Asset::withTrashed()->latest()->get();
        }
        else {
            $data->assets = Asset::latest()->get();
        }
        return view('system.companies.inventories.assets.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.inventories.assets.create', compact('data'));
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
            'asset_name' => 'required|max:255',
            'purchase_date' => 'required',
            'purchase_from' => 'required',
            'warranty' => 'required',
            'value' => 'required',
            'status' => 'required',

        ]);        

        Asset::create($request->all());    

        return back()->with('success', 'Asset Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.inventories.assets.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asset = Asset::find($id);
        return view('system.companies.inventories.assets.edit', compact('asset'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'asset_name' => 'required|max:255',
            'purchase_date' => 'required',
            'purchase_from' => 'required',
            'warranty' => 'required',
            'value' => 'required',
            'status' => 'required',

        ]);        

        $asset = Asset::find($id);

        $asset->asset_name = $request->get('asset_name');
        $asset->purchase_date = $request->get('purchase_date');
        $asset->purchase_from = $request->get('purchase_from');
        $asset->warranty = $request->get('warranty');
        $asset->value = $request->get('value');
        $asset->status = $request->get('status');
        $asset->save();    

        return back()->with('success', 'Designation updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asset = Asset::find($id);
        $asset->delete();        

        return back()->with('success', 'Asset Deleted!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\User;
use App\Models\Gallery;
use App\Models\District;
use App\Models\Village;


class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {
        $data->customers = Customer::latest()->get();
        $data->users = User::latest()->get();
        $data->galleries = Gallery::latest()->get();
        $data->districts = District::latest()->get();
        $data->villages = Village::latest()->get();
        

        if ($data->view == 'trashed') {
            $data->branches = Branch::onlyTrashed()->latest()->get();
        }
        elseif ($data->view == 'with-trashed') {
            $data->branches = Branch::withTrashed()->latest()->get();
        }
        else {
            $data->branches = Branch::latest()->get();
        }

        return view('system.companies.inventories.branches.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.inventories.branches.create', compact('data'));
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
            'branch_name'    => 'required',
            'branch_phone2'   => 'required|unique:branches',
            'branch_email'    => 'required',
            'open_hours'    => 'required',
            'branch_status'    => 'required',
        ]);

        Branch::create($request->all()); 

        return back()->with('success', 'Branch created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {

        return view('system.companies.inventories.branches.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branch = Branch::find($id);

        return view('system.companies.inventories.branches.edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'branch_name'    => 'required',
            'branch_phone2'   => 'required|unique:branches',
            'branch_email'    => 'required',
            'open_hours'    => 'required',
            'branch_status'    => 'required',
        ]);

        $branch = Branch::find($id);

        $branch->branch_name = $request->get('branch_name');
        $branch->branch_phone2 = $request->get('branch_phone2');
        $branch->branch_email = $request->get('branch_email');
        $branch->open_hours = $request->get('open_hours');
        $branch->branch_status = $request->get('branch_status');
        $branch->save();

        return back()->with('success','Branch updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $branch = Branch::find($id);
        $branch->delete(); 

        return back()->with('success', 'Branch deleted successfully');
    }
}

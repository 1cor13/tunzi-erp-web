<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {   
        $data->countries = Country::latest()->get();

        return view('system.companies.settings.countries.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.settings.countries.create', compact('data'));
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
            'country_name' => 'required',
            'short_code' => 'required',
            'country_code' => 'required',
            'country_region' => 'required',
        ]);        

        Country::create($request->all());    

        return back()->with('success', 'Country Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.settings.countries.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::find($id);
        return view('system.companies.settings.countries.edit', compact('country'));
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
            'country_name' => 'required',
            'short_code' => 'required',
            'country_code' => 'required',
            'country_region' => 'required',
        ]);         

        $country = Country::find($id);

        $country->country_name = $request->get('country_name');
        $country->country_code = $request->get('country_code');
        $country->short_code = $request->get('short_code');
        $country->country_region = $request->get('country_region');
        $country->country_timezone = $request->get('country_timezone');
        $country->status = $request->get('status');
        $country->save();    

        return back()->with('success', 'Country updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Country::find($id);
        $country->delete();        

        return back()->with('success', 'Country Deleted!');
    }
}

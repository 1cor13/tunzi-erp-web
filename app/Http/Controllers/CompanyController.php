<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\Currency;
use App\Models\CompanyUser;
use App\Models\Language;
use App\Models\Country;
use App\Models\Village;
use Auth;

class CompanyController extends Controller
{
    /**
     * Display the constructor of the resource.
     *
     * @return Response
     */
    public function __construct()
    {
        $this->middleware('permission:view_company_list',['only'=>['index']]);
        $this->middleware('permission:create_company',['only'=>['create','store']]);
        $this->middleware('permission:edit_company',['only'=>['update','edit']]);
        $this->middleware('permission:delete_company',['only'=>'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {
        $data->view_type = $data->view ? $data->view : 'cards';
        $data->currencies = Currency::latest()->get();

        if ($data->view == 'trashed') {
            $data->companies = Company::with('users')->onlyTrashed()->latest()->get();
        }
        elseif ($data->view == 'with-trashed') {
            $data->companies = Company::with('users')->withTrashed()->latest()->get();
        }
        else {
            $data->companies = Company::with('users')->latest()->get();
        }

        return view('system.companies.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        $data->countryList  = Country::latest()->get();
        $data->currencies   = Currency::latest()->get();
        $data->languageList = Language::latest()->get();
        $data->villageList  = Village::latest()->get();
        return view('system.companies.create', compact('data'));
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
            'name'  => 'required',
            'email'  => 'required|unique:companies',
        ]);

        $allowedfileExtension = ['jpeg','jpg','png','svg','ico', 'gif'];
        $upload_file = $request->logo;
        $filename   = $upload_file->getClientOriginalName();
        $extension  = $upload_file->getClientOriginalExtension();

        $check      = in_array($extension, $allowedfileExtension);

        if(!$check)
        {
            return response()->json([
                'image' => 'File ' . $filename . ' has been rejected. Only jpeg, jpg, png, svg, ico file types allowed'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $company = Company::create($request->except('logo'));

        CompanyUser::create([
            'user_id'   => $request->user_id ?? Auth::user()->id,
            'company_id'=> $company->id,
            'role'      => $request->role,
        ]);

        // upload image
        $file_name  = str_replace(' ', '_', $filename) . '_' . time();
        $size = Storage::size($upload_file);
        $dir = 'files/uploads/'. $user->id .'/';

        if( !File::isDirectory($dir) )
        {
            File::makeDirectory($dir, 0777, true, true);
            $file_to_write = 'user-uploads.txt';
            $content_to_write = "This is the file for the directory of user - " . $user->name;
            $file = fopen($dir . '/' . $file_to_write,"w");
            fwrite($file, $content_to_write);
            fclose($file);
        }

        $path = $upload_file->move('files/uploads/'. $user->id .'/', $file_name);

        Images::create([
            'user_id'   => $user->id,
            'name'      => $file_name,
            'path'      => $path,
            'size'      => $size,
            'status'    => 'published'
        ]);

        return back()->with('success', 'Company created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data, $id)
    {
        $data->company = Company::findOrFail($id);

        if (!$data->company) {
            return back()->with('danger', 'Company not found. It is either missing or deleted');
        }

        return view('system.companies.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id);

        if (!$company) {
            return back()->with('danger', 'Company not found. It is either missing or deleted!');
        }

        $data = new Request();
        $data->countryList  = Country::latest()->get();
        $data->currencies   = Currency::latest()->get();
        $data->languageList = Language::latest()->get();
        $data->villageList  = Village::latest()->get();

        return view('system.companies.edit', compact('data','company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ( !Auth::user()->hasPermission('delete_company') ) {
            return back()->with('danger', 'Sorry you do not have permission perform this orperation');
        }
        
        $company = Company::where('id', $id)->withTrashed()->first();

        if (!$company) {
            return back()->with('danger', 'Company profile not found. It might be missing or deleted already');
        }

        if ($company->trashed()) {
            // DB::table('company_locations')->where('company_id',$id)->forceDelete();

            $company->forceDelete();
        }
        else {
            $company->delete();
        }

        $company->delete();
        return redirect()->route('industries.index')->with('success', 'Delete operation successful');

    }
}

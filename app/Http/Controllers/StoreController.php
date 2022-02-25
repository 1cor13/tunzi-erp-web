<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Village;
use File;

class StoreController extends Controller
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

        if ($data->view_type == 'trashed') {
            $data->stores = Store::onlyTrashed()->latest()->get();
        }
        elseif ($data->view_type == 'with-trashed') {
            $data->stores = Store::withTrashed()->latest()->get();
        }
        else {
            $data->stores = Store::latest()->get();
        }

        return view('system.companies.stores.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.stores.create', compact('data'));
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
            'store_name'    => 'required',
            'store_phone'   => 'required|unique:stores',
            'store_email'    => 'required',
            'time_open'    => 'required',
            'time_closed'    => 'required',
            'status'    => 'required',
        ]);

        Store::create($request->all());

        // Mail::to($request->email)->send(new RegisterUser($addedUser->name, $addedUser->account_no, $addedUser->email, $addedUser->api_token));

        return back()->with('success', 'Store created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.stores.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $store = Store::find($id);
        return view('system.companies.stores.edit', compact('store'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'store_name'    => 'required',
            'store_phone'   => 'required|unique:stores',
            'store_email'    => 'required',
            'time_open'    => 'required',
            'time_closed'    => 'required',
            'status'    => 'required',
        ]);

        $store = Store::find($id);

        // Store::update($request->all());

        // Mail::to($request->email)->send(new RegisterUser($addedUser->name, $addedUser->account_no, $addedUser->email, $addedUser->api_token));

        $store->store_name = $request->get('store_name');
        $store->store_phone = $request->get('store_phone');
        $store->store_email = $request->get('store_email');
        $store->time_open = $request->get('time_open');
        $store->time_closed = $request->get('time_closed');
        $store->status = $request->get('status');
        $store->save();

        return back()->with('success', 'Store updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $store = Store::find($id);
        $store->delete();        

        return back()->with('success', 'Store Deleted!');
    }

    public function importStores(Request $request)
    {
        $this->validate($request, [
            'stores_file' => 'required'
        ]);

        $dir = 'uploads/temp/files/';

        if( !File::isDirectory($dir) )
        {
            File::makeDirectory($dir, 0777, true, true);
            $file_to_write = 'temp-file-uploads.txt';
            $content_to_write = "This is the directory for the temporary uploads \nCreated on " . date('d-m-Y');
            $file = fopen($dir . '/' . $file_to_write,"w");
            fwrite($file, $content_to_write);
            fclose($file);
        }

        $header = NULL;
        $datas = array();

        if($file = $request->file('stores_file')){
            $store_name = $file->getClientOriginalName();
            $file->move($dir,$store_name);

            if ( $dir . $store_name ) {
                if (( $handle = fopen($dir . $store_name, 'r' )) !== FALSE)
                {
                    while (($row = fgetcsv($handle, 1000, ',')) !== FALSE)
                    {
                        if(!$header) {
                            $header = $row;
                        }
                        else {
                            $recd = array_combine($header, $row);
                            $recd['code']  = $this->getCode();
                            $recd['category_id'] = $this->getCategory( $recd['Category'] );
                            $recd['village_id'] = $this->getVillage( $recd['Village'] );
                            $recd['user_id'] = $this->getUser( $recd['User'] );
                            $datas[] = $recd;
                        }
                    }

                    fclose($handle);
                }

                foreach( $datas as $data ){
                    // save to the DB
                    $user = User::create([
                        'name'  => $data['Name'],
                        'telephone' => $data['Telephone'],
                        'password'  => bcrypt('password123'),
                        'username'  => substr(explode(' ', trim($data['Name']))[0], 0, 3) . $data['code']
                    ]);

                    $user->assignRole('store');

                    Store::create([
                        'user_id'   => $user->id,
                        'store_name' => $data['Name'] ?? null,
                        'store_phone' => $data['Telephone'] ?? null,
                        'store_email' => $data['Email'] ?? null,
                        'time_open' => $data['Time open'] ?? null,
                        'time_closed'   => $data['Time Closed'] ?? null,
                        'store_whatsapp'  => $data['Store Whatsapp'] ?? null,
                        'store_facebook'    =>  $data['Store Facebook'] ?? null,
                        'store_instagram'    =>  $data['Store Instagram'] ?? null,
                        'store_lat'    =>  $data['Store Latitude'] ?? null,
                        'store_long'    =>  $data['Store Longitude'] ?? null,
                        'store_description'    =>  $data['Store Description'] ?? null,
                        'status'    =>  $data['Status'] ?? null,
                        'category_id'    =>  $data['Category'] ?? null,
                        'village_id'    =>  $data['Village'] ?? null,
                        'user_id'    =>  $data['User'] ?? null,
                    ]);
                }

                File::delete($dir . $name);

                return back()->with('success', 'Stores have been uploaded successfully');
            }
        }

        return back()->with('danger', 'File not found, upload failed');
    }
}

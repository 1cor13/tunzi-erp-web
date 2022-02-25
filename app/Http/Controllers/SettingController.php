<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Country;
use App\Models\Invoice;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Tax;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $admin_data)
    {
        $admin_data->companies    = Company::latest()->take(10)->get();
        $admin_data->countries  = Country::latest()->take(10)->get();
        $admin_data->invoices  = Invoice::latest()->take(10)->get();
        $admin_data->categories = Category::latest()->take(10)->get();
        $admin_data->currencies = Currency::latest()->take(10)->get();
        $admin_data->taxes = Tax::latest()->take(10)->get();

        return view('system.companies.settings.index', compact(['admin_data']));
    }
}

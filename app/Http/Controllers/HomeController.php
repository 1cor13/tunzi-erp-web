<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use URL;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified','auth.companystatus']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->hasRole(['super-admin','admin'])) {
            if (URL::previous() == route('login')) {
                return redirect()->route('admin')->with('success','Welcome back ' . Auth::user()->name);
            }
            return redirect()->route('admin');
        }

        if (URL::previous() == route('login')) {
            return redirect()->route('userhome')->with('success','Welcome back ' . Auth::user()->name);
        }
        return view('home');
    }

    /**
     * Show the application user dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function userIndex()
    {
        return view('home');
    }
}

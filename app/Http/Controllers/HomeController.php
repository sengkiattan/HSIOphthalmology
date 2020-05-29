<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clinic;
use Validator;
use Session;
use Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $clinics = Clinic::all();
        // dd($clinics);
        return view('home', compact('clinics'));
    }
}

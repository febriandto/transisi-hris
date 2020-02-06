<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class BerandaController extends Controller
{
    //

    public function index(){
    	return view('dashboard.main');
    }

    public function dashboard(){
    	return view('dashboard');
    }
}

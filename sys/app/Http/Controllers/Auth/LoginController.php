<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;

use Auth;
use Session;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        // return Hash::make($request->password);
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            echo "Loading. . . ";
            return redirect('/dashboard');
        } else {
            Session::flash('flash_danger', 'Username atau Password salah.');
            // echo "Salah";
            return redirect()->back();
        }
        
    }

}

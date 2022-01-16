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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        // return Hash::make($request->password);
        if ( Auth::attempt(['username' => $request->username, 'password' => $request->password]) ) {
            
            // dd("ok");

            return redirect('/dashboard');

        } else {

            Session::flash('flash_danger');

            return redirect()->back()->with(['password' => 'Login gagal!']);
        }
        
    }

}

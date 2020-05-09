<?php

namespace App\Http\Controllers;

use App\Model\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Auth;

class ProfileController extends Controller
{

    public function index()
    {
        return view('profile');
    }

    protected function perbarui(Request $request)
    { 
            
            $user = Users::findOrFail($request->id_user); 
            
            
            $user->name        = $request->name_form;
            $user->username    = $request->username_form;
            $user->email       = $request->email_form;

            $user->update();

            toastr()->success('Berhasil Tersimpan');

            return redirect()->back();
    }

    protected function passwordreset(Request $request)
    { 
            
            $user = Users::findOrFail($request->id_user);

            if( $request->password_new === $request->password_repeat ){

                $user->password = Hash::make($request->password_new);

                $user->update();

                toastr()->success('Password saved successfully');

            }else{
                toastr()->error('The password failed to reset');
            }

            return redirect()->back();
    }

}

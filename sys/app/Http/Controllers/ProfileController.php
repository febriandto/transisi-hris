<?php

namespace App\Http\Controllers;

use App\Model\Users;
use App\Model\Warehouse\Warehouseplant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Auth;

class ProfileController extends Controller
{

    public function index()
    {

        $plant = Warehouseplant::where('is_delete', 'N')->get();

        return view('profile', compact('plant'));
    }

    protected function update(Request $request)
    { 
            
            $user = Users::findOrFail($request->id_user); 
            
            
            $user->name     = $request->name;
            $user->username = $request->username;
            $user->plant_id = $request->plant_id;

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

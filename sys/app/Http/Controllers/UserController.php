<?php

namespace App\Http\Controllers;

use App\Model\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use DataTables;
use Auth;

class UserController extends Controller
{

    public function index()
    {
        return view('master.user');
    }

    function datatables(Request $request)
    {   
        $data = array();
        $is_delete = $request->is_delete;

        $users = Users::where(['is_delete'=> $is_delete])->get();

        $no = 1;
        foreach($users as $users)
        {
            $users->no = $no++;
            if($is_delete == 'N')
            {
                $users->aksi = '
                    <a href="#" class="btn-edit" data-id ="'.$users->id.'"><i class="fa fa-edit"></i></a>&nbsp;
                    <a href="#" class="btn-hapus" data-id = "'.$users->id.'"><i class="fa fa-trash"></i></a>&nbsp;
                    <a href="#" class="btn-reset" data-id = "'.$users->id.'" title="password reset"><i class="fas fa-key"></i></a>
                ';
            }
            else
            {
                $users->aksi = '<a href="#" class="btn-restore" data-id = "' .$users->id_user. '"> <i class="fa fa-undo"></i> </a>';
            }

            $data[] = $users;
        }

        return datatables::of($data)->escapecolumns([])->make(true);
    }

    function simpan(Request $request)
    {
        $user = new Users;

        $user->id         = $request->id_form;
        $user->name       = $request->name_form;
        $user->username   = $request->username_form;
        $user->email      = $request->email_form;
        $user->password   = Hash::make($request->password_form);
        
        $user->input_by   = Auth::user()->username;
        $user->created_at = date('Y-m-d H:i:s');
        $user->save();

        return response()->json(['status' => 'success', 'user' => $user], 200);
    }

  protected function edit($id)
  {
        $user = Users::findOrFail($id);
        return response()->json(['status' => 'success', 'user' => $user], 200);
  }

  protected function perbarui($id, Request $request)
  { 
        
        $user = Users::findOrFail($request->id_form_before);

        $user->id          = $request->id_form;  
        $user->name        = $request->name_form;
        $user->username    = $request->username_form;
        $user->email       = $request->email_form;
        
        $user->edit_by     = Auth::user()->username;
        $user->edit_date   = date('Y-m-d H:i:s');

        $user->update();

        return response()->json(['status' => 'success'], 200);
  }

  protected function hapus($id)
  {
        $user = Users::findOrFail($id);
            
        $user->delete_by   = Auth::user()->username;
        $user->delete_date = date('Y-m-d H:i:s');
        $user->is_delete   = "Y";
        $user->update();

        return response()->json(['status' => 'success'], 200);
  }

  protected function restore($id)
  {
        $user = Users::findOrFail($id);
        $user->update(['is_delete' => 'N']);
        return response()->json(['status' => 'success', 200]);
  }
  
  protected function resetSave($id, Request $request){

    $user = Users::findOrFail($id);

    if ( $request->password_form_new == $request->password_form_new_repeat ) {

        $user->password  = Hash::make($request->password_form_new);
        
    }

    $user->update();

    return response()->json(['status' => 'success'], 200);

  }

}

<?php

namespace App\Http\Controllers;

use App\Model\Users;
use App\Model\Role;
use App\Model\Customer\Customermaster;
use App\Model\Warehouse\Warehouseplant;
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
            $users->roles = @$users->role->level;
            $users->plant = @$users->warehouseplant->plant_name;
            
            $users->created_at = date('d-m-Y', strtotime($users->created_at));
            if($is_delete == 'N')
            {
                $users->aksi = '
                    <a href="'.route("user.edit", ["id_user" => $users->id_user]).'" data-id ="'.$users->id_user.'"><i class="fa fa-edit"></i></a>&nbsp;
                    <a onclick="return confirm();" href="'.route("user.hapus", ["id_user" => $users->id_user]).'" data-id = "'.$users->id_user.'"><i class="fa fa-trash"></i></a>&nbsp;
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

    function add(){

        $customers = Customermaster::where('is_delete', 'N')->get();
        $role = Role::where('is_delete', 'N')->get();
        $warehouseplant = Warehouseplant::where('is_delete', 'N')->get();

        return view('master.add', compact('customers', 'role', 'warehouseplant'));
    }

    function simpan(Request $request)
    {
        $exist = Users::where('username', $request->username)->first();

        if ($exist == null) {

            if($request->password1 AND $request->password2){
            
                $user = new Users;

                $user->name     = $request->name;
                $user->username = $request->username;
                $user->level    = $request->level;
                $user->plant_id = $request->plant_id;
                $user->cust_id  = $request->cust_id;
                $user->id_role  = $request->id_role;
                $user->status   = 'active';
                $user->password = Hash::make($request->password1);

                $user->created_at = date('Y-m-d H:i:s');
                $user->save();

                toastr()->success('Tersimpan');

                return redirect(route('user.index'));

            }else{

                toastr()->error('Password Tidak Sama');
                return redirect()->back();

            }

        }else{
            toastr()->error('Username sudah digunakan');
            return redirect()->back();
        }

    }

  protected function edit(Request $request)
  {
        $user      = Users::findOrFail($request->id_user);
        $customers = Customermaster::where('is_delete', 'N')->get();
        $role = Role::where('is_delete', 'N')->get();
        $warehouseplant = Warehouseplant::where('is_delete', 'N')->get();

        return view('master.edit', compact('user', 'customers', 'role', 'warehouseplant'));
  }

  protected function perbarui(Request $request)
  { 
    
    // cek apakah username baru sudah ada
    $exist = Users::where('username', $request->username)->first();

    if ( $exist->username == $request->username_old ) {

        if( $request->id_role == 4 ){

            if($request->password1 == $request->password2){
        
                $user = Users::findOrFail($request->id_user);
        
                $user->id_user  = $request->id_user;
                $user->name     = $request->name;
                $user->username = $request->username;
                $user->plant_id = $request->plant_id;
                $user->cust_id  = $request->cust_id;
                $user->id_role  = $request->id_role;
                $user->password = Hash::make($request->password1);
                $user->update();
        
                toastr()->success('Tersimpan');
                return redirect(route('user.index'));
        
            }else{
        
                toastr()->error('Password Tidak Sama');
                return redirect()->back();
        
            }

        }else{
        
                $user = Users::findOrFail($request->id_user);
        
                $user->id_user  = $request->id_user;
                $user->name     = $request->name;
                $user->plant_id = $request->plant_id;
                $user->username = $request->username;
                $user->cust_id  = $request->cust_id;
                $user->id_role  = $request->id_role;
                $user->update();
        
                toastr()->success('Tersimpan');
                return redirect(route('user.index'));

        }


    }else{

        toastr()->error('Username sudah digunakan');
        return redirect()->back();

    }

  }

  protected function hapus()
  {
        $user = Users::findOrFail($_GET['id_user']);

        $user->is_delete   = "Y";
        $user->update();

        toastr()->success('Berhasil dihapus');
        return redirect()->back();
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

<?php

namespace App\Http\Controllers\Warehouse;

use App\Model\Warehouse\Pallet;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DataTables;
use Auth;

class PalletController extends Controller
{

    public function index()
    {
        return view('warehouse.pallet');
    }

    function datatables(Request $request)
    {   
        $data = array();

        $is_delete = $request->is_delete;

        $pallets = Pallet::where(['is_delete'=> $is_delete])->get();

        $no = 1;
        foreach($pallets as $pallet)
        {
            $pallet->no = $no++;
            if($is_delete == 'N')
            {
                $pallet->aksi = '
                    <a href="#" class="btn-edit" data-id ="'.$pallet->pallet_id.'"><i class="fa fa-edit"></i></a>&nbsp;
                    <a href="#" class="btn-hapus" data-id = "'.$pallet->pallet_id.'"><i class="fa fa-trash"></i></a>
                ';
            }
            else
            {
                $pallet->aksi = '<a href="#" class="btn-restore" data-id = "' .$pallet->pallet_id. '"> <i class="fa fa-undo"></i> </a>';
            }

            // change date format to day month year
            $pallet->input_date = date("d/m/Y", strtotime($pallet->input_date));

            $data[] = $pallet;
        }

        return datatables::of($data)->escapecolumns([])->make(true);
    }

    function simpan(Request $request)
    {
        $pallet = new Pallet;

        $pallet->pallet_id   = $request->pallet_id;
        $pallet->pallet_name = $request->pallet_name;
        $pallet->pallet_desc = $request->pallet_desc;
        
        $pallet->input_by   = Auth::user()->username;
        $pallet->input_date = date('Y-m-d H:i:s');
        $pallet->save();

        return response()->json(['status' => 'success', 'pallet' => $pallet], 200);
    }

  protected function edit($id)
  {
        $pallet = Pallet::findOrFail($id);
        return response()->json(['status' => 'success', 'pallet' => $pallet], 200);
  }

  protected function perbarui($id, Request $request)
  {
        
        $pallet = Pallet::findOrFail($request->pallet_id_before);

        $pallet->pallet_id   = $request->pallet_id;
        $pallet->pallet_name = $request->pallet_name;
        $pallet->pallet_desc = $request->pallet_desc;
        
        $pallet->edit_by   = Auth::user()->username;
        $pallet->edit_date = date('Y-m-d H:i:s');

        $pallet->update();

        return response()->json(['status' => 'success'], 200);
  }

  protected function hapus($id)
  {
        $pallet = Pallet::findOrFail($id);
            
        $pallet->del_by   = Auth::user()->username;
        $pallet->del_date = date('Y-m-d H:i:s');
        $pallet->is_delete   = "Y";
        $pallet->update();

        return response()->json(['status' => 'success'], 200);
  }

  protected function restore($id)
  {
        $pallet = Pallet::findOrFail($id);
        $pallet->update(['is_delete' => 'N']);
        return response()->json(['status' => 'success', 200]);
  }

}

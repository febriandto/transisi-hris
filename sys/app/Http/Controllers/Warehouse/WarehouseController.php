<?php

namespace App\Http\Controllers\Warehouse;

use App\Model\Warehouse\Warehouse;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DataTables;
use Auth;

class WarehouseController extends Controller
{

    public function index()
    {
        return view('warehouse.name');
    }

    function datatables(Request $request)
    {   
        $data = array();

        $is_delete = $request->is_delete;

        $wh = Warehouse::where(['is_delete'=> $is_delete])->get();

        $no = 1;
        foreach($wh as $wh)
        {
            $wh->no = $no++;
            if($is_delete == 'N')
            {
                $wh->aksi = '
                    <a href="#" class="btn-edit" data-id ="'.$wh->wh_id.'"><i class="fa fa-edit"></i></a>&nbsp;
                    <a href="#" class="btn-hapus" data-id = "'.$wh->wh_id.'"><i class="fa fa-trash"></i></a>
                ';
            }
            else
            {
                $wh->aksi = '<a href="#" class="btn-restore" data-id = "' .$wh->wh_id. '"> <i class="fa fa-undo"></i> </a>';
            }

            // change date format to day month year
            $wh->input_date = date("d/m/Y", strtotime($wh->input_date));

            $data[] = $wh;
        }

        return datatables::of($data)->escapecolumns([])->make(true);
    }

    function simpan(Request $request)
    {
        $Warehouse = new Warehouse;

        $Warehouse->wh_id          = $request->wh_id;
        $Warehouse->wh_name        = $request->wh_name;
        $Warehouse->wh_description = $request->wh_description;
        
        $Warehouse->input_by       = Auth::user()->username;
        $Warehouse->input_date     = date('Y-m-d H:i:s');
        $Warehouse->save();

        return response()->json(['status' => 'success', 'warehouse' => $Warehouse], 200);
    }

  protected function edit($id)
  {
        $Warehouse = Warehouse::findOrFail($id);
        return response()->json(['status' => 'success', 'warehouse' => $Warehouse], 200);
  }

  protected function perbarui($id, Request $request)
  {
        
        $Warehouse = Warehouse::findOrFail($request->wh_id_before);

        $Warehouse->wh_id          = $request->wh_id;  
        $Warehouse->wh_name        = $request->wh_name;
        $Warehouse->wh_description = $request->wh_description;
        
        $Warehouse->input_by       = Auth::user()->username;
        $Warehouse->input_date     = date('Y-m-d H:i:s');
        
        $Warehouse->edit_by        = Auth::user()->username;
        $Warehouse->edit_date      = date('Y-m-d H:i:s');

        $Warehouse->update();

        return response()->json(['status' => 'success'], 200);
  }

  protected function hapus($id)
  {
        $warehouse = Warehouse::findOrFail($id);
            
        $warehouse->del_by   = Auth::user()->username;
        $warehouse->del_date = date('Y-m-d H:i:s');
        $warehouse->is_delete   = "Y";
        $warehouse->update();

        return response()->json(['status' => 'success'], 200);
  }

  protected function restore($id)
  {
        $warehouse = Warehouse::findOrFail($id);
        $warehouse->update(['is_delete' => 'N']);
        return response()->json(['status' => 'success', 200]);
  }

}

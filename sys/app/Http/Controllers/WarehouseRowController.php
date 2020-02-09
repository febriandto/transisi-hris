<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DataTables;
use Auth;

use App\Model\Warehouserow;

class WarehouseRowController extends Controller
{
    public function index()
    {
    	return view('binlocation.warehouserow');
    }

    function datatables(Request $request)
    {   
        $data = array();

        $is_delete = $request->is_delete;

        $wh_row = Warehouserow::where(['is_delete'=> $is_delete])->get();

        $no = 1;
        foreach($wh_row as $wh_row)
        {
            $wh_row->no = $no++;
            if($is_delete == 'N')
            {
                $wh_row->aksi = '
                    <a href="#" class="btn-edit" data-id ="'.$wh_row->wh_row_id.'"><i class="fa fa-edit"></i></a>&nbsp;
                    <a href="#" class="btn-hapus" data-id = "'.$wh_row->wh_row_id.'"><i class="fa fa-trash"></i></a>
                ';
            }
            else
            {
                $wh_row->aksi = '<a href="#" class="btn-restore" data-id = "' .$wh_row->wh_row_id. '"> <i class="fa fa-undo"></i> </a>';
            }

            $data[] = $wh_row;
        }

        return datatables::of($data)->escapecolumns([])->make(true);
    
  }

  function simpan(Request $request)
  {
		$Warehouserow = new Warehouserow;

		$Warehouserow->wh_row_id 	 = $request->wh_row_id;
		$Warehouserow->wh_row_name = $request->wh_row_name;
		$Warehouserow->wh_row_desc = $request->wh_row_desc;
		$Warehouserow->wh_area_id  = $request->wh_area_id;

		$Warehouserow->input_by   = Auth::user()->username;
		$Warehouserow->input_date = date('Y-m-d H:i:s');
    $Warehouserow->save();

    return response()->json(['status' => 'success', 'warehouserow' => $Warehouserow], 200);
  }

  protected function edit($id)
  {
    $Warehouserow = Warehouserow::findOrFail($id);
    return response()->json(['status' => 'success', 'warehouserow' => $Warehouserow], 200);
  }

  protected function perbarui($id, Request $request)
  {
        
  	$Warehouserow = Warehouserow::findOrFail($request->wh_row_id_before);

		$Warehouserow->wh_row_id   = $request->wh_row_id;  
		$Warehouserow->wh_row_name = $request->wh_row_name;
		$Warehouserow->wh_area_id  = $request->wh_area_id;
		$Warehouserow->wh_row_desc = $request->wh_row_desc;
		
		$Warehouserow->input_by    = Auth::user()->username;
		$Warehouserow->input_date  = date('Y-m-d H:i:s');
		
		$Warehouserow->edit_by     = Auth::user()->username;
		$Warehouserow->edit_date   = date('Y-m-d H:i:s');

    $Warehouserow->update();

    return response()->json(['status' => 'success'], 200);
  }

  protected function hapus($id)
  {
    $warehouserow = Warehouserow::findOrFail($id);
        
    $warehouserow->delete_by   = Auth::user()->username;
    $warehouserow->delete_date = date('Y-m-d H:i:s');
    $warehouserow->is_delete   = "Y";
    $warehouserow->update();

    return response()->json(['status' => 'success'], 200);
  }

  protected function restore($id)
  {
    $warehouserow = Warehouserow::findOrFail($id);
    $warehouserow->update(['is_delete' => 'N']);
    return response()->json(['status' => 'success', 200]);
  }


}

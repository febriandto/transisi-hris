<?php

namespace App\Http\Controllers\Warehouse;

use App\Model\Warehouse\Warehousebin;
use App\Model\Warehouse\Warehouserow;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DataTables;
use Auth;

class WarehouseBinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $warehouserow = Warehouserow::where('is_delete', 'N')->pluck('wh_row_name', 'wh_row_id');

        return view('warehouse.bin', compact('warehouserow'));
    }

    function datatables(Request $request)
    {   
        $data = array();

        $is_delete = $request->is_delete;

        $wh_bins = Warehousebin::where(['is_delete'=> $is_delete])->get();

        $no = 1;
        foreach($wh_bins as $wh_bin)
        {
            $wh_bin->no = $no++;
            if($is_delete == 'N')
            {
                $wh_bin->aksi = '
                    <a href="#" class="btn-edit" data-id ="'.$wh_bin->wh_bin_id.'"><i class="fa fa-edit"></i></a>&nbsp;
                    <a href="#" class="btn-hapus" data-id = "'.$wh_bin->wh_bin_id.'"><i class="fa fa-trash"></i></a>
                ';
            }
            else
            {
                $wh_bin->aksi = '<a href="#" class="btn-restore" data-id = "' .$wh_bin->wh_bin_id. '"> <i class="fa fa-undo"></i> </a>';
            }

            // change date format to day month year
            $wh_bin->input_date = date("d/m/Y", strtotime($wh_bin->input_date));

            $wh_bin->wh_row_name = $wh_bin->warehouserow->wh_row_name;

            $data[] = $wh_bin;
        }

        return datatables::of($data)->escapecolumns([])->make(true);
    }

    function simpan(Request $request)
    {
        $wh_bin = new Warehousebin;

        $wh_bin->wh_bin_id   = $request->wh_bin_id;
        $wh_bin->wh_bin_name = $request->wh_bin_name;
        $wh_bin->wh_bin_desc = $request->wh_bin_desc;
        $wh_bin->wh_row_id   = $request->wh_row_id;
        
        $wh_bin->input_by     = Auth::user()->username;
        $wh_bin->input_date   = date('Y-m-d H:i:s');
        $wh_bin->save();

        return response()->json(['status' => 'success', 'warehousebin' => $wh_bin], 200);
    }

    protected function edit($id)
    {
        $wh_bin = Warehousebin::findOrFail($id);
        return response()->json(['status' => 'success', 'warehousebin' => $wh_bin], 200);
    }

    protected function perbarui($id, Request $request)
    {
            
        $wh_bin = Warehousebin::findOrFail($request->wh_bin_id_before);
            
        $wh_bin->wh_bin_id   = $request->wh_bin_id;
        $wh_bin->wh_bin_name = $request->wh_bin_name;
        $wh_bin->wh_bin_desc = $request->wh_bin_desc;
        $wh_bin->wh_row_id   = $request->wh_row_id;
            
        $wh_bin->input_by     = Auth::user()->username;
        $wh_bin->input_date   = date('Y-m-d H:i:s');
            
        $wh_bin->edit_by      = Auth::user()->username;
        $wh_bin->edit_date    = date('Y-m-d H:i:s');

        $wh_bin->update();

        return response()->json(['status' => 'success'], 200);
    }

    protected function hapus($id)
    {
        $wh_bin = Warehousebin::findOrFail($id);
                
        $wh_bin->del_by    = Auth::user()->username;
        $wh_bin->del_date  = date('Y-m-d H:i:s');
        $wh_bin->is_delete = "Y";
        $wh_bin->update();

        return response()->json(['status' => 'success'], 200);
    }

    protected function restore($id)
    {
        $wh_bin = Warehousebin::findOrFail($id);
        $wh_bin->update(['is_delete' => 'N']);
        return response()->json(['status' => 'success', 200]);
    }

}

<?php

namespace App\Http\Controllers\Warehouse;

use App\Model\Warehouse\Warehousearea;
use App\Model\Warehouse\Warehousezone;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DataTables;
use Auth;

class WarehouseAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //get value of table wms_warehouse_zone to use in selectoption 
        $warehousezone = Warehousezone::where('is_delete', 'N')->pluck('wh_zone_name', 'wh_zone_id');

        return view('warehouse.area', compact('warehousezone'));
    }

    function datatables(Request $request)
    {   
        $data = array();

        $is_delete = $request->is_delete;

        $wh_area = Warehousearea::where(['is_delete'=> $is_delete])->get();

        $no = 1;
        foreach($wh_area as $wh_area)
        {
            $wh_area->no = $no++;
            if($is_delete == 'N')
            {
                $wh_area->aksi = '
                    <a href="#" class="btn-edit" data-id ="'.$wh_area->wh_area_id.'"><i class="fa fa-edit"></i></a>&nbsp;
                    <a href="#" class="btn-hapus" data-id = "'.$wh_area->wh_area_id.'"><i class="fa fa-trash"></i></a>
                ';
            }
            else
            {
                $wh_area->aksi = '<a href="#" class="btn-restore" data-id = "' .$wh_area->wh_area_id. '"> <i class="fa fa-undo"></i> </a>';
            }

            // change date format to day month year
            $wh_area->input_date = date("d/m/Y", strtotime($wh_area->input_date));
            
            // relation to table wms_m_warehousezone
            $wh_area->wh_zone_name = $wh_area->warehousezone->wh_zone_name;

            $data[] = $wh_area;
        }

        return datatables::of($data)->escapecolumns([])->make(true);
    
  }

      function simpan(Request $request)
      {
        $Warehousearea = new Warehousearea;

        $Warehousearea->wh_area_id   = $request->wh_area_id;
        $Warehousearea->wh_area_name = $request->wh_area_name;
        $Warehousearea->wh_area_desc = $request->wh_area_desc;
        $Warehousearea->wh_zone_id   = $request->wh_zone_id;
        
        $Warehousearea->input_by     = Auth::user()->username;
        $Warehousearea->input_date   = date('Y-m-d H:i:s');
        $Warehousearea->save();

        return response()->json(['status' => 'success', 'warehousearea' => $Warehousearea], 200);
      }

      protected function edit($id)
      {
        $Warehousearea = Warehousearea::findOrFail($id);
        return response()->json(['status' => 'success', 'warehousearea' => $Warehousearea], 200);
      }

      protected function perbarui($id, Request $request)
      {
            
        $Warehousearea = Warehousearea::findOrFail($request->wh_area_id_before);

        $Warehousearea->wh_area_id   = $request->wh_area_id;  
        $Warehousearea->wh_area_name = $request->wh_area_name;
        $Warehousearea->wh_zone_id   = $request->wh_zone_id;
        $Warehousearea->wh_area_desc = $request->wh_area_desc;
            
        $Warehousearea->input_by    = Auth::user()->username;
        $Warehousearea->input_date  = date('Y-m-d H:i:s');
            
        $Warehousearea->edit_by     = Auth::user()->username;
        $Warehousearea->edit_date   = date('Y-m-d H:i:s');

        $Warehousearea->update();

        return response()->json(['status' => 'success'], 200);
      }

      protected function hapus($id)
      {
        $warehousearea = Warehousearea::findOrFail($id);
            
        $warehousearea->del_by    = Auth::user()->username;
        $warehousearea->del_date  = date('Y-m-d H:i:s');
        $warehousearea->is_delete = "Y";
        $warehousearea->update();

        return response()->json(['status' => 'success'], 200);
      }

      protected function restore($id)
      {
        $warehousearea = Warehousearea::findOrFail($id);
        $warehousearea->update(['is_delete' => 'N']);
        return response()->json(['status' => 'success', 200]);
      }

}

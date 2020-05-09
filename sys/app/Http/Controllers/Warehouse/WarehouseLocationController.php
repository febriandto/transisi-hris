<?php

namespace App\Http\Controllers\Warehouse;

use App\Model\Warehouse\Warehouse;
use App\Model\Warehouse\Warehouserow;
use App\Model\Warehouse\Warehousearea;
use App\Model\Warehouse\Warehousezone;
use App\Model\Warehouse\Warehouseplant;

use App\Model\Warehouse\Warehouselocation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DataTables;
use Auth;

class WarehouseLocationController extends Controller
{

    public function index()
    {   
        $warehousename  = Warehouse::where('is_delete', 'N')->pluck('wh_name', 'wh_id');
        $warehouserow   = Warehouserow::where('is_delete', 'N')->pluck('wh_row_name', 'wh_row_id');
        $warehouseplant = Warehouseplant::where('is_delete', 'N')->pluck('plant_name', 'plant_id');
        $warehousezone  = Warehousezone::where('is_delete', 'N')->pluck('wh_zone_name', 'wh_zone_id');
        $warehousearea  = Warehousearea::where('is_delete', 'N')->pluck('wh_area_name', 'wh_area_id');

        return view('warehouse.location', compact('warehousename', 'warehouserow', 'warehouseplant', 'warehousezone', 'warehousearea'));
    }

    function datatables(Request $request)
    {   
        $data = array();

        $is_delete = $request->is_delete;

        $wh_locations = Warehouselocation::where(['is_delete'=> $is_delete])->get();

        $no = 1;
        foreach($wh_locations as $wh_location)
        {
            $wh_location->no = $no++;
            if($is_delete == 'N')
            {
                $wh_location->aksi = '
                    <a href="#" class="btn-edit" data-id ="'.$wh_location->location_id.'"><i class="fa fa-edit"></i></a>&nbsp;
                    <a href="#" class="btn-hapus" data-id = "'.$wh_location->location_id.'"><i class="fa fa-trash"></i></a>
                ';
            }
            else
            {
                $wh_location->aksi = '<a href="#" class="btn-restore" data-id = "' .$wh_location->location_id. '"> <i class="fa fa-undo"></i> </a>';
            }

            // warehouse plant
            $wh_location->plant_name   = $wh_location->warehouseplant->plant_name;
            // warehouse name
            $wh_location->wh_name      = $wh_location->warehouse->wh_name;
            // warehouse zone
            $wh_location->wh_zone_name = $wh_location->warehousezone->wh_zone_name;
            // warehouse area
            $wh_location->wh_area_name = $wh_location->warehousearea->wh_area_name;
            // warehouse row
            $wh_location->wh_row_name  = $wh_location->warehouserow->wh_row_name;

            // change date format to day month year
            $wh_location->input_date = date("d/m/Y", strtotime($wh_location->input_date));

            $data[] = $wh_location;
        }

        return datatables::of($data)->escapecolumns([])->make(true);
    }

    function simpan(Request $request)
    {
        $wh_location = new Warehouselocation;

        $wh_location->location_id   = $request->location_id;
        $wh_location->location_name = $request->location_name;
        $wh_location->location_rmk  = $request->location_rmk;

        $wh_location->wh_id      = $request->wh_id;
        $wh_location->wh_zone_id = $request->wh_zone_id;
        $wh_location->wh_row_id  = $request->wh_row_id;
        $wh_location->wh_area_id = $request->wh_area_id;
        $wh_location->plant_id   = $request->plant_id;
        
        $wh_location->input_by   = Auth::user()->username;
        $wh_location->input_date = date('Y-m-d H:i:s');
        $wh_location->save();

        return response()->json(['status' => 'success', 'warehouselocation' => $wh_location], 200);
    }

  protected function edit($id)
  {
        $wh_location = Warehouselocation::findOrFail($id);
        return response()->json(['status' => 'success', 'warehouselocation' => $wh_location], 200);
  }

  protected function perbarui($id, Request $request)
  {
        
        $wh_location = Warehouselocation::findOrFail($request->location_id_before);

        $wh_location->location_id   = $request->location_id;
        $wh_location->location_name = $request->location_name;
        $wh_location->location_rmk  = $request->location_rmk;

        $wh_location->wh_id      = $request->wh_id;
        $wh_location->wh_zone_id = $request->wh_zone_id;
        $wh_location->wh_row_id  = $request->wh_row_id;
        $wh_location->wh_area_id = $request->wh_area_id;
        $wh_location->plant_id   = $request->plant_id;
        
        $wh_location->edit_by        = Auth::user()->username;
        $wh_location->edit_date      = date('Y-m-d H:i:s');

        $wh_location->update();

        return response()->json(['status' => 'success'], 200);
  }

  protected function hapus($id)
  {
        $wh_location = Warehouselocation::findOrFail($id);
            
        $wh_location->del_by   = Auth::user()->username;
        $wh_location->del_date = date('Y-m-d H:i:s');
        $wh_location->is_delete   = "Y";
        $wh_location->update();

        return response()->json(['status' => 'success'], 200);
  }

  protected function restore($id)
  {
        $wh_location = Warehouselocation::findOrFail($id);
        $wh_location->update(['is_delete' => 'N']);
        return response()->json(['status' => 'success', 200]);
  }

}

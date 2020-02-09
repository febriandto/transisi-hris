<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DataTables;
use Auth;

use App\Model\Warehousezone;
use App\Model\Warehouse;

class WarehouseZoneController extends Controller
{
    public function index()
    {   
        $warehouse = Warehouse::where('is_delete', 'N')->pluck('wh_name', 'wh_id');

    	return view('binlocation.warehousezone', compact('warehouse'));
    }

    function datatables(Request $request)
    {   
        $data = array();

        $is_delete = $request->is_delete;

        $wh_zone = Warehousezone::where(['is_delete'=> $is_delete])->get();

        $no = 1;
        foreach($wh_zone as $wh_zone)
        {
            $wh_zone->no = $no++;
            if($is_delete == 'N')
            {
                $wh_zone->aksi = '
                    <a href="#" class="btn-edit" data-id ="'.$wh_zone->wh_zone_id.'"><i class="fa fa-edit"></i></a>&nbsp;
                    <a href="#" class="btn-hapus" data-id = "'.$wh_zone->wh_zone_id.'"><i class="fa fa-trash"></i></a>
                ';
            }
            else
            {
                $wh_zone->aksi = '<a href="#" class="btn-restore" data-id = "' .$wh_zone->wh_zone_id. '"> <i class="fa fa-undo"></i> </a>';
            }

            $data[] = $wh_zone;
        }

        return datatables::of($data)->escapecolumns([])->make(true);
    
    }

    function simpan(Request $request)
    {
				$Warehousezone = new Warehousezone;

				$Warehousezone->wh_zone_name = $request->wh_zone_name;
				$Warehousezone->wh_id        = $request->wh_id;
				$Warehousezone->wh_zone_desc = $request->wh_zone_desc;

				$Warehousezone->input_by   = Auth::user()->username;
				$Warehousezone->input_date = date('Y-m-d H:i:s');
        $Warehousezone->save();

        return response()->json(['status' => 'success', 'warehousezone' => $Warehousezone], 200);
    }

    protected function hapus($id)
    {
        $warehousezone = Warehousezone::findOrFail($id);
        
        $warehousezone->delete_by   = Auth::user()->username;
        $warehousezone->delete_date = date('Y-m-d H:i:s');
        $warehousezone->is_delete   = "Y";
        $warehousezone->update();

        return response()->json(['status' => 'success'], 200);
    }

    protected function edit($id)
    {
        $Warehousezone = Warehousezone::findOrFail($id);
        return response()->json(['status' => 'success', 'warehousezone' => $Warehousezone], 200);
    }

    protected function perbarui($id, Request $request)
    {
        
        $Warehousezone = Warehousezone::findOrFail($request->wh_zone_id_before);

        $Warehousezone->wh_zone_id 	 = $request->wh_zone_id;        
        $Warehousezone->wh_zone_name = $request->wh_zone_name;
		$Warehousezone->wh_id        = $request->wh_id;
		$Warehousezone->wh_zone_desc = $request->wh_zone_desc;

		$Warehousezone->input_by   = Auth::user()->username;
		$Warehousezone->input_date = date('Y-m-d H:i:s');

		$Warehousezone->edit_by   = Auth::user()->username;
		$Warehousezone->edit_date = date('Y-m-d H:i:s');

        $Warehousezone->update();

        return response()->json(['status' => 'success'], 200);
    }

    protected function restore($id)
    {
        $warehousezone = Warehousezone::findOrFail($id);
        $warehousezone->update(['is_delete' => 'N']);
        return response()->json(['status' => 'success', 200]);
    }
}

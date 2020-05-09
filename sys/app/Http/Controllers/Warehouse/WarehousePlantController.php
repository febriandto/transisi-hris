<?php

namespace App\Http\Controllers\Warehouse;

use App\Model\Warehouse\Warehouseplant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DataTables;
use Auth;

class WarehousePlantController extends Controller
{

    public function index()
    {
        return view('warehouse.plant');
    }

    function datatables(Request $request)
    {   
        $data = array();

        $is_delete = $request->is_delete;

        $wh_plants = Warehouseplant::where(['is_delete'=> $is_delete])->get();

        $no = 1;
        foreach($wh_plants as $wh_plant)
        {
            $wh_plant->no = $no++;
            if($is_delete == 'N')
            {
                $wh_plant->aksi = '
                    <a href="#" class="btn-edit" data-id ="'.$wh_plant->plant_id.'"><i class="fa fa-edit"></i></a>&nbsp;
                    <a href="#" class="btn-hapus" data-id = "'.$wh_plant->plant_id.'"><i class="fa fa-trash"></i></a>
                ';
            }
            else
            {
                $wh_plant->aksi = '<a href="#" class="btn-restore" data-id = "' .$wh_plant->plant_id. '"> <i class="fa fa-undo"></i> </a>';
            }

            // change date format to day month year
            $wh_plant->input_date = date("d/m/Y", strtotime($wh_plant->input_date));

            $data[] = $wh_plant;
        }

        return datatables::of($data)->escapecolumns([])->make(true);
    }

    function simpan(Request $request)
    {
        $Warehouseplant = new Warehouseplant;

        $Warehouseplant->plant_id          = $request->plant_id;
        $Warehouseplant->plant_name        = $request->plant_name;
        $Warehouseplant->plant_description = $request->plant_description;
        $Warehouseplant->plant_rmk         = $request->plant_rmk;
        
        $Warehouseplant->input_by       = Auth::user()->username;
        $Warehouseplant->input_date     = date('Y-m-d H:i:s');
        $Warehouseplant->save();

        return response()->json(['status' => 'success', 'warehouseplant' => $Warehouseplant], 200);
    }

  protected function edit($id)
  {
        $Warehouseplant = Warehouseplant::findOrFail($id);
        return response()->json(['status' => 'success', 'warehouseplant' => $Warehouseplant], 200);
  }

  protected function perbarui($id, Request $request)
  {
        
        $Warehouseplant = Warehouseplant::findOrFail($request->plant_id_before);

        $Warehouseplant->plant_id          = $request->plant_id;  
        $Warehouseplant->plant_name        = $request->plant_name;
        $Warehouseplant->plant_description = $request->plant_description;
        $Warehouseplant->plant_rmk         = $request->plant_rmk;
        
        $Warehouseplant->edit_by        = Auth::user()->username;
        $Warehouseplant->edit_date      = date('Y-m-d H:i:s');

        $Warehouseplant->update();

        return response()->json(['status' => 'success'], 200);
  }

  protected function hapus($id)
  {
        $warehouseplant = Warehouseplant::findOrFail($id);
            
        $warehouseplant->del_by   = Auth::user()->username;
        $warehouseplant->del_date = date('Y-m-d H:i:s');
        $warehouseplant->is_delete   = "Y";
        $warehouseplant->update();

        return response()->json(['status' => 'success'], 200);
  }

  protected function restore($id)
  {
        $warehouseplant = Warehouseplant::findOrFail($id);
        $warehouseplant->update(['is_delete' => 'N']);
        return response()->json(['status' => 'success', 200]);
  }

}

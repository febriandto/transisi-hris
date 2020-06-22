<?php

namespace App\Http\Controllers\Warehouse;

use App\Model\Warehouse\Warehouseplant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DataTables;
use Auth;
use DB;

class WarehousePlantController extends Controller
{

    public function index()
    {
        $warehouse_plant = DB::select(" SELECT * FROM wms_m_plant WHERE is_delete = 'N' ");

        return view('warehouse_plant.all', compact('warehouse_plant'));
    }

    public function add(){ 

        $plant_id = DB::select(" SELECT count(*)+1 as 'a' FROM wms_m_plant ");
        $plant_id = sprintf('%04s', $plant_id[0]->a);

        return view('warehouse_plant.add', compact('plant_id'));

    }

    protected function save(Request $request){

        $Warehouseplant = new Warehouseplant;

        $Warehouseplant->plant_id          = $request->plant_id;
        $Warehouseplant->plant_name        = $request->plant_name;
        $Warehouseplant->plant_description = $request->plant_description;
        $Warehouseplant->plant_rmk         = $request->plant_rmk;

        $Warehouseplant->input_by   = Auth::user()->username;
        $Warehouseplant->input_date = date('Y-m-d H:i:s');
        $Warehouseplant->save();

        toastr()->success('Warehouse Plant created successfully');

        return redirect( route('warehouseplant.index') );

    }

    public function edit(Warehouseplant $warehouseplant){

        return view('warehouse_plant.edit', compact('warehouseplant'));

    }

    protected function update(Request $request){

        DB::table('wms_m_plant')->where('plant_id', $request->plant_id)->update([

        'plant_name'        => $request->plant_name,
        'plant_description' => $request->plant_description,
        'plant_rmk'         => $request->plant_rmk,
        
        'edit_by'   => Auth::user()->username,
        'edit_date' => date('Y-m-d H:i:s')

    ]);

        toastr()->success('Edit successfully');

        return redirect( route('warehouseplant.index') );

    }

    protected function delete(Request $request){

        DB::table('wms_m_plant')->where('plant_id', $request->plant_id)->update([

            'is_delete' => 'Y',
            'del_by'    => Auth::user()->username,
            'del_date'  => date('Y-m-d H:i:s')

        ]);

        toastr()->success('Delete Success');

        return redirect( route('warehouseplant.index') );

    }


}

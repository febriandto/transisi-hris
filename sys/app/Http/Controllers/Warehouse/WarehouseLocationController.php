<?php

namespace App\Http\Controllers\Warehouse;

use App\Model\Warehouse\Warehouselocation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DataTables;
use Auth;
use DB;

class WarehouseLocationController extends Controller
{

    public function index()
    {   
        $location  = Warehouselocation::where('is_delete', 'N')->get();

        return view('location.all', compact('location'));
    }

    public function add()
    { 
        $warehouse_plant  = DB::select(" SELECT * FROM wms_m_plant WHERE is_delete = 'N' ");
        $warehouse_name   = DB::select(" SELECT * FROM wms_m_warehouse WHERE is_delete = 'N' ");
        $warehouse_bin    = DB::select(" SELECT * FROM wms_m_bin WHERE is_delete = 'N' ");
        $warehouse_row    = DB::select(" SELECT * FROM wms_m_row WHERE is_delete = 'N' ");
        $warehouse_column = DB::select(" SELECT * FROM wms_m_column WHERE is_delete = 'N' ");
        $warehouse_level  = DB::select(" SELECT * FROM wms_m_level WHERE is_delete = 'N' ");
        $warehouse_zone   = DB::select(" SELECT * FROM wms_m_zone WHERE is_delete = 'N' ");

        $location_id = DB::select(" SELECT count(*)+1 as 'a' FROM wms_m_location ");
        $location_id = sprintf('%04s', $location_id[0]->a);

        return view('location.add', 
            compact(
                'warehouse_plant',
                'warehouse_name',
                'warehouse_bin',
                'warehouse_row',
                'warehouse_column',
                'warehouse_level',
                'warehouse_zone',
                'location_id'
            )
        );

    }

    protected function save(Request $request){

        $Location = new Warehouselocation;

        $Location->location_id   = $request->location_id;
        $Location->location_code = $request->location_code;
        $Location->location_name = $request->location_name;
        $Location->location_desc = $request->location_desc;
        $Location->wh_area_id    = $request->wh_area_id;
        $Location->zone_id       = $request->zone_id;
        $Location->plant_id      = $request->plant_id;
        $Location->wh_row_id     = $request->wh_row_id;
        $Location->bin_loc_id    = $request->bin_loc_id;
        $Location->level_id      = $request->level_id;
        $Location->col_id        = $request->col_id;
        $Location->location_rmk  = $request->location_rmk;
        $Location->pallet_id     = $request->pallet_id;
        $Location->location_fill = $request->location_fill;

        $Location->input_by   = Auth::user()->username;
        $Location->input_date = date('Y-m-d H:i:s');
        $Location->save();

        toastr()->success('Location created successfully');

        return redirect( route('location.index') );

    }

    public function edit(Warehouselocation $location)
    {

        $warehouse_plant  = DB::select(" SELECT * FROM wms_m_plant WHERE is_delete = 'N' ");
        
        $warehouse_area   = DB::select(" SELECT * FROM wms_m_area WHERE is_delete = 'N' ");

        $warehouse_bin    = DB::select(" SELECT * FROM wms_m_bin WHERE is_delete = 'N' ");
        $warehouse_row    = DB::select(" SELECT * FROM wms_m_row WHERE is_delete = 'N' ");
        $warehouse_column = DB::select(" SELECT * FROM wms_m_column WHERE is_delete = 'N' ");
        $warehouse_level  = DB::select(" SELECT * FROM wms_m_level WHERE is_delete = 'N' ");
        $warehouse_zone   = DB::select(" SELECT * FROM wms_m_zone WHERE is_delete = 'N' ");

        return view('location.edit', 
            compact(
                'location',
                'warehouse_plant',
                'warehouse_area',
                'warehouse_bin',
                'warehouse_row',
                'warehouse_column',
                'warehouse_level',
                'warehouse_zone'
            )
        );

    }

    protected function update(Request $request){

        DB::table('wms_m_location')->where('location_id', $request->location_id)->update([

            'location_code' => $request->location_code,
            'location_name' => $request->location_name,
            'location_desc' => $request->location_desc,
            'wh_area_id'    => $request->wh_area_id,
            'zone_id'       => $request->zone_id,
            'plant_id'      => $request->plant_id,
            'wh_row_id'     => $request->wh_row_id,
            'bin_loc_id'    => $request->bin_loc_id,
            'level_id'      => $request->level_id,
            'col_id'        => $request->col_id,
            'location_rmk'  => $request->location_rmk,
            'pallet_id'     => $request->pallet_id,
            'location_fill' => $request->location_fill,

            'edit_by'    => Auth::user()->username,
            'edit_date'  => date('Y-m-d H:i:s')

        ]);

        toastr()->success('Edit successfully');

        return redirect( route('location.index') );

    }

    protected function delete(Request $request){

        DB::table('wms_m_location')->where('location_id', $request->location_id)->update([

          'is_delete' => 'Y',
          'del_by'    => Auth::user()->username,
          'del_date'  => date('Y-m-d H:i:s')

      ]);

        toastr()->success('Delete Success');

        return redirect( route('location.index') );

    }



}

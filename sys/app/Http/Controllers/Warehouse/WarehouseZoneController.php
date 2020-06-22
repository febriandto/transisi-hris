<?php

namespace App\Http\Controllers\Warehouse;

use App\Model\Warehouse\Warehousezone;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DataTables;
use Auth;
use DB;

class WarehouseZoneController extends Controller
{

    public function index()
    {
        $warehouse_zone = DB::select(" SELECT * FROM wms_m_zone where is_delete = 'N' ");

        return view('warehouse_zone.all', compact('warehouse_zone'));
    }

    public function add()
    { 

        return view('warehouse_zone.add');

    }

    protected function save(Request $request)
    {

        $Warehousezone = new Warehousezone;
        
        $Warehousezone->zone_id      = $request->zone_id;
        $Warehousezone->zone_name    = $request->zone_name;
        $Warehousezone->zone_desc    = $request->zone_desc;
        
        $Warehousezone->input_by   = Auth::user()->username;
        $Warehousezone->input_date = date('Y-m-d H:i:s');
        $Warehousezone->save();

        toastr()->success('Warehouse Zone created successfully');

        return redirect( route('warehousezone.index') );

    }

    public function edit(Warehousezone $warehousezone)
    {
        return view('warehouse_zone.edit', compact('warehousezone'));
    }

    protected function update(Request $request){

        DB::table('wms_m_zone')->where('zone_id', $request->zone_id)->update([

        'zone_id'     => $request->zone_id,
        'zone_name'   => $request->zone_name,
        'zone_desc'   => $request->zone_desc,
        
        'edit_by'   => Auth::user()->username,
        'edit_date' => date('Y-m-d H:i:s')

    ]);

        toastr()->success('Edit successfully');

        return redirect( route('warehousezone.index') );

    }

    protected function delete(Request $request){

        DB::table('wms_m_zone')->where('zone_id', $request->zone_id)->update([

            'is_delete' => 'Y',
            'del_by'    => Auth::user()->username,
            'del_date'  => date('Y-m-d H:i:s')

        ]);

        toastr()->success('Delete Success');

        return redirect( route('warehousezone.index') );

    }


}

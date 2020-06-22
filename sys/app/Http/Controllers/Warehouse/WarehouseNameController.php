<?php

namespace App\Http\Controllers\Warehouse;

use App\Model\Warehouse\Warehousename;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DataTables;
use Auth;
use DB;

class WarehouseNameController extends Controller
{

    public function index()
    {
        $warehouse_name = DB::select(" SELECT * FROM wms_m_warehouse where is_delete = 'N' ");

        return view('warehouse_name.all', compact('warehouse_name'));
    }

    public function add()
    { 

        return view('warehouse_name.add');

    }

    protected function save(Request $request){

        $Warehousename = new Warehousename;
        
        $Warehousename->wh_id      = $request->wh_id;
        $Warehousename->wh_name    = $request->wh_name;
        $Warehousename->wh_desc    = $request->wh_desc;
        
        $Warehousename->input_by   = Auth::user()->username;
        $Warehousename->input_date = date('Y-m-d H:i:s');
        $Warehousename->save();

        toastr()->success('Warehouse Name created successfully');

        return redirect( route('warehousename.index') );

    }

    public function edit(Warehousename $warehousename)
    {
        return view('warehouse_name.edit', compact('warehousename'));
    }

    protected function update(Request $request){

        DB::table('wms_m_warehouse')->where('wh_id', $request->wh_id)->update([

        'wh_id'     => $request->wh_id,
        'wh_name'   => $request->wh_name,
        'wh_desc'   => $request->wh_desc,
        
        'edit_by'   => Auth::user()->username,
        'edit_date' => date('Y-m-d H:i:s')

    ]);

        toastr()->success('Edit successfully');

        return redirect( route('warehousename.index') );

    }

    protected function delete(Request $request){

        DB::table('wms_m_warehouse')->where('wh_id', $request->wh_id)->update([

            'is_delete' => 'Y',
            'del_by'    => Auth::user()->username,
            'del_date'  => date('Y-m-d H:i:s')

        ]);

        toastr()->success('Delete Success');

        return redirect( route('warehousename.index') );

    }


}

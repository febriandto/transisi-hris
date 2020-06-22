<?php

namespace App\Http\Controllers\Warehouse;

use App\Model\Warehouse\Warehousebin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DataTables;
use Auth;
use DB;

class WarehouseBinController extends Controller
{

    public function index()
    {
        $warehouse_bin = Warehousebin::where('is_delete', 'N')->get();

        return view('warehouse_bin.all', compact('warehouse_bin'));
    }

    public function add()
    { 

        return view('warehouse_bin.add');

    }

    protected function save(Request $request){

        $Warehousebin = new Warehousebin;

        $Warehousebin->bin_loc_name = $request->bin_loc_name;
        $Warehousebin->bin_loc_desc = $request->bin_loc_desc;

        $Warehousebin->input_by   = Auth::user()->username;
        $Warehousebin->input_date = date('Y-m-d H:i:s');
        $Warehousebin->save();

        toastr()->success('Warehouse Bin created successfully');

        return redirect( route('warehousebin.index') );

    }

    public function edit(Warehousebin $warehousebin)
    {
        return view('warehouse_bin.edit', compact('warehousebin') );
    }

    protected function update(Request $request){

        DB::table('wms_m_bin')->where('bin_loc_id', $request->bin_loc_id)->update([

          'bin_loc_name' => $request->bin_loc_name,
          'bin_loc_desc' => $request->bin_loc_desc,
          
          'edit_by'      => Auth::user()->username,
          'edit_date'    => date('Y-m-d H:i:s')

      ]);

        toastr()->success('Edit successfully');

        return redirect( route('warehousebin.index') );

    }

    protected function delete(Request $request){

        DB::table('wms_m_bin')->where('bin_loc_id', $request->bin_loc_id)->update([

          'is_delete' => 'Y',
          'del_by'    => Auth::user()->username,
          'del_date'  => date('Y-m-d H:i:s')

      ]);

        toastr()->success('Delete Success');

        return redirect( route('warehousebin.index') );

    }

}

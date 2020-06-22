<?php

namespace App\Http\Controllers\Warehouse;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DataTables;
use Auth;
use DB;

use App\Model\Warehouse\Warehouserow;

class WarehouseRowController extends Controller
{
  public function index(){

    $warehouse_row = DB::select(" SELECT * FROM wms_m_row WHERE is_delete = 'N' ");

    return view('warehouse_row.all', compact('warehouse_row'));

  }

 public function add(){ 

  return view('warehouse_row.add');

}

protected function save(Request $request){

  $Warehouserow = new Warehouserow;

  $Warehouserow->wh_row_id   = $request->wh_row_id;
  $Warehouserow->wh_row_name = $request->wh_row_name;
  $Warehouserow->wh_row_desc = $request->wh_row_desc;
  
  $Warehouserow->input_by    = Auth::user()->username;
  $Warehouserow->input_date  = date('Y-m-d H:i:s');
  $Warehouserow->save();

  toastr()->success('Warehouse Row created successfully');

  return redirect( route('warehouserow.index') );

}

public function edit(Warehouserow $warehouserow){

  return view('warehouse_row.edit', compact('warehouserow'));

}

protected function update(Request $request){

  DB::table('wms_m_row')->where('wh_row_id', $request->wh_row_id)->update([
    
    'wh_row_name' => $request->wh_row_name,
    'wh_row_desc' => $request->wh_row_desc,

    'edit_by'   => Auth::user()->username,
    'edit_date' => date('Y-m-d H:i:s')

  ]);

  toastr()->success('Edit successfully');

  return redirect( route('warehouserow.index') );

}

protected function delete(Request $request){

  DB::table('wms_m_row')->where('wh_row_id', $request->wh_row_id)->update([

    'is_delete' => 'Y',
    'del_by'    => Auth::user()->username,
    'del_date'  => date('Y-m-d H:i:s')

  ]);

  toastr()->success('Delete Success');

  return redirect( route('warehouserow.index') );

}


}

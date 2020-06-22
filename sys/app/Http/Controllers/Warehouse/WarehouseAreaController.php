<?php

namespace App\Http\Controllers\Warehouse;

use App\Model\Warehouse\Warehousearea;
use App\Model\Warehouse\Warehousezone;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DataTables;
use Auth;
use DB;

class WarehouseAreaController extends Controller
{
  public function index()
  {   

    $warehouse_area = DB::select(" 
      SELECT * FROM wms_m_area 
      LEFT JOIN wms_m_zone ON wms_m_area.wh_zone_id = wms_m_zone.zone_id
      WHERE wms_m_area.is_delete = 'N' 
    ");

    return view('warehouse_area.all', compact('warehouse_area'));
  }

  public function add()
  { 

    $warehouse_zone = DB::select(" SELECT * FROM wms_m_zone WHERE is_delete = 'N' ");

    return view('warehouse_area.add', compact('warehouse_zone'));

  }

  protected function save(Request $request){

    $Warehousearea = new Warehousearea;

    $Warehousearea->wh_zone_id      = $request->wh_zone_id;
    $Warehousearea->wh_area_name    = $request->wh_area_name;
    $Warehousearea->wh_area_desc    = $request->wh_area_desc;

    $Warehousearea->input_by   = Auth::user()->username;
    $Warehousearea->input_date = date('Y-m-d H:i:s');
    $Warehousearea->save();

    toastr()->success('Warehouse Area created successfully');

    return redirect( route('warehousearea.index') );

  }

  public function edit(Warehousearea $warehousearea)
  {
    $warehouse_zone = DB::select(" SELECT * FROM wms_m_zone WHERE is_delete = 'N' ");

    return view('warehouse_area.edit', compact('warehousearea', 'warehouse_zone'));
  }

  protected function update(Request $request){

    DB::table('wms_m_area')->where('wh_area_id', $request->wh_area_id)->update([

      'wh_zone_id'     => $request->wh_zone_id,
      'wh_area_name'   => $request->wh_area_name,
      'wh_area_desc'   => $request->wh_area_desc,

      'edit_by'   => Auth::user()->username,
      'edit_date' => date('Y-m-d H:i:s')

    ]);

    toastr()->success('Edit successfully');

    return redirect( route('warehousearea.index') );

  }

  protected function delete(Request $request){

    DB::table('wms_m_area')->where('wh_area_id', $request->wh_area_id)->update([

      'is_delete' => 'Y',
      'del_by'    => Auth::user()->username,
      'del_date'  => date('Y-m-d H:i:s')

    ]);

    toastr()->success('Delete Success');

    return redirect( route('warehousearea.index') );

  }

}

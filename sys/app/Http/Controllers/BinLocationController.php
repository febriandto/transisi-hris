<?php

namespace App\Http\Controllers;

use App\Model\Binlocation;
use App\Model\Warehouserow;
use Illuminate\Http\Request;

use DataTables;
use Auth;

class BinLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $warehouserow = Warehouserow::where('is_delete', 'N')->pluck('wh_row_name', 'wh_row_id');

        return view('binlocation.binlocation', compact('warehouserow'));
    }

    function datatables(Request $request)
    {   
        $data = array();

        $is_delete = $request->is_delete;

        $bl = Binlocation::where(['is_delete'=> $is_delete])->get();

        $no = 1;
        foreach($bl as $bl)
        {
            $bl->no = $no++;
            if($is_delete == 'N')
            {
                $bl->aksi = '
                    <a href="#" class="btn-edit" data-id ="'.$bl->bin_loc_id.'"><i class="fa fa-edit"></i></a>&nbsp;
                    <a href="#" class="btn-hapus" data-id = "'.$bl->bin_loc_id.'"><i class="fa fa-trash"></i></a>
                ';
            }
            else
            {
                $bl->aksi = '<a href="#" class="btn-restore" data-id = "' .$bl->bin_loc_id. '"> <i class="fa fa-undo"></i> </a>';
            }

            $data[] = $bl;
        }

        return datatables::of($data)->escapecolumns([])->make(true);
    }

    function simpan(Request $request)
    {
        $Binlocation = new Binlocation;

        $Binlocation->bin_loc_id   = $request->bin_loc_id;
        $Binlocation->bin_loc_name = $request->bin_loc_name;
        $Binlocation->bin_loc_desc = $request->bin_loc_desc;
        $Binlocation->wh_row_id    = $request->wh_row_id;
        
        $Binlocation->input_by     = Auth::user()->username;
        $Binlocation->input_date   = date('Y-m-d H:i:s');
        $Binlocation->save();

        return response()->json(['status' => 'success', 'binlocation' => $Binlocation], 200);
    }

    protected function edit($id)
    {
        $Binlocation = Binlocation::findOrFail($id);
        return response()->json(['status' => 'success', 'binlocation' => $Binlocation], 200);
    }

    protected function perbarui($id, Request $request)
    {
            
        $Binlocation = Binlocation::findOrFail($request->bin_loc_id_before);
            
        $Binlocation->bin_loc_id   = $request->bin_loc_id;  
        $Binlocation->bin_loc_name = $request->bin_loc_name;
        $Binlocation->bin_loc_desc = $request->bin_loc_desc;
        $Binlocation->wh_row_id    = $request->wh_row_id;
            
        $Binlocation->input_by     = Auth::user()->username;
        $Binlocation->input_date   = date('Y-m-d H:i:s');
            
        $Binlocation->edit_by      = Auth::user()->username;
        $Binlocation->edit_date    = date('Y-m-d H:i:s');

        $Binlocation->update();

        return response()->json(['status' => 'success'], 200);
    }

    protected function hapus($id)
    {
        $Binlocation = Binlocation::findOrFail($id);
                
        $Binlocation->delete_by   = Auth::user()->username;
        $Binlocation->delete_date = date('Y-m-d H:i:s');
        $Binlocation->is_delete   = "Y";
        $Binlocation->update();

        return response()->json(['status' => 'success'], 200);
    }

    protected function restore($id)
    {
        $Binlocation = Binlocation::findOrFail($id);
        $Binlocation->update(['is_delete' => 'N']);
        return response()->json(['status' => 'success', 200]);
    }

}

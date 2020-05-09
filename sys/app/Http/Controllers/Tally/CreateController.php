<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Tally\Tally;
use App\Http\Controllers\Controller;

use DataTables;
use Auth;


class CreateController extends Controller
{
    
	function datatables(Request $request)
    {   
        $data = array();

        $is_delete = $request->is_delete;

        $tallys = Tally::where(['is_delete'=> $is_delete])->get();

        $no = 1;

        foreach($tallys as $tally)
        {
            $tally->no = $no++;
            if($is_delete == 'N')
            {
                $tally->aksi = '
                    <a href="#" class="btn-edit" data-id ="'.$tally->tally_id.'"><i class="fa fa-edit"></i></a>&nbsp;
                    <a href="#" class="btn-hapus" data-id = "'.$tally->tally_id.'"><i class="fa fa-trash"></i></a>
                ';
            }
            else
            {
                $tally->aksi = '<a href="#" class="btn-restore" data-id = "' .$tally->tally_id. '"> <i class="fa fa-undo"></i> </a>';
            }

            $data[] = $tally;
        }

        return datatables::of($data)->escapecolumns([])->make(true);
    
    }


    function index()
    {

        return view('tally.create');
    }


    function simpan(Request $request)
    {
        $tally              = new Tally;
        $tally->kode_barang = $request->kode_barang;
        $tally->nama_barang = $request->nama_barang;
        $tally->harga_beli  = $request->harga_beli;
        $tally->harga_jual  = $request->harga_jual;
        $tally->satuan      = $request->satuan;
        
        $tally->input_by    = Auth::user()->username;
        $tally->input_date  = date('Y-m-d H:i:s');
        $tally->save();

        return response()->json(['status' => 'success', 'barang' => $tally], 200);
    }

    protected function edit($id)
    {
        $tally = Tally::findOrFail($id);
        return response()->json(['status' => 'success', 'barang' => $tally], 200);
    }

    protected function perbarui($id, Request $request)
    {
        
        $tally = Tally::findOrFail($id);
        
        $tally->kode_barang = $request->kode_barang;
        $tally->nama_barang = $request->nama_barang;
        $tally->harga_beli  = $request->harga_beli;
        $tally->harga_jual  = $request->harga_jual;
        $tally->satuan      = $request->satuan;
        $tally->update_by   = Auth::user()->username;
        $tally->update_date = date('Y-m-d H:i:s');
        $tally->update();

        return response()->json(['status' => 'success'], 200);
    }

    protected function hapus($id)
    {
        $tally = Tally::findOrFail($id);
        $tally->delete_by   = Auth::user()->username;
        $tally->delete_date = date('Y-m-d H:i:s');
        $tally->is_delete   = "Y";
        $tally->update();
        return response()->json(['status' => 'success'], 200);
    }

    protected function restore($id)
    {
        $tally = Tally::findOrFail($id);
        $tally->update(['is_delete' => 'N']);
        return response()->json(['status' => 'success', 200]);
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DataTables;
use Auth;

use App\Model\Barang;

class MasterDataBarangController extends Controller
{
    
    //
	
	function datatables(Request $request)
    {   
        $data = array();

        $is_delete = $request->is_delete;

        $barang = Barang::where(['is_delete'=> $is_delete])->get();

        $no = 1;
        foreach($barang as $barang)
        {
            $barang->no = $no++;
            if($is_delete == 'N')
            {
                $barang->aksi = '
                    <a href="#" class="btn-edit" data-id ="'.$barang->id_barang.'"><i class="fa fa-edit"></i></a>&nbsp;
                    <a href="#" class="btn-hapus" data-id = "'.$barang->id_barang.'"><i class="fa fa-trash"></i></a>
                ';
            }
            else
            {
                $barang->aksi = '<a href="#" class="btn-restore" data-id = "' .$barang->id_barang. '"> <i class="fa fa-undo"></i> </a>';
            }

            $data[] = $barang;
        }

        return datatables::of($data)->escapecolumns([])->make(true);
    
    }


    function index()
    {

    	// refers to /sys/resources/views/master/barang.blade.php
        return view('master.barang');
    }


    function simpan(Request $request)
    {
        $barang = new Barang;
        $barang->kode_barang = $request->kode_barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->harga_beli = $request->harga_beli;
        $barang->harga_jual = $request->harga_jual;
        $barang->satuan = $request->satuan;

        $barang->input_by = Auth::user()->username;
        $barang->input_date = date('Y-m-d H:i:s');
        $barang->save();

        return response()->json(['status' => 'success', 'barang' => $barang], 200);
    }

    protected function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return response()->json(['status' => 'success', 'barang' => $barang], 200);
    }

    protected function perbarui($id, Request $request)
    {
        
        $barang = Barang::findOrFail($id);
        
        $barang->kode_barang = $request->kode_barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->harga_beli = $request->harga_beli;
        $barang->harga_jual = $request->harga_jual;
        $barang->satuan = $request->satuan;
        $barang->update_by = Auth::user()->username;
        $barang->update_date = date('Y-m-d H:i:s');
        $barang->update();

        return response()->json(['status' => 'success'], 200);
    }

    protected function hapus($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete_by = Auth::user()->username;
        $barang->delete_date = date('Y-m-d H:i:s');
        $barang->is_delete = "Y";
        $barang->update();
        return response()->json(['status' => 'success'], 200);
    }

    protected function restore($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->update(['is_delete' => 'N']);
        return response()->json(['status' => 'success', 200]);
    }



}

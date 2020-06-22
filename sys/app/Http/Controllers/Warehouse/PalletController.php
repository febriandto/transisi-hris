<?php

namespace App\Http\Controllers\Warehouse;

use App\Model\Warehouse\Pallet;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DataTables;
use Auth;
use DB;

class PalletController extends Controller
{

    public function index()
    {
        $pallet = Pallet::where('is_delete', 'N')->get();

        return view('pallet.all', compact('pallet'));
    }

    public function add()
    { 

        return view('pallet.add');

    }

    protected function save(Request $request){

        $pallet = new Pallet;

        $pallet->pallet_name = $request->pallet_name;
        $pallet->pallet_desc = $request->pallet_desc;

        $pallet->input_by   = Auth::user()->username;
        $pallet->input_date = date('Y-m-d H:i:s');
        $pallet->save();

        toastr()->success('Pallet created successfully');

        return redirect( route('pallet.index') );

    }

    public function edit(pallet $pallet)
    {
        return view('pallet.edit', compact('pallet'));
    }

    protected function update(Request $request){

        DB::table('wms_m_pallet')->where('pallet_id', $request->pallet_id)->update([

          'pallet_name' => $request->pallet_name,
          'pallet_desc' => $request->pallet_desc,

          'edit_by'   => Auth::user()->username,
          'edit_date' => date('Y-m-d H:i:s')

      ]);

        toastr()->success('Edit successfully');

        return redirect( route('pallet.index') );

    }

    protected function delete(Request $request){

        DB::table('wms_m_pallet')->where('pallet_id', $request->pallet_id)->update([

          'is_delete' => 'Y',
          'del_by'    => Auth::user()->username,
          'del_date'  => date('Y-m-d H:i:s')

      ]);

        toastr()->success('Delete Success');

        return redirect( route('pallet.index') );

    }

}
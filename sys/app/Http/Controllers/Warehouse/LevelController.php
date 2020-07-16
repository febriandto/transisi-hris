<?php

namespace App\Http\Controllers\Warehouse;

use App\Model\Warehouse\Level;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DataTables;
use Auth;
use DB;

class LevelController extends Controller
{

    public function index()
    {
        $level = DB::select(" SELECT * FROM wms_m_level where is_delete = 'N' ");

        return view('level.all', compact('level'));
    }

    public function add()
    { 

        return view('level.add');

    }

    protected function save(Request $request){

        $Level = new Level;
        
        $Level->level_name = $request->level_name;

        $Level->input_by   = Auth::user()->username;
        $Level->input_date = date('Y-m-d H:i:s');
        $Level->save();

        toastr()->success('Level created successfully');

        return redirect( route('level.index') );

    }

    public function edit(level $level)
    {
        
        return view('level.edit', compact('level'));

    }

    protected function update(Request $request){

        DB::table('wms_m_level')->where('level_id', $request->level_id)->update([

          'level_name' => $request->level_name,
          
          'edit_by'    => Auth::user()->username,
          'edit_date'  => date('Y-m-d H:i:s')

      ]);

        toastr()->success('Edit successfully');

        return redirect( route('level.index') );

    }

    protected function delete(Request $request){

        DB::table('wms_m_level')->where('level_id', $request->level_id)->update([

          'is_delete' => 'Y',
          'del_by'    => Auth::user()->username,
          'del_date'  => date('Y-m-d H:i:s')

      ]);

        toastr()->success('Delete Success');

        return redirect( route('level.index') );

    }

}
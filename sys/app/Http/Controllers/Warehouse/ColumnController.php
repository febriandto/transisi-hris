<?php

namespace App\Http\Controllers\Warehouse;

use App\Model\Warehouse\Column;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DataTables;
use Auth;
use DB;

class ColumnController extends Controller
{

    public function index()
    {
        $column = Column::where('is_delete', 'N')->get();

        return view('column.all', compact('column'));
    }

    public function add()
    { 

        return view('column.add');

    }

    protected function save(Request $request){

        $column = new Column;

        $column->col_name = $request->col_name;

        $column->input_by   = Auth::user()->username;
        $column->input_date = date('Y-m-d H:i:s');
        $column->save();

        toastr()->success('Column created successfully');

        return redirect( route('column.index') );

    }

    public function edit(Column $column)
    {
        return view('column.edit', compact('column'));
    }

    protected function update(Request $request){

        DB::table('wms_m_column')->where('col_id', $request->col_id)->update([

          'col_name' => $request->col_name,

          'edit_by'   => Auth::user()->username,
          'edit_date' => date('Y-m-d H:i:s')

      ]);

        toastr()->success('Edit successfully');

        return redirect( route('column.index') );

    }

    protected function delete(Request $request){

        DB::table('wms_m_column')->where('col_id', $request->col_id)->update([

          'is_delete' => 'Y',
          'delete_by'    => Auth::user()->username,
          'delete_date'  => date('Y-m-d H:i:s')

      ]);

        toastr()->success('Delete Success');

        return redirect( route('column.index') );

    }

}
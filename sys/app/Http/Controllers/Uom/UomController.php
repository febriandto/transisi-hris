<?php

namespace App\Http\Controllers\Uom;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Uom\Uom;

use Auth;
use DB;

class UomController extends Controller
{
	
	public function index(){

		$uom = DB::select("
			SELECT * FROM wms_m_uom where is_delete = 'N'
		");

		return view('uom.all', compact('uom'));

	}

	public function add(){

		return view('uom.add' );

	}

	public function save(Request $request){

		$findSameValue = DB::select("SELECT * FROM wms_m_uom WHERE uom_code = '$request->uom_code' ");

		if( $findSameValue == NULL ){

			$Uom = new Uom;
			$Uom->uom_code   = $request->uom_code;
			$Uom->uom_desc   = $request->uom_desc;
			$Uom->input_by   = Auth::user()->username;
			$Uom->input_date = date('Y-m-d H:i:s');
			$Uom->save();

			toastr()->success('UOM (Unit of Measurement) created successfully');

			return redirect( route('uom.index') );

		}else{

			toastr()->error('UOM Code sudah ada!');

			return redirect( route('uom.add') );

		}

	}

	public function edit(Uom $uom){

		return view('uom.edit', compact('uom'));

	}

	public function update(Request $request){

		$insert = DB::table('wms_m_uom')->where('uom_id', $request->uom_id)->update([

		'uom_code' => $request->uom_code,
		'uom_desc' => $request->uom_desc,
		
		'edit_by'   => Auth::user()->username,
		'edit_date' => date('Y-m-d H:i:s')

		]);

		toastr()->success('Edit successfully');

		return redirect( route('uom.index') );

	}

	public function delete(Request $request){

		DB::table('wms_m_uom')->where('uom_id', $request->uom_id)->update([

		'is_delete' => 'Y',
		
		'del_by'   => Auth::user()->username,
		'del_date' => date('Y-m-d H:i:s')

		]);

		toastr()->success('Delete successfully');

		return redirect( route('uom.index') );

	}

}

?>
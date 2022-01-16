<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\LoadingDock;

use DB;
use Auth;

class LoadingDockController extends Controller
{

	public function index()
	{

		$loading_dock = LoadingDock::all();

		return view("loading_dock.all", compact("loading_dock"));

	}

	public function add(){

		return view("loading_dock.add");

	}

	public function save(Request $request){

		$cek = LoadingDock::where('no_loading_dock', $request->no_loading_dock)->first();

		if($cek == NULL){

			$loading_dock = new LoadingDock;

			$loading_dock->id_loading_dock = NULL;
			$loading_dock->no_loading_dock = $request->no_loading_dock;
			$loading_dock->remarks = $request->remarks;
			$loading_dock->save();

			toastr()->success('Saved');

			return redirect(route('loading_dock.index'));

		}else{

			toastr()->error('No Loading Dock sudah ada');

			return redirect()->back();

		}


	}

	public function edit(LoadingDock $loading_dock){

		return view('loading_dock.edit', compact('loading_dock'));

	}

	public function update(Request $request){

		LoadingDock::where('id_loading_dock', $request->id_loading_dock)->update([

			'no_loading_dock' => $request->no_loading_dock,
			'remarks' => $request->remarks

		]);

		toastr()->success('Saved');

		return redirect(route('loading_dock.index'));

	}

	public function delete(Request $request){

		LoadingDock::where('id_loading_dock', $request->id_loading_dock)->delete();

		toastr()->info('Deleted');

		return redirect(route('loading_dock.index'));

	}

	public function qrcode(Request $request){

		$from = $request->from;
		$to 	= $request->to;

		$loading_dock = DB::select(" SELECT * FROM wms_m_loading_dock WHERE id_loading_dock BETWEEN '$from' AND '$to' ");

		foreach ($loading_dock as $no => $data) {

			if (!file_exists('qrcode/'."$data->no_loading_dock".'.png')) {

				\QrCode::backgroundColor(255, 255, 0)->color(255, 0, 127)
				->format('png')->size(150)
				->generate("$data->no_loading_dock", 'qrcode/'."$data->no_loading_dock".'.png');
			}

		}

		return view('loading_dock.qrcode', compact('loading_dock'));

	}





}

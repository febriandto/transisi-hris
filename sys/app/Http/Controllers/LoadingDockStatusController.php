<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\LoadingDock;
use App\Model\Loading\Loading;
use App\Model\LoadingDetail;

use DB;
use Auth;

class LoadingDockStatusController extends Controller
{

	public function index()
	{

		$loading_dock = DB::select(' SELECT a.*, count(b.id_loading_dock) as total FROM `wms_m_loading_dock` a
LEFT JOIN wms_t_loading b ON a.id_loading_dock = b.id_loading_dock
AND b.loading_status in ("finish_loading", "entry_loading") and b.is_delete = "N"
GROUP BY a.id_loading_dock ');
		
		return view("loading_dock_status.all", compact("loading_dock"));

	}

	public function detail(Request $request)
	{

		$loadings = Loading::where('id_loading_dock', $request->no_loading_dock)->where(['is_delete' => 'N'])->whereIn('loading_status', ['finish_loading', 'entry_loading'])->get();
		
		return view("loading_dock_status.detail", compact("loadings"));

	}


}

<?php

namespace App\Http\Controllers\Loading;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Loading\Loading;
use App\Model\Loading\LoadingDetail;
use App\Model\Picking\Picking;

use Auth;
use DB;

class LoadingController extends Controller
{
	
	public function index(){

		$loading = DB::select("
			SELECT
				`wms_t_loading`.`loading_no`,
				`wms_t_loading`.`loading_date`,
				`wms_t_loading`.`picking_no`,
				`wms_t_loading`.`loading_rmk`,
				`wms_t_loading`.`loading_status`,
				`wms_t_loading`.`status_date`,
				`wms_t_picking`.`picking_date`,
				`wms_m_customer`.`cust_name`
			FROM
				`wms_t_loading`
			INNER JOIN `wms_t_picking` 
				ON (`wms_t_loading`.`picking_no` = `wms_t_picking`.`picking_no`)
			INNER JOIN `wms_m_customer` 
				ON (`wms_t_picking`.`cust_id` = `wms_m_customer`.`cust_id`)
			WHERE wms_t_loading.is_delete = 'N'
			");

		return view('loading.all', compact('loading'));

	}

	public function add(Picking $picking)
	{

		$loading_no = DB::select("SELECT COUNT(*)+1 AS 'a' FROM wms_t_loading WHERE MONTH(loading_date) = MONTH(NOW()) ");
    $loading_no = sprintf('%04s', $loading_no[0]->a);

    $customer = DB::select(" SELECT * FROM wms_m_customer WHERE cust_id = '$picking->cust_id' ");
    $customer = $customer[0];


		return view('loading.add', compact('loading_no', 'picking', 'customer'));		
	}

	protected function save( Request $request )
	{

		$Loading = new Loading;

		$Loading->loading_no   = $request->loading_no;
		$Loading->loading_date = $request->loading_date;
		$Loading->picking_no   = $request->picking_no;
		$Loading->loading_rmk  = $request->loading_rmk;
		$Loading->status_date  = date('Y-m-d H:i:s');
		
		$Loading->input_by   = Auth::user()->username;
		$Loading->input_date = date('Y-m-d H:i:s');
		$Loading->edit_by    = Auth::user()->username;
		$Loading->edit_date  = date('Y-m-d H:i:s');

		$Loading->save();

		// update picking status
		DB::table('wms_t_picking')->where('picking_no', $request->picking_no)->update([

				'picking_status'      => 'loading_process',
				'picking_status_date' => date('Y-m-d H:i:s'),
				
				'edit_by'   => Auth::user()->username,
				'edit_date' => date('Y-m-d H:i:s')

  	]);

		toastr()->success(' Loading Saved ');

		return redirect( route('picking.detail', $request->picking_no) );

	}

	public function edit( Loading $loading )
	{

		$data = DB::select("

			SELECT a.*, b.cust_id, c.cust_name FROM `wms_t_loading` a
				LEFT JOIN wms_t_picking b ON a.picking_no = b.picking_no
				LEFT JOIN wms_m_customer c ON b.cust_id = c.cust_id
			WHERE a.loading_no = '$loading->loading_no' AND a.is_delete = 'N'

		 ");
		$data = $data[0];

		return view( 'loading.edit', compact('data') );

	}

}

?>
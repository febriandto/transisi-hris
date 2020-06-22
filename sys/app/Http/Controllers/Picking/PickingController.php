<?php

namespace App\Http\Controllers\Picking;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Picking\Picking;
use App\Model\Picking\PickingDetail;
use App\Model\Stock\Palletstock;

use Auth;
use DB;

class PickingController extends Controller
{
	
	public function index(){

			if (isset($_GET['filter_by_status'])) {
				
				$picking = DB::select(" 

					SELECT * FROM `wms_t_picking`
					INNER JOIN `wms_m_customer` 
					ON (`wms_t_picking`.`cust_id` = `wms_m_customer`.`cust_id`)
					where wms_t_picking.is_delete = 'N'
					AND picking_status = '$_GET[filter_by_status]'

					");

			}else{

				$picking = DB::select(" 

					SELECT * FROM `wms_t_picking`
					INNER JOIN `wms_m_customer` 
					ON (`wms_t_picking`.`cust_id` = `wms_m_customer`.`cust_id`)
					WHERE wms_t_picking.is_delete = 'N'

					");
				
			}

		$status_filter = DB::select(" SELECT DISTINCT picking_status FROM wms_t_picking ");

		$customer = DB::select(" SELECT * FROM wms_m_customer WHERE is_delete = 'N' ORDER BY cust_name ASC ");

		return view('picking.all', compact('status_filter', 'customer', 'picking'));

	}

		// Filter by date
	public function filter_date(Request $request){

		$picking = DB::select("

			SELECT * FROM `wms_t_picking`
			INNER JOIN `wms_m_customer` 
			ON (`wms_t_picking`.`cust_id` = `wms_m_customer`.`cust_id`)
			where wms_t_picking.is_delete = 'N'
			and picking_date between '$request->date_1' AND '$request->date_2'
			AND wms_t_picking.cust_id = '$request->cust_id'

			");

		$status_filter = DB::select(" SELECT DISTINCT picking_status FROM wms_t_picking ");

		$customer = DB::select(" SELECT * FROM wms_m_customer WHERE is_delete = 'N' ORDER BY cust_name ASC ");

		return view('picking.all', compact('picking','customer', 'status_filter'));

	}


	public function add()
	{

		$picking_no = DB::select(" SELECT COUNT(*)+2 AS 'a' FROM wms_t_picking WHERE MONTH(picking_date) = MONTH(NOW()) ");
    $picking_no = sprintf('%04s', $picking_no[0]->a);

    $periode_id = DB::select(" SELECT * FROM wms_m_periode order by periode_id desc limit 0,1 ");
		$periode_id = $periode_id[0]->periode_id;

    $customer = DB::select(" SELECT * FROM wms_m_customer WHERE is_delete = 'N' ORDER BY cust_name ASC ");


		return view('picking.add', compact('picking_no', 'customer', 'periode_id'));

	}

	protected function save( Request $request )
	{

		$Picking = new Picking;

		$Picking->picking_no   = $request->picking_no;
		$Picking->picking_date = $request->picking_date;
		$Picking->cust_id      = $request->cust_id;
		$Picking->picking_desc = $request->picking_desc;
		$Picking->picking_rmk  = $request->picking_rmk;
		$Picking->periode_id   = $request->periode_id;

		$Picking->edit_by   = Auth::user()->username;
		$Picking->edit_date = date('Y-m-d H:i:s');

		$Picking->input_by   = Auth::user()->username;
		$Picking->input_date = date('Y-m-d H:i:s');
		$Picking->save();

		toastr()->success('Picking created successfully');

		return redirect( route('picking.index') );

	}

	public function detail( Picking $picking )
	{

		$picking = DB::select("
			SELECT * FROM wms_t_picking
			INNER JOIN wms_m_customer 
			ON (wms_t_picking.cust_id = wms_m_customer.cust_id)
			WHERE wms_t_picking.picking_no = '$picking->picking_no'
		");
		$picking = $picking[0];

		$picking_items = DB::select("
			SELECT
				wms_t_picking_detail.picking_detail_id,
				wms_t_picking_detail.picking_no,
				wms_t_picking_detail.item_number,
				wms_t_picking_detail.picking_qty,
				wms_t_picking_detail.picking_open_qty,
				wms_t_picking_detail.device_id,
				wms_t_picking_detail.picking_detail_status,
				wms_t_picking_detail.picking_detail_status_date,
				wms_t_picking.picking_status,
				wms_t_picking.cust_id,
				wms_m_uom.uom_code,
				wms_m_item.item_name,
				wms_m_item.spq_item,
				wms_m_item.spq_pallet,
				wms_m_item.spq_item*wms_t_picking_detail.picking_qty as 'a',
				wms_m_item.item_description,
				wms_m_customer.cust_name
			FROM
				wms_t_picking
			INNER JOIN wms_t_picking_detail 
			ON (wms_t_picking.picking_no = wms_t_picking_detail.picking_no)
			INNER JOIN wms_m_item 
			ON (wms_t_picking_detail.item_number = wms_m_item.item_number)
			INNER JOIN wms_m_uom 
			ON (wms_m_uom.uom_id = wms_m_item.uom_id)
			INNER JOIN wms_m_customer 
			ON (wms_m_item.cust_id = wms_m_customer.cust_id)
			WHERE wms_t_picking_detail.picking_no = '$picking->picking_no'
			and wms_t_picking_detail.is_delete='N'
		");

		$list_stock = DB::select("
			SELECT
				wms_t_pallet_stock.inbound_pallet_id,
				wms_t_pallet_stock.putaway_no,
				wms_t_pallet_stock.item_number,
				wms_t_pallet_stock.pallet_qty,
				wms_t_pallet_stock.stock_open_picking,
				wms_t_pallet_stock.input_date as 'masuk',
				wms_m_pallet.pallet_name,
				wms_m_location.location_code,
				wms_m_uom.uom_code,
				wms_m_item.cust_id,
				wms_m_item.item_name,
				wms_m_item.second_uom,
				wms_m_item.spq_item,
				wms_m_item.spq_item*wms_t_pallet_stock.pallet_qty as 'detail_qty',
				wms_t_putaway.putaway_date
			FROM
				wms_t_pallet_stock
			INNER JOIN wms_m_item 
			ON (wms_t_pallet_stock.item_number = wms_m_item.item_number)
			INNER JOIN wms_m_pallet 
			ON (wms_m_pallet.pallet_id = wms_t_pallet_stock.pallet_id)
			INNER JOIN wms_m_location 
			ON (wms_t_pallet_stock.location_id = wms_m_location.location_id)
			INNER JOIN wms_t_putaway 
			ON (wms_t_pallet_stock.putaway_no = wms_t_putaway.putaway_no)
			INNER JOIN wms_m_uom 
			ON (wms_m_item.uom_id = wms_m_uom.uom_id)
			WHERE wms_m_item.cust_id='$picking->cust_id'
			AND wms_t_pallet_stock.stock_open_picking != '0'
			order by wms_t_pallet_stock.input_date asc
		");

		$loading = DB::select("
			SELECT * FROM wms_t_loading WHERE picking_no = '$picking->picking_no'
		");

		return view('picking.detail', compact('picking', 'picking_items', 'list_stock', 'loading'));

	}

	protected function save_item(Request $request)
	{

		$PickingDetail = new PickingDetail;

		$PickingDetail->picking_no                 = $request->picking_no;
		$PickingDetail->inbound_pallet_id          = $request->inbound_pallet_id;
		$PickingDetail->item_number                = $request->item_number;
		$PickingDetail->spq_item                   = $request->spq_item;
		$PickingDetail->picking_qty                = $request->picking_qty;
		$PickingDetail->picking_detail_qty         = $request->picking_qty * $request->spq_item;
		$PickingDetail->picking_open_qty           = $request->picking_qty;
		$PickingDetail->picking_open_detail_qty    = $request->picking_qty * $request->spq_item;
		$PickingDetail->picking_detail_status_date = date('Y-m-d H:i:s');

		$PickingDetail->input_by                   = Auth::user()->username;
		$PickingDetail->input_date                 = date('Y-m-d H:i:s'); 
		$PickingDetail->edit_by                    = Auth::user()->username;
		$PickingDetail->edit_date                  = date('Y-m-d H:i:s');
		$PickingDetail->save();

		DB::table('wms_t_pallet_stock')->where('inbound_pallet_id', $request->inbound_pallet_id)->update([

			'stock_open_picking' => ( $request->stock_open_picking - $request->picking_qty ),
			
			'update_by'   => Auth::user()->username,
			'update_date' => date('Y-m-d H:i:s')

  	]);

		toastr()->success('Pick success');

		return redirect( route('picking.detail', $request->picking_no) );

	}

	// Finish Picking
	protected function finish_picking( Request $request )
	{

		DB::table('wms_t_picking')->where('picking_no', $request->picking_no)->update([

			'picking_status' => 'finish_picking',

			'edit_by'   => Auth::user()->username,
			'edit_date' => date('Y-m-d H:i:s')

		]);

		toastr()->success(' Picking Finished ');

		return redirect( route('picking.detail', $request->picking_no) );

	}

	// Edit Item Picking
	public function edit_item( PickingDetail $picking_detail )
	{

		return view("picking.edit_item", compact('picking_detail'));

	}

	// Update Item Picking
	protected function update_item( Request $request )
	{

		DB::table('wms_t_picking_detail')->where('picking_detail_id', $request->picking_detail_id)->update([

			'picking_qty'      => $request->picking_qty,
			'picking_open_qty' => $request->picking_qty,

			'edit_by'   => Auth::user()->username,
			'edit_date' => date('Y-m-d H:i:s')


		]);

		toastr()->success('Pick success');

		return redirect( route('picking.detail', $request->picking_no) );

	}

	// Delete item
	protected function delete_item( Request $request )
	{

		DB::table('wms_t_picking_detail')->where('picking_detail_id', $request->picking_detail_id)->update([

			'is_delete' => 'Y',

			'del_by'   => Auth::user()->username,
			'del_date' => date('Y-m-d H:i:s')

		]);

		toastr()->success(' Item Deleted ');

		return redirect()->back();

	}

}

?>
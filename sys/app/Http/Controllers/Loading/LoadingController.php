<?php

namespace App\Http\Controllers\Loading;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Loading\Loading;
use App\Model\Loading\LoadingDetail;
use App\Model\Picking\Picking;
use App\Model\Picking\PickingDetail;

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

	protected function update( Request $request )
	{

		// update picking status
		DB::table('wms_t_loading')->where('loading_no', $request->loading_no)->update([


				'loading_no'   => $request->loading_no,
				'loading_date' => $request->loading_date,
				'picking_no'   => $request->picking_no,
				'loading_rmk'  => $request->loading_rmk,
				'status_date'  => date('Y-m-d H:i:s'),
				
				'edit_by'      => Auth::user()->username,
				'edit_date'    => date('Y-m-d H:i:s')

  	]);

		toastr()->success(' Loading Edited ');

		return redirect( route('loading.index') );

	}

	public function detail( Loading $loading )
	{

		$data = DB::select("

			SELECT
				wms_t_loading.loading_no,
				wms_t_loading.loading_date,
				wms_t_loading.picking_no,
				wms_t_loading.loading_rmk,
				wms_t_loading.loading_status,
				wms_t_loading.status_date,
				wms_t_loading.edit_by,
				wms_t_loading.edit_date,
				wms_t_picking.picking_date,
				wms_m_customer.cust_name
			FROM
				wms_t_loading
			INNER JOIN wms_t_picking 
				ON (wms_t_loading.picking_no = wms_t_picking.picking_no)
			INNER JOIN wms_m_customer 
				ON (wms_t_picking.cust_id = wms_m_customer.cust_id)
			WHERE wms_t_loading.loading_no = '$loading->loading_no'

			");
		$data = $data[0];

		$loading_items = DB::select("

			SELECT
				wms_t_loading_detail.loading_detail_id,
				wms_t_loading_detail.loading_no,
				wms_t_loading_detail.item_number,
				wms_t_loading_detail.picking_qty,
				wms_t_loading_detail.loading_qty,
				wms_t_loading_detail.location_id,
				wms_t_loading.loading_status,
				wms_m_item.item_name,
				wms_m_item.item_description,
				wms_m_uom.uom_code
			FROM
				wms_t_loading_detail
			INNER JOIN wms_t_loading 
				ON (wms_t_loading_detail.loading_no = wms_t_loading.loading_no)
			INNER JOIN wms_m_item 
				ON (wms_m_item.item_number = wms_t_loading_detail.item_number)
			INNER JOIN wms_m_uom 
				ON (wms_m_uom.uom_id = wms_m_item.uom_id)

			WHERE wms_t_loading_detail.loading_no = '$loading->loading_no' AND wms_t_loading_detail.is_delete = 'N'

			");

		$picking_items = DB::select("

			SELECT
				wms_t_picking_detail.picking_detail_id,
				wms_t_picking_detail.picking_no,
				wms_t_picking_detail.item_number,
				wms_t_picking_detail.picking_qty,
				wms_t_picking_detail.picking_open_qty,
				wms_t_picking_detail.picking_open_detail_qty,
				wms_t_picking_detail.device_id,
				wms_t_picking_detail.picking_detail_status,
				wms_t_picking_detail.picking_detail_status_date,
				wms_t_picking_detail.inbound_pallet_id ,
				wms_m_uom.uom_code,
				wms_m_item.item_name,
				wms_m_item.spq_item,
				wms_m_item.spq_item*wms_t_picking_detail.picking_qty as 'a',
				wms_m_item.spq_pallet,
				wms_m_item.item_description,
				wms_m_customer.cust_name
			FROM
				wms_t_picking_detail
			INNER JOIN wms_m_item 
				ON (wms_t_picking_detail.item_number = wms_m_item.item_number)
			INNER JOIN wms_m_uom 
				ON (wms_m_uom.uom_id = wms_m_item.uom_id)
			INNER JOIN wms_m_customer 
				ON (wms_m_item.cust_id = wms_m_customer.cust_id)
			WHERE wms_t_picking_detail.picking_no = '$loading->picking_no' 
				AND wms_t_picking_detail.is_delete='N' 
				AND wms_t_picking_detail.picking_open_qty != '0'

			");

		return view( 'loading.detail', compact( 'data', 'loading_items', 'picking_items' ) );

	}


	// Do loading
	public function do_loading( PickingDetail $picking_detail, Loading $loading )
	{

		$data = DB::select("

			SELECT
				`wms_t_picking_detail`.`item_number`,
				`wms_t_picking_detail`.`picking_no`,
				`wms_m_item`.`item_name`,
				`wms_t_picking_detail`.`inbound_pallet_id`,
				`wms_t_pallet_stock`.`pallet_qty`,
				`wms_t_pallet_stock`.`pallet_detail_qty`,
				`wms_t_pallet_stock`.`pallet_id`,
				`wms_t_pallet_stock`.`location_id`,
				`wms_t_picking_detail`.`picking_qty`,
				`wms_t_picking_detail`.`picking_detail_qty`,
				`wms_t_picking_detail`.`picking_open_qty`,
				`wms_t_picking_detail`.`picking_open_detail_qty`,
				`wms_m_item`.`spq_item`,
				`wms_m_pallet`.`pallet_name`,
				`wms_m_location`.`location_code`,
				`wms_m_uom`.`uom_code`,
				`wms_m_item`.`second_uom`
			FROM
				`wms_m_item`
			INNER JOIN `wms_m_uom` 
				ON (`wms_m_item`.`uom_id` = `wms_m_uom`.`uom_id`)
			INNER JOIN `wms_m_customer` 
				ON (`wms_m_item`.`cust_id` = `wms_m_customer`.`cust_id`)
			INNER JOIN `wms_t_picking_detail` 
				ON (`wms_t_picking_detail`.`item_number` = `wms_m_item`.`item_number`)
			INNER JOIN `wms_t_pallet_stock` 
				ON (`wms_t_picking_detail`.`inbound_pallet_id` = `wms_t_pallet_stock`.`inbound_pallet_id`)
			INNER JOIN `wms_m_pallet` 
				ON (`wms_m_pallet`.`pallet_id` = `wms_t_pallet_stock`.`pallet_id`)
			INNER JOIN `wms_m_location` 
				ON (`wms_m_location`.`location_id` = `wms_t_pallet_stock`.`location_id`)
			WHERE wms_t_picking_detail.picking_no = '$picking_detail->picking_no'
				AND wms_t_picking_detail.is_delete='N'
				AND wms_t_picking_detail.picking_detail_id = $picking_detail->picking_detail_id
				AND wms_t_pallet_stock.inbound_pallet_id = $picking_detail->inbound_pallet_id

			");
		$data = $data[0];

		return view( 'loading.do_loading', compact('data', 'loading') );

	}

	protected function do_loading_save( Request $request )
	{

		$LoadingDetail = new LoadingDetail;

		$LoadingDetail->loading_no                 = $request->loading_no;
		$LoadingDetail->item_number                = $request->item_number;
		$LoadingDetail->picking_qty                = $request->picking_qty;
		$LoadingDetail->loading_qty                = ( $request->loading_detail_qty / $request->spq_item );
		$LoadingDetail->loading_detail_qty         = $request->loading_qty;
		$LoadingDetail->pallet_id                  = $request->pallet_id;
		$LoadingDetail->location_id                = $request->location_id;
		$LoadingDetail->loading_detail_status      = 'entry_loading';
		$LoadingDetail->loading_detail_status_date = date('Y-m-d H:i:s');

		$LoadingDetail->input_by                   = Auth::user()->username;
		$LoadingDetail->input_date                 = date('Y-m-d H:i:s');
		$LoadingDetail->edit_by                    = Auth::user()->username;
		$LoadingDetail->edit_date                  = date('Y-m-d H:i:s');
		$LoadingDetail->save();

		DB::table('wms_t_picking')->where('picking_no', $request->picking_no)->update([

			'picking_status'      => 'loading_process',
			'picking_status_date' => date('Y-m-d H:i:s'),

			'edit_by'   => Auth::user()->username,
			'edit_date' => date('Y-m-d H:i:s')

		]);

		DB::table('wms_t_pallet_stock')->where('inbound_pallet_id', $request->inbound_pallet_id)->update([

				'pallet_ending_stock'        => $request->pallet_qty - ( $request->loading_detail_qty / $request->spq_item),
				'pallet_ending_detail_stock' => ( $request->pallet_qty * $request->spq_item ) - ( $request->loading_detail_qty / $request->spq_item )

		]);

    DB::table('wms_t_picking_detail')->where('picking_no', $request->picking_no)->where('item_number', $request->item_number)->update([

				'picking_detail_status'      => 'loading',
				'picking_detail_status_date' => date('Y-m-d H:i:s'),
				'loading_qty'                => $request->loading_detail_qty / $request->spq_item,
				'picking_open_qty'           => ( $request->picking_open_qty - $request->loading_detail_qty) / $request->spq_item,
				'picking_open_detail_qty'    => ( $request->picking_open_detail_qty - $request->loading_detail_qty),

				'edit_by'   => Auth::user()->username,
				'edit_date' => date('Y-m-d H:i:s')

    ]);



		toastr()->success(" Loading Success ");

		return redirect( route('loading.detail', $request->loading_no) );

	}

	// edit item
	public function edit_item( LoadingDetail $loading_detail )
	{

		$current_picking_qty = DB::select(" SELECT * from wms_t_picking_detail WHERE item_number = '$loading_detail->item_number' ");
		$current_picking_qty = $current_picking_qty[0];
		$current_picking_qty = $current_picking_qty->picking_open_qty;

		return view( 'loading.edit_item', compact( 'loading_detail', 'current_picking_qty' ) );

	}

	// update item
	protected function update_item( Request $request )
	{


    DB::table("wms_t_loading_detail")->where('loading_detail_id', $request->loading_detail_id)->update([

			'loading_qty' => $request->loading_qty,
			
			'edit_by'     => Auth::user()->username,
			'edit_date'   => date('Y-m-d H:i:s')

    ]);

    DB::table("wms_t_picking_detail")->where("item_number", $request->item_number)->update([

    	'picking_open_qty' => ( $request->current_picking_qty + $request->loading_qty),

    	'edit_by'   => Auth::user()->username,
			'edit_date' => date('Y-m-d H:i:s')

    ]);

    toastr()->success(" Loading Item Edited ");

    return redirect( route('loading.detail', $request->loading_no) );


	}

	protected function delete_item( Request $request )
	{

		DB::table("wms_t_loading_detail")->where("loading_detail_id", $request->loading_detail_id)->update([

			'is_delete' => 'Y',
			
			'del_by'    => Auth::user()->username,
			'del_date'  => date("Y-m-d H:i:s")

		]);

		toastr()->success(" Item Deleted ");

		return redirect()->back();

	}

}

?>
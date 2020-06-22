<?php

namespace App\Http\Controllers\Putaway;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Putaway\Putaway;
use App\Model\Putaway\PutawayDetail;
use App\Model\Tally\Tally;
use App\Model\Tally\TallyDetail;
use App\Model\Warehouse\Pallet;
use App\Model\Warehouse\Warehouselocation;
use App\Model\Stock\Locationstock;
use App\Model\Stock\Palletstock;

use Auth;
use DB;

class PutawayController extends Controller
{
	
	public function index(){

		if (isset($_GET['filter_by_status'])) {
      
			$putaway = DB::select(" 

				SELECT
					`wms_t_putaway`.`putaway_no`,
					`wms_t_putaway`.`putaway_date`,
					`wms_t_putaway`.`tally_no`,
					`wms_t_putaway`.`putaway_rmk`,
					`wms_t_putaway`.`putaway_status`,
					`wms_t_putaway`.`status_date`,
					`wms_t_tally`.`tally_date`,
					`wms_m_customer`.`cust_name`
				FROM
					`wms_t_tally`
				INNER JOIN `wms_t_putaway` 
					ON (`wms_t_tally`.`tally_no` = `wms_t_putaway`.`tally_no`)
				INNER JOIN `wms_m_customer` 
					ON (`wms_m_customer`.`cust_id` = `wms_t_tally`.`cust_id`)
				WHERE wms_t_putaway.is_delete = 'N' AND wms_t_putaway.putaway_status = '$_GET[filter_by_status]'

				");

    }else{

     $putaway = DB::select(" 

      SELECT
				`wms_t_putaway`.`putaway_no`,
				`wms_t_putaway`.`putaway_date`,
				`wms_t_putaway`.`tally_no`,
				`wms_t_putaway`.`putaway_rmk`,
				`wms_t_putaway`.`putaway_status`,
				`wms_t_putaway`.`status_date`,
				`wms_t_tally`.`tally_date`,
				`wms_m_customer`.`cust_name`
			FROM
				`wms_t_tally`
			INNER JOIN `wms_t_putaway` 
				ON (`wms_t_tally`.`tally_no` = `wms_t_putaway`.`tally_no`)
			INNER JOIN `wms_m_customer` 
				ON (`wms_m_customer`.`cust_id` = `wms_t_tally`.`cust_id`)
			WHERE wms_t_putaway.is_delete = 'N' 

		");
      
    }

    $status_filter = DB::select(" SELECT DISTINCT putaway_status FROM wms_t_putaway ");

		$customer = DB::select(" SELECT * FROM wms_m_customer WHERE is_delete = 'N' ORDER BY cust_name ASC ");

		return view('putaway.all', compact('customer', 'putaway', 'status_filter'));

	}

	public function detail(Putaway $putaway, Tally $tally)
	{

		$putaway_detail = DB::select(" 
			SELECT
				`wms_t_putaway`.`putaway_no`,
				`wms_t_putaway`.`putaway_date`,
				`wms_t_putaway`.`tally_no`,
				`wms_t_putaway`.`putaway_rmk`,
				`wms_t_putaway`.`putaway_status`,
				`wms_t_putaway`.`status_date`,
				`wms_t_putaway`.`edit_by`,
				`wms_t_putaway`.`edit_date`,
				`wms_t_tally`.`tally_no`,
				`wms_t_tally`.`tally_date`,
				`wms_m_customer`.`cust_name`
			FROM
				`wms_t_putaway`
			INNER JOIN `wms_t_tally` 
				ON (`wms_t_putaway`.`tally_no` = `wms_t_tally`.`tally_no`)
			INNER JOIN `wms_m_customer` 
				ON (`wms_m_customer`.`cust_id` = `wms_t_tally`.`cust_id`)
			WHERE wms_t_putaway.putaway_no = '$putaway->putaway_no'

			");
		$putaway_detail = $putaway_detail[0];

		$putaway_items = DB::select("
			SELECT
			`wms_t_putaway_detail`.`putaway_detail_id`,
			`wms_t_putaway_detail`.`putaway_no`,
			`wms_t_putaway_detail`.`tally_no`,
			`wms_t_putaway_detail`.`item_number`,
			`wms_m_item`.`item_name`,
			`wms_m_item`.`spq_item`,
			`wms_t_putaway_detail`.`tally_qty`,
			`wms_t_putaway_detail`.`putaway_qty`,
			`wms_t_putaway_detail`.`putaway_qty`*`wms_m_item`.`spq_item` as 'a',
			`wms_t_putaway_detail`.`location_id`,
			`wms_m_location`.`location_code`,
			`wms_m_location`.`location_name`,
			`wms_m_uom`.`uom_code`
			FROM
				`wms_t_putaway_detail`
			INNER JOIN `wms_m_item` 
				ON (`wms_t_putaway_detail`.`item_number` = `wms_m_item`.`item_number`)
			INNER JOIN `wms_m_location` 
				ON (`wms_t_putaway_detail`.`location_id` = `wms_m_location`.`location_id`)
			INNER JOIN `wms_m_uom` 
				ON (`wms_m_item`.`uom_id` = `wms_m_uom`.`uom_id`)
		  WHERE `wms_t_putaway_detail`.`putaway_no` = '$putaway->putaway_no'
			");

		$tally_items = DB::select("
			SELECT
				`wms_t_tally_detail`.`tally_no`,
				`wms_t_tally_detail`.`tally_detail_id`,
				`wms_t_tally_detail`.`item_number`,
				`wms_t_tally_detail`.`tally_qty`,
				`wms_t_tally_detail`.`open_qty`,
				`wms_m_item`.`item_name`,
				`wms_m_item`.`item_description`,
				`wms_m_uom`.`uom_code`,
				`wms_t_tally_detail`.`device_id`
			FROM
				`wms_t_tally_detail`
			INNER JOIN `wms_m_item` 
				ON (`wms_t_tally_detail`.`item_number` = `wms_m_item`.`item_number`)
			INNER JOIN `wms_m_uom` 
				ON (`wms_m_item`.`uom_id` = `wms_m_uom`.`uom_id`)
			WHERE `wms_t_tally_detail`.`tally_no` = '$tally->tally_no'
				AND `wms_t_tally_detail`.`is_delete`='N' AND `wms_t_tally_detail`.`open_qty` != '0'
			");

		return view('putaway.detail', compact('putaway_detail', 'putaway_items', 'tally_items'));
	}

	public function add(Tally $tally)
	{
		$putaway_no = DB::select(" SELECT COUNT(*)+1 AS 'a' FROM wms_t_putaway WHERE MONTH(putaway_date) = MONTH(NOW()) ");
    $putaway_no = sprintf('%04s', $putaway_no[0]->a);

    $periode_id = DB::select("SELECT * FROM wms_m_periode order by periode_id desc limit 0,1");    
    $periode_id = $periode_id[0]->periode_id;

		return view('putaway.add', compact('tally', 'putaway_no', 'periode_id'));

	}

	protected function save(Request $request)
	{

		$Putaway = new Putaway;

		$Putaway->putaway_no   = $request->putaway_no;
		$Putaway->putaway_date = $request->putaway_date;
		$Putaway->periode_id   = $request->periode_id;
		$Putaway->tally_no     = $request->tally_no;
		$Putaway->putaway_rmk  = $request->putaway_rmk;
		$Putaway->status_date  = date('Y-m-d H:i:s');
		
		$Putaway->input_by   = Auth::user()->username;
		$Putaway->input_date = date('Y-m-d H:i:s');
		$Putaway->edit_by    = Auth::user()->username;
		$Putaway->edit_date  = date('Y-m-d H:i:s');
		$Putaway->save();

		toastr()->success('Putaway Added successfully');

		return redirect( route('tally.show', $request->tally_no) );

	}

	public function add_item(TallyDetail $tally_detail, Tally $tally, Putaway $putaway)
	{

		$data = DB::select("
			SELECT
				`wms_t_tally_detail`.`tally_detail_id`,
				`wms_t_tally_detail`.`tally_no`,
				`wms_t_tally_detail`.`item_number`,
				`wms_t_tally_detail`.`tally_qty`,
				`wms_t_tally_detail`.`put_qty`,
				`wms_t_tally_detail`.`open_qty`,
				`wms_m_item`.`item_name`,
				`wms_m_item`.`spq_item`,
				`wms_m_uom`.`uom_code`
			FROM
				`wms_t_tally_detail`
			INNER JOIN `wms_m_item` 
				ON (`wms_t_tally_detail`.`item_number` = `wms_m_item`.`item_number`)
			INNER JOIN `wms_m_uom` 
				ON (`wms_m_item`.`uom_id` = `wms_m_uom`.`uom_id`)
			WHERE `wms_t_tally_detail`.`tally_detail_id` = '$tally_detail->tally_detail_id'
			");
		$data = $data[0];

		$putaway_location = DB::select("
			SELECT * from wms_m_location WHERE `is_delete`='N' AND location_fill = '0'
		");

		$pallet = DB::select("
			SELECT * from wms_m_pallet where `is_delete`='N' AND pallet_full = '0'
		");

		return view('putaway.add_item', compact('tally_detail', 'tally', 'putaway', 'data', 'putaway_location', 'pallet'));

	}

	protected function save_item(Request $request)
	{
		// wms_m_putaway_detail
		$Putaway_detail = new PutawayDetail;

		$Putaway_detail->putaway_no                = $request->putaway_no;
		$Putaway_detail->tally_no                  = $request->tally_no;
		$Putaway_detail->item_number               = $request->item_number;
		$Putaway_detail->tally_qty                 = $request->tally_qty;
		$Putaway_detail->putaway_qty               = $request->putaway_qty;
		$Putaway_detail->putaway_detail_qty        = ($request->putaway_qty * $request->spq_item);
		$Putaway_detail->available_pick_qty        = $request->putaway_qty;
		$Putaway_detail->available_pick_qty_detail = ($request->putaway_qty * $request->spq_item);
		$Putaway_detail->location_id               = $request->location_id;
		$Putaway_detail->pallet_id                 = $request->pallet_id;
		
		$Putaway_detail->input_by   = Auth::user()->username;
		$Putaway_detail->input_date = date('Y-m-d H:i:s');
		$Putaway_detail->edit_by    = Auth::user()->username;
		$Putaway_detail->edit_date  = date('Y-m-d H:i:s');
		$Putaway_detail->save();

		// Update wms_t_tally
		DB::table('wms_t_tally')->where('tally_no', $request->tally_no)->update([

			'tally_status' => 'putaway_process',
			'status_date'  => date('Y-m-d H:i:s'),
			'edit_by'      => Auth::user()->username,
			'edit_date'    => date('Y-m-d H:i:s')

  	]);

  	// Update wms_m_pallet
  	DB::table('wms_m_pallet')->where('pallet_id', $request->pallet_id)->update([

			'pallet_fill' => '1',
			'pallet_full' => ($request->pallet_full == "") ? 0 : 1,
			'edit_by'     => Auth::user()->username,
			'edit_date'   => date('Y-m-d H:i:s')

  	]);

  	// Update wms_m_location
  	DB::table('wms_m_location')->where('location_id', $request->location_id)->update([

			'location_fill' => '1',
			'pallet_id'     => $request->pallet_id

  	]);

  	// UPDATE wms_t_tally_detail
  	DB::table('wms_t_tally_detail')->where('tally_no', $request->tally_no)->where('item_number', $request->item_number)->update([

				'tally_detail_status'      => 'putaway',
				'tally_detail_status_date' => date('Y-m-d H:i:s'),
				'put_qty'                  => $request->putaway_qty,
				'open_qty'                 => ($request->open_qty - $request->putaway_qty),

			 'edit_by'     => Auth::user()->username,
			 'edit_date'   => date('Y-m-d H:i:s')

  	]);

  	//  Insert into wms_t_location_stock
  	$Location_stock = new Locationstock;

		$Location_stock->putaway_no   = $request->putaway_no;
		$Location_stock->item_number  = $request->item_number;
		$Location_stock->location_qty = $request->putaway_qty;
		$Location_stock->location_id  = $request->location_id;
		
		$Location_stock->input_by     = Auth::user()->username;
		$Location_stock->input_date   = date('Y-m-d H:i:s');

		$Location_stock->save();

		// Insert into wms_t_pallet_stock
		$Palletstock = new Palletstock;

		$Palletstock->putaway_no          = $request->putaway_no;
		$Palletstock->item_number         = $request->item_number;
		$Palletstock->pallet_qty          = $request->putaway_qty;
		$Palletstock->pallet_ending_stock = $request->putaway_qty;
		$Palletstock->pallet_id           = $request->pallet_id;
		$Palletstock->location_id         = $request->location_id;
		$Palletstock->stock_open_picking  = $request->putaway_qty;

    $Palletstock->input_by     = Auth::user()->username;
		$Palletstock->input_date   = date('Y-m-d H:i:s');
		$Palletstock->save();

		toastr()->success('Item Added Successfully');

		return redirect( route('putaway.detail', ['putaway' => $request->putaway_no, 'tally' => $request->tally_no]) );

	}

	protected function finish_putaway(Request $request)
	{

		DB::table('wms_t_putaway')->where('tally_no', $request->tally_no)->update([

				'putaway_status' => 'putaway_finish',
				
				'edit_by'        => Auth::user()->username,
				'edit_date'      => date('Y-m-d H:i:s')

  	]);

  	DB::table('wms_t_tally')->where('tally_no', $request->tally_no)->update([

				'tally_status' => 'tally_close',
				
				'edit_by'      => Auth::user()->username,
				'edit_date'    => date('Y-m-d H:i:s')

  	]);

  	toastr()->success('Finished Putaway');

		return redirect()->back();

	}

	// Filter by date
  public function filter_date(Request $request){

  	$putaway = DB::select("
  		SELECT
	  		`wms_t_putaway`.`putaway_no`,
	  		`wms_t_putaway`.`putaway_date`,
	  		`wms_t_putaway`.`tally_no`,
	  		`wms_t_putaway`.`putaway_rmk`,
	  		`wms_t_putaway`.`putaway_status`,
	  		`wms_t_putaway`.`status_date`,
	  		`wms_t_tally`.`tally_date`,
	  		`wms_m_customer`.`cust_name`
  		FROM
	  		`wms_t_tally`
  		INNER JOIN `wms_t_putaway` 
	  		ON (`wms_t_tally`.`tally_no` = `wms_t_putaway`.`tally_no`)
  		INNER JOIN `wms_m_customer` 
	  		ON (`wms_m_customer`.`cust_id` = `wms_t_tally`.`cust_id`)
  		WHERE wms_t_putaway.is_delete = 'N' 
  			AND tally_date between '$request->date_1' 
  			AND '$request->date_2'  
  			AND wms_t_tally.cust_id = '$request->cust_id'
  		");

    $status_filter = DB::select("
      SELECT DISTINCT putaway_status FROM wms_t_putaway
    ");

    $customer = DB::select(" SELECT * FROM wms_m_customer WHERE is_delete = 'N' ORDER BY cust_name ASC ");

    return view('putaway.all', compact('putaway','customer', 'status_filter'));

  }



}

?>
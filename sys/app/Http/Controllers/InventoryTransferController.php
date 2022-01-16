<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Warehouse\Warehouselocation;
use App\Model\Warehouse\PalletItems;
use App\Model\Warehouse\Pallet;
use App\Model\Stock\Palletstock;
use App\Model\Stock\MPalletStock;
use App\Model\Item\ItemMaster;
use App\Model\MovementHistory;

use DB;
use Auth;

class InventoryTransferController extends Controller
{

	public function index()
	{

		if (isset($_GET['search'])) {
			$location = Warehouselocation::where('is_delete', 'N')->where('location_code', 'like', '%' . $_GET['search'] . '%')->get();
		}else{
			$location = Warehouselocation::where('is_delete', 'N')->get();
		}

		return view("inventory_transfer.all", compact("location"));
	}

	public function detail(Warehouselocation $location)
	{

// 		$inventory_transfer = DB::select("
// 			SELECT
// 			`wms_t_pallet_stock`.`location_id`,
// 			`wms_t_pallet_stock`.`inbound_pallet_id`,
// 			`wms_m_location`.`location_code`,
// 			`wms_m_location`.`location_name`,
// 			`wms_t_pallet_stock`.`pallet_id`,
// 			`wms_m_pallet`.`pallet_name`,
// 			`wms_m_item`.`item_name`,
// 			`wms_t_pallet_stock`.`item_number`,
// 			`wms_t_pallet_stock`.`pallet_qty`,
// 			`wms_m_uom`.`uom_code`,
// 			`wms_m_customer`.`cust_name`,
// 			`wms_m_customer`.`cust_id`
// 			FROM
// 			`wms_t_pallet_stock`
// 			LEFT JOIN `wms_m_location` 
// 				ON (`wms_t_pallet_stock`.`location_id` = `wms_m_location`.`location_id`)
// 			LEFT JOIN `wms_m_item` 
// 				ON (`wms_t_pallet_stock`.`item_number` = `wms_m_item`.`item_number`)
// 			LEFT JOIN `wms_m_uom` 
// 				ON (`wms_m_item`.`uom_id` = `wms_m_uom`.`uom_id`)
// 			LEFT JOIN `wms_m_pallet` 
// 				ON (`wms_m_pallet`.`pallet_id` = `wms_t_pallet_stock`.`pallet_id`)
// 			LEFT JOIN `wms_m_customer` 
// 				ON (`wms_m_customer`.`cust_id` = `wms_m_item`.`cust_id`)
// 			WHERE wms_t_pallet_stock.location_id = '$location->location_id'

// 			");
			
		$inventory_transfer = Pallet::where("location_id", $location->location_id)->get();

		return view("inventory_transfer.detail", compact("inventory_transfer","location"));

	}

	public function move2($pallet, $location, $item)
	{
	    
	  $loc = Warehouselocation::where('location_id', $location)->first();

	  $pallets = array();
	  foreach ($loc->pallets as $l) {
	  	$pallets[] = $l->pallet_id;
	  }


	  $item_number = PalletItems::where('item_number', $item)->whereIn('pallet_id', $pallets)->first();

		$move_id = DB::select("SELECT COUNT(*)+1 AS 'a' FROM wms_t_movement_history WHERE MONTH(move_date) = MONTH(NOW()) ");
		$move_id = sprintf('%04s', $move_id[0]->a);
			
		$data = Pallet::where("location_id", $loc->location_id)->first();


		$getlocation = DB::select(" SELECT * FROM wms_m_location WHERE is_delete = 'N' ");
		$getpallet = DB::select(" SELECT * FROM wms_m_pallet where is_delete = 'N' and pallet_full = 0 ");
		
		return view("inventory_transfer.move", compact("move_id", "data", "getlocation", "loc", "item_number", "getpallet"));
		
	}

	// public function move(Warehouselocation $location, Palletstock $pallet)
	// {
	// 	$move_id = DB::select("SELECT COUNT(*)+1 AS 'a' FROM wms_t_movement_history WHERE MONTH(move_date) = MONTH(NOW()) ");
	// 	$move_id = sprintf('%04s', $move_id[0]->a);

	// 	$data = DB::select("

	// 		SELECT
	// 			`wms_t_pallet_stock`.`putaway_no`,
	// 			`wms_t_pallet_stock`.`location_id`,
	// 			`wms_t_pallet_stock`.`inbound_pallet_id`,
	// 			`wms_m_location`.`location_code`,
	// 			`wms_m_location`.`location_name`,
	// 			`wms_t_pallet_stock`.`pallet_id`,
	// 			`wms_m_pallet`.`pallet_name`,
	// 			`wms_m_item`.`item_name`,
	// 			`wms_m_item`.`spq_item`,
	// 			`wms_t_pallet_stock`.`item_number`,
	// 			`wms_t_pallet_stock`.`pallet_qty`,
	// 			`wms_m_uom`.`uom_code`,
	// 			`wms_m_customer`.`cust_name`,
	// 			`wms_m_customer`.`cust_id`
	// 		FROM
	// 			`wms_t_pallet_stock`
	// 			LEFT JOIN `wms_m_location` 
	// 			ON (`wms_t_pallet_stock`.`location_id`   = `wms_m_location`.`location_id`)
	// 			LEFT JOIN `wms_m_item` 
	// 			ON (`wms_t_pallet_stock`.`item_number`   = `wms_m_item`.`item_number`)
	// 			LEFT JOIN `wms_m_uom` 
	// 			ON (`wms_m_item`.`uom_id`                = `wms_m_uom`.`uom_id`)
	// 			LEFT JOIN `wms_m_pallet` 
	// 			ON (`wms_m_pallet`.`pallet_id`           = `wms_t_pallet_stock`.`pallet_id`)
	// 			LEFT JOIN `wms_m_customer` 
	// 			ON (`wms_m_customer`.`cust_id`           = `wms_m_item`.`cust_id`)
	// 			WHERE wms_t_pallet_stock.location_id     = '$location->location_id' 
	// 			AND wms_t_pallet_stock.inbound_pallet_id = $pallet->inbound_pallet_id

	// 		");
			
	// 	$data = Pallet::where("location_id", $location->location_id)->items;

	// 	$location = DB::select(" SELECT * FROM wms_m_location WHERE is_delete = 'N' ");
	// 	$pallet = DB::select(" SELECT * FROM wms_m_pallet where is_delete = 'N' and pallet_full = 0 and NOT (pallet_id = '$pallet->pallet_id') ");
		
	// 	return view("inventory_transfer.move", compact("move_id", "data", "location", "pallet"));
	// }

	protected function move_save(Request $request)
	{

		// Mencegah satu pallet dua location
		$count = DB::select(" 
			SELECT COUNT(pallet_id) as count FROM wms_m_pallet WHERE pallet_id = '$request->pallet_target' AND location_id = '$request->location_target'
		");

		// get m_pallet_stock
			$getMPallet = DB::table('wms_m_pallet_stock')->where([
				'item_number' => $request->item_number,
				'doc_number' 	=> $request->putaway_no,
				'pallet_id' 	=> $request->pallet_id
			])->get();

		if ( $count[0]->count == 0 AND ( $getMPallet[0]->qty - $request->qty_target ) > 0 ) {

			toastr()->error("1 Pallet Hanya Boleh 1 Location Yang Sama");

			return redirect()->back();

		}

			// Get next Id
			$move_id = DB::select("SELECT COUNT(*)+1 AS 'a' FROM wms_t_movement_history WHERE MONTH(move_date) = MONTH(NOW()) ");
			$move_id = sprintf('%04s', $move_id[0]->a);

			// Move Number / doc_number
			$move_number = "M".date('ymd').$move_id;

			// Save to Movement History
			$movement_history                      = new MovementHistory;
			$movement_history->movement_history_id = $move_number;
			$movement_history->move_date           = date('Y-m-d');
			$movement_history->item_number         = $request->item_number;
			$movement_history->location_id         = $request->location_id;
			$movement_history->location_target     = $request->location_target;
			$movement_history->pallet_id           = $request->pallet_id;
			$movement_history->pallet_target       = $request->pallet_target;
			$movement_history->move_qty            = $request->qty_target;
			$movement_history->moved_time          = date('H:i:s');
			$movement_history->moved_by            = Auth::user()->username;
			$movement_history->doc_type            = "inventory_transfer";
			$movement_history->doc_number          = $request->putaway_no;
			$movement_history->save();

			// Insert to wms_m_pallet_stock
			$MPalletStock                  = new MPalletStock;
			$MPalletStock->id_pallet_stock = NULL;
			$MPalletStock->pallet_id       = $request->pallet_target;
			$MPalletStock->item_number     = $request->item_number;
			$MPalletStock->doc_type        = "inventory_transfer";
			$MPalletStock->doc_number      = $move_number;
			$MPalletStock->qty             = $request->qty_target;
			$MPalletStock->qty_detail      = ($request->qty_target * $request->spq_item);
			$MPalletStock->save();

			// jika semua qty item di pindah
			if( ( $getMPallet[0]->qty - $request->qty_target ) == 0 ){

				// delete pallet item when it 0
				MPalletStock::where(['pallet_id' => $request->pallet_id, 'doc_number' => $request->putaway_no])->delete();

			}else{

				// kurangai stock
				DB::table('wms_m_pallet_stock')->where([
					'pallet_id'     => $request->pallet_id,
					'item_number'   => $request->item_number,
					'doc_number' 		=> $request->putaway_no
				])->update([
					'qty' => ( $getMPallet[0]->qty - $request->qty_target),
					'qty_detail'  => $getMPallet[0]->qty_detail - ($request->qty_target * $request->spq_item),
				]);

			}

			$count_pallet = PalletItems::where('pallet_id', $request->pallet_id)->count();
			if ($count_pallet == 0) {
					// update pallet set pallet_fill and location_id make it empty
				DB::table('wms_m_pallet')->where([
					'pallet_id' => $request->pallet_id
				])->update([
					'pallet_fill' => 0,
					'location_id' => null
				]);
			}

			$count_location = Pallet::where('location_id', $request->location_id)->count();
			if($count_location == 0){
					// update location set location_fill and pallet_id make it empty
				DB::table('wms_m_location')->where([
					'location_id' => $request->location_id
				])->update([
					'location_fill' => 0,
					'pallet_id' => 0
				]);
			}
			
			// update location target add pallet to it
			DB::table('wms_m_location')->where([
				'location_id'     => $request->location_target
			])->update([
				'pallet_id' => $request->pallet_target,
				'location_fill' => 1
			]);

				// update pallet target add location to it
			DB::table('wms_m_pallet')->where([
				'pallet_id'     => $request->pallet_target
			])->update([
				'location_id' => $request->location_target,
				'pallet_fill' => 1
			]);

		toastr()->success("Move Item Success");

		return redirect( route('inventory_transfer.detail', $request->location_target) );

	}

}

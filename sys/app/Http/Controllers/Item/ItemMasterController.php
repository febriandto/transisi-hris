<?php

namespace App\Http\Controllers\Item;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Item\ItemMaster;

use Auth;
use DB;

class ItemMasterController extends Controller
{
	
	public function index(){

		$item_master = DB::select("
			SELECT
				`wms_m_item`.`item_number`,
				`wms_m_item`.`item_name`,
				`wms_m_item`.`item_description`,
				`wms_m_uom`.`uom_code`,
				`wms_m_uom`.`uom_id`,
				`wms_m_item_cat`.`item_cat_id`,
				`wms_m_item_cat`.`item_cat_name`,
				`wms_m_customer`.`cust_id`,
				`wms_m_customer`.`cust_name`,
				`wms_m_item`.`begining_stock`,
				`wms_m_item`.`ending_stock`,
				`wms_m_item`.`item_rmk`,
				`wms_m_item`.`spq_item`,
				`wms_m_item`.`spq_pallet`,
				`wms_m_item`.`item_status`
			FROM
				`wms_m_item`
			LEFT JOIN `wms_m_item_cat` 
				ON (`wms_m_item`.`item_cat_id` = `wms_m_item_cat`.`item_cat_id`)
			LEFT JOIN `wms_m_uom` 
				ON (`wms_m_item`.`uom_id` = `wms_m_uom`.`uom_id`)
			LEFT JOIN `wms_m_customer` 
				ON (`wms_m_item`.`cust_id` = `wms_m_customer`.`cust_id`)
			WHERE wms_m_item.is_delete = 'N'
		");

		return view('item_master.all', compact('item_master'));

	}

	public function add(){

		$uom = DB::select("
			SELECT * FROM wms_m_uom
			WHERE is_delete = 'N' 
			ORDER BY uom_code ASC
		");

		$item_cat = DB::select("
			SELECT * FROM wms_m_item_cat
			WHERE is_delete = 'N'
		");

		$customer = DB::select("
			SELECT * FROM wms_m_customer
			WHERE is_delete = 'N'
		");

		return view('item_master.add', compact('uom', 'item_cat', 'customer') );

	}

	public function save(Request $request){

		$ItemMaster = new ItemMaster;

		$ItemMaster->item_number      = $request->item_number;
		$ItemMaster->item_name        = $request->item_name;
		$ItemMaster->item_description = $request->item_description;
		$ItemMaster->uom_id           = $request->uom_id;
		$ItemMaster->second_uom       = $request->second_uom;
		$ItemMaster->item_cat_id      = $request->item_cat_id;
		$ItemMaster->cust_id          = $request->cust_id;
		$ItemMaster->begining_stock   = $request->begining_stock;
		$ItemMaster->item_rmk         = $request->item_rmk;
		$ItemMaster->spq_item         = $request->spq_item;
		$ItemMaster->spq_pallet       = $request->spq_pallet;
		
		$ItemMaster->input_by   = Auth::user()->username;
		$ItemMaster->input_date = date('Y-m-d H:i:s');
		$ItemMaster->save();

		toastr()->success('Item created successfully');

		return redirect( route('itemmaster.index') );

	}

	public function edit(ItemMaster $ItemMaster){

		$uom = DB::select("
			SELECT * FROM wms_m_uom
			WHERE is_delete = 'N' 
			ORDER BY uom_code ASC
		");

		$item_cat = DB::select("
			SELECT * FROM wms_m_item_cat
			WHERE is_delete = 'N'
		");

		$customer = DB::select("
			SELECT * FROM wms_m_customer
			WHERE is_delete = 'N'
		");

		return view('item_master.edit', compact('ItemMaster', 'uom', 'item_cat', 'customer' ));

	}

	public function update(Request $request){

		DB::table('wms_m_item')->where('item_number', $request->item_number)->update([

		'item_number'      => $request->item_number,
		'item_name'        => $request->item_name,
		'item_description' => $request->item_description,
		'uom_id'           => $request->uom_id,
		'second_uom'       => $request->second_uom,
		'item_cat_id'      => $request->item_cat_id,
		'cust_id'          => $request->cust_id,
		'begining_stock'   => $request->begining_stock,
		'item_rmk'         => $request->item_rmk,
		'spq_item'         => $request->spq_item,
		'spq_pallet'       => $request->spq_pallet,
		
		'edit_by'   => Auth::user()->username,
		'edit_date' => date('Y-m-d H:i:s')

		]);

		toastr()->success('Edit successfully');

		return redirect( route('itemmaster.index') );

	}

	public function delete(Request $request){

		DB::table('wms_m_item')->where('item_number', $request->item_number)->update([

		'is_delete'      => 'Y',
		
		'del_by'   => Auth::user()->username,
		'del_date' => date('Y-m-d H:i:s')

		]);

		toastr()->success('Delete successfully');

		return redirect( route('itemmaster.index') );

	}

	public function detail($item_number){

		$item = DB::select("
			SELECT
				`wms_m_item`.`item_number`,
				`wms_m_item`.`item_name`,
				`wms_m_item`.`item_description`,
				`wms_m_uom`.`uom_code`,
				`wms_m_uom`.`uom_id`,
				`wms_m_item_cat`.`item_cat_id`,
				`wms_m_item_cat`.`item_cat_name`,
				`wms_m_customer`.`cust_id`,
				`wms_m_customer`.`cust_name`,
				`wms_m_item`.`begining_stock`,
				`wms_m_item`.`ending_stock`,
				`wms_m_item`.`item_rmk`,
				`wms_m_item`.`spq_item`,
				`wms_m_item`.`spq_pallet`,
				`wms_m_item`.`item_status`,
				`wms_m_item`.`second_uom`
			FROM
				`wms_m_item`
			LEFT JOIN `wms_m_item_cat` 
				ON (`wms_m_item`.`item_cat_id` = `wms_m_item_cat`.`item_cat_id`)
			LEFT JOIN `wms_m_uom` 
				ON (`wms_m_item`.`uom_id` = `wms_m_uom`.`uom_id`)
			LEFT JOIN `wms_m_customer` 
				ON (`wms_m_item`.`cust_id` = `wms_m_customer`.`cust_id`)
			WHERE wms_m_item.is_delete = 'N' AND wms_m_item.item_number = '$item_number'
		");

		$item = $item[0];

		return view( "item_master.detail", compact("item") );

	}

}

?>
<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use Auth;
use DB;

use App\Model\Customer\Customermaster;

class CustomerMasterController extends Controller
{


	function index()
	{
		$customers = Customermaster::where(['is_delete'=> 'N'])->get();
		$no = 1;

		return view('customer.all', compact('customers', 'no'));
	}

	public function add(){

		$customer = Customermaster::where(['is_delete' => 'N'])->get();

		$cust_id = DB::select(" SELECT count(*)+1 as 'a' FROM wms_m_customer ");
		$cust_id = sprintf('%04s', $cust_id[0]->a);

		return view('customer.add', compact('customer', 'cust_id'));

	}

	public function save(Request $request){

		$Customermaster = new Customermaster;

		$Customermaster->cust_id             = $request->cust_id;
		$Customermaster->cust_name           = $request->cust_name;
		$Customermaster->cust_phone          = $request->cust_phone;
		$Customermaster->cust_email          = $request->cust_email;
		$Customermaster->cust_fax            = $request->cust_fax;
		$Customermaster->cust_person         = $request->cust_person;
		$Customermaster->cust_contact_person = $request->cust_contact_person;
		$Customermaster->cust_remarks        = $request->cust_remarks;
		$Customermaster->npwp_no             = $request->npwp_no;
		$Customermaster->cust_address        = $request->cust_address;

		$Customermaster->input_by   = Auth::user()->username;
		$Customermaster->input_date = date('Y-m-d H:i:s');
		$Customermaster->save();

		toastr()->success('Customer created successfully');

		return redirect( route('customermaster.index') );

	}

	public function edit(Customermaster $customermaster){

		return view('customer.edit', compact('customermaster'));

	}

	public function update(Request $request){

		$insert = DB::table('wms_m_customer')->where('cust_id', $request->cust_id)->update([

		'cust_id'             => $request->cust_id,
		'cust_name'           => $request->cust_name,
		'cust_phone'          => $request->cust_phone,
		'cust_email'          => $request->cust_email,
		'cust_fax'            => $request->cust_fax,
		'cust_person'         => $request->cust_person,
		'cust_contact_person' => $request->cust_contact_person,
		'cust_remarks'        => $request->cust_remarks,
		'npwp_no'             => $request->npwp_no,
		'cust_address'        => $request->cust_address,

			'edit_by'   => Auth::user()->username,
			'edit_date' => date('Y-m-d H:i:s')

		]);

		toastr()->success('Edit successfully');

		return redirect( route('customermaster.index') );
	}

	protected function delete(Request $request){

		DB::table('wms_m_customer')->where('cust_id', $request->cust_id)->update([

			'is_delete' => 'Y',

			'del_by'   => Auth::user()->username,
			'del_date' => date('Y-m-d H:i:s')

		]);

		toastr()->success('Delete success');

		return redirect( route('customermaster.index') );

	}

	public function detail(Customermaster $customermaster){

		$items = DB::select("
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

		$customer_address = DB::table('wms_m_customer_add')->where('cust_id', $customermaster['cust_id'])->get();

		return view('customer.detail', compact('customermaster', 'customer_address', 'items'));

	}

	// public function inventory_monitor(Customermaster $customermaster){

	//   $cust_id = $customermaster->cust_id;

	//   $inventory_monitor = DB::select("
	//     SELECT
	//     wms_m_item.item_number,
	//     wms_m_item.item_name,
	//     wms_m_item.item_description,
	//     wms_m_uom.uom_code,
	//     wms_m_uom.uom_id,
	//     wms_m_item_cat.item_cat_id,
	//     wms_m_item_cat.item_cat_name,
	//     wms_m_customer.cust_id,
	//     wms_m_customer.cust_name,
	//     wms_m_item.begining_stock,
	//     wms_m_item.ending_stock,
	//     wms_m_item.item_rmk,
	//     wms_m_item.spq_item,
	//     wms_m_item.spq_item*wms_t_loading_detail.loading_qty as 'b',
	//     wms_m_item.item_status,
	//     sum(wms_t_putaway_detail.putaway_qty) as 'a',
	//     wms_t_loading_detail.loading_qty
	//     FROM wms_m_item 
	//     INNER JOIN wms_m_item_cat USING (item_cat_id)
	//     INNER JOIN wms_m_customer USING (cust_id)
	//     INNER JOIN wms_m_uom USING (uom_id)
	//     LEFT JOIN wms_t_putaway_detail USING (item_number)
	//     LEFT JOIN wms_t_loading_detail USING (item_number)
	//     where wms_m_item.is_delete = 'N'
	//     and wms_m_item.cust_id = '$cust_id'
	//     group by wms_m_item.item_number
	//   ");

	//   return view('customer.inventory_monitor', compact('customermaster','inventory_monitor'));

	// }

}

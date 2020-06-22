<?php

namespace App\Http\Controllers\Tally;

use Illuminate\Http\Request;
use App\Model\Tally\Tally;
use App\Model\Tally\TallyDetail;
use App\Model\Item\ItemMaster;
use App\Http\Controllers\Controller;

use Auth;
use DB;


class AllController extends Controller
{

	// All Tally Data View
	function index()
	{

    if (isset($_GET['filter_by_status'])) {
      
      $tally = DB::select(" 
        SELECT * FROM
        `wms_t_tally`
      INNER JOIN `wms_m_customer` 
        ON (`wms_t_tally`.`cust_id` = `wms_m_customer`.`cust_id`)
      WHERE wms_t_tally.is_delete = 'N' and tally_status = '$_GET[filter_by_status]' order by tally_no desc
      ");

    }else{

      $tally = DB::select(" 
        SELECT * FROM
        `wms_t_tally`
        INNER JOIN `wms_m_customer` 
        ON (`wms_t_tally`.`cust_id` = `wms_m_customer`.`cust_id`)
        where wms_t_tally.is_delete = 'N' order by tally_no desc
      ");
      
    }

    $status_filter = DB::select("
      SELECT DISTINCT tally_status FROM wms_t_tally
    ");

    $customer = DB::select(" SELECT * FROM wms_m_customer WHERE is_delete = 'N' ORDER BY cust_name ASC ");

		return view('tally.all', compact('tally', 'customer', 'status_filter'));

  }

  // Filter by date
  public function filter_date(Request $request){

    $tally = DB::select("
      SELECT * FROM
        `wms_t_tally`
      INNER JOIN `wms_m_customer` 
        ON (`wms_t_tally`.`cust_id` = `wms_m_customer`.`cust_id`)
      WHERE wms_t_tally.is_delete = 'N' 
      and tally_date between '$request->date_1' AND '$request->date_2' 
      AND wms_t_tally.cust_id = '$request->cust_id' 
      order by tally_no desc
    ");

    $status_filter = DB::select("
      SELECT DISTINCT tally_status FROM wms_t_tally
    ");

    $customer = DB::select(" SELECT * FROM wms_m_customer WHERE is_delete = 'N' ORDER BY cust_name ASC ");

    return view('tally.all', compact('tally','customer', 'status_filter'));

  }

  // New Tally
  function add()
	{
		$tally_no = DB::select(" SELECT count(*)+1 as 'a' FROM wms_t_tally WHERE MONTH(tally_date) = MONTH(NOW()) ");
		$tally_no = sprintf('%04s', $tally_no[0]->a);

		$customers = DB::select(" SELECT * FROM wms_m_customer WHERE is_delete = 'N' ORDER BY cust_name ASC ");

		return view('tally.add', compact('customers', 'tally_no'));
  }

  // New Tally Save
  public function save(Request $request){

		$tally             = new Tally;
		$tally->tally_no   = $request->tally_no;
		$tally->tally_date = $request->tally_date;
		$tally->tally_desc = $request->tally_desc;
		$tally->cust_id    = $request->cust_id;
		$tally->tally_rmk  = $request->tally_rmk;
		
		$tally->input_by   = Auth::user()->username;
		$tally->input_date = date('Y-m-d H:i:s');
		$tally->save();

		toastr()->success('Tally created successfully');

		return redirect( route('tally.index') );

  }

  // Tally Detail
  public function show( Tally $tally ){

  	// Tally
  	$data = DB::select("
	  		SELECT * FROM `wms_t_tally`
	  		INNER JOIN `wms_m_customer` 
	  		ON (`wms_t_tally`.`cust_id` = `wms_m_customer`.`cust_id`)
	  		where wms_t_tally.tally_no = '$tally->tally_no'
  	");

  	// Tally Items
  	$tally_items = DB::select("

  	SELECT
  		`wms_t_tally_detail`.`tally_detail_id`,
  		 `wms_t_tally_detail`.`tally_no`,
  		  `wms_t_tally_detail`.`item_number`,
  		  `wms_t_tally_detail`.`tally_qty`,
  		  `wms_t_tally_detail`.`put_qty`,
  		  `wms_t_tally_detail`.`open_qty`,
  		  `wms_t_tally_detail`.`tally_detail_status`,
  		  `wms_t_tally_detail`.`tally_detail_status_date`,
  		  `wms_t_tally`.`tally_status`,
  		  `wms_m_item`.`item_name`,
  		  `wms_m_item`.`item_description`,
  		  `wms_m_item`.`spq_item`,
  		  (`wms_m_item`.`spq_item`*`wms_t_tally_detail`.`tally_qty`) as 'a',
  		  `wms_m_item`.`spq_pallet`,
  		  `wms_m_uom`.`uom_code`
  		FROM
  		`wms_t_tally`
  		INNER JOIN `wms_t_tally_detail` 
  		ON (`wms_t_tally`.`tally_no` = `wms_t_tally_detail`.`tally_no`)
  		INNER JOIN `wms_m_item` 
  		ON (`wms_t_tally_detail`.`item_number` = `wms_m_item`.`item_number`)
  		INNER JOIN `wms_m_uom` 
  		ON (`wms_m_uom`.`uom_id` = `wms_m_item`.`uom_id`)
  		WHERE `wms_t_tally_detail`.`tally_no` = '$tally->tally_no'
  		and `wms_t_tally_detail`.`is_delete`='N'

  		");

  	// Putaway
  	$putaway = DB::select("
  		SELECT * FROM `wms_t_putaway`
      WHERE tally_no = '$tally->tally_no';
  	");

  	// convert array to object
		$data = $data[0];

    return view('tally.detail', compact('tally', 'data', 'tally_items', 'putaway'));

  }

  public function edit(Tally $tally){

  	$customers = DB::select(" SELECT * FROM wms_m_customer WHERE is_delete = 'N' ");

  	return view('tally.edit', compact('tally', 'customers'));

  }

  // New Tally Save
  public function update(Request $request){

  	DB::table('wms_t_tally')->where('tally_no', $request->tally_no)->update([

			'tally_no'   => $request->tally_no,
			'tally_date' => $request->tally_date,
			'tally_desc' => $request->tally_desc,
			'cust_id'    => $request->cust_id,
			'tally_rmk'  => $request->tally_rmk,
			
			'edit_by'   => Auth::user()->username,
			'edit_date' => date('Y-m-d H:i:s')

  	]);

		toastr()->success('Edit successfully');

		return redirect( route('tally.index') );

  }

  // Add Item page
  public function add_item(Tally $tally)
  {

    $items = DB::select("
      SELECT
      `wms_m_item`.`item_name`,
      `wms_m_item`.`item_description`,
      `wms_m_uom`.`uom_code`,
      `wms_m_item`.`item_number`,
      `wms_m_item`.`item_name`,
      `wms_m_item`.`cust_id`,
      `wms_m_uom`.`uom_code`
      FROM
        `wms_m_item`
      INNER JOIN `wms_m_uom` 
        ON (`wms_m_item`.`uom_id` = `wms_m_uom`.`uom_id`)
      WHERE wms_m_item.is_delete='N'
      AND `wms_m_item`.`cust_id` = '$tally->cust_id'
      ");

    return view('tally.add_item', compact('items', 'tally'));
  }

  // Save item
  protected function save_item(Request $request)
  {

    $tallydetail                           = new TallyDetail;

    $tallydetail->tally_no                 = $request->tally_no;
    $tallydetail->item_number              = $request->item_number;
    $tallydetail->tally_qty                = $request->tally_qty;
    $tallydetail->open_qty                 = $request->tally_qty;
    $tallydetail->tally_detail_status_date = date('Y-m-d H:i:s');
    
    $tallydetail->input_by   = Auth::user()->username;
    $tallydetail->input_date = date('Y-m-d H:i:s');
    $tallydetail->edit_by    = Auth::user()->username;
    $tallydetail->edit_date  = date('Y-m-d H:i:s');

    $tallydetail->save();

    toastr()->success('Item Added successfully');

    return redirect( route('tally.show', $request->tally_no) );

  }

  // Edit Item
  public function edit_item(Tally $tally, TallyDetail $item)
  {

    $tally_qty       = $item->tally_qty;
    $item_number     = $item->item_number;
    $tally_detail_id = $item->tally_detail_id;

    $items = DB::select("
        SELECT
        `wms_m_item`.`item_name`,
        `wms_m_item`.`item_description`,
        `wms_m_uom`.`uom_code`,
        `wms_m_item`.`item_number`,
        `wms_m_item`.`item_name`,
        `wms_m_item`.`cust_id`,
        `wms_m_uom`.`uom_code`
        FROM
          `wms_m_item`
        INNER JOIN `wms_m_uom` 
          ON (`wms_m_item`.`uom_id` = `wms_m_uom`.`uom_id`)
        WHERE wms_m_item.is_delete='N'
        AND `wms_m_item`.`cust_id` = '$tally->cust_id'
    ");

    return view('tally.edit_item', compact('item', 'items', 'tally', 'tally_qty', 'item_number', 'tally_detail_id'));

  }

  // New Tally Save
  protected function update_item(Request $request){

    DB::table('wms_t_tally_detail')->where('tally_detail_id', $request->tally_detail_id)->update([

      'item_number' => $request->item_number,
      'tally_qty'   => $request->tally_qty,
      'open_qty'    => $request->tally_qty,
      
      'edit_by'     => Auth::user()->username,
      'edit_date'   => date('Y-m-d H:i:s')

    ]);

    toastr()->success('Edit successfully');

    return redirect( route('tally.show', $request->tally_no) );

  }

  // Delete Item
  protected function delete_item(Request $request)
  {

    DB::table('wms_t_tally_detail')->where('tally_detail_id', $request->tally_detail_id)->update([

      'is_delete' => 'Y',
      
      'del_by'    => Auth::user()->username,
      'del_date'  => date('Y-m-d H:i:s')

    ]);

    toastr()->success('Delete successfully');

    return redirect()->back();

  }

  // Finish Tally Sheet
  protected function finish_tally(Request $request)
  {

    DB::table('wms_t_tally')->where('tally_no', $request->tally_no)->update([

      'tally_status' => 'finish_tally',
      
      'edit_by'    => Auth::user()->username,
      'edit_date'  => date('Y-m-d H:i:s')

    ]);

    toastr()->success('Tally Status Changed');

    return redirect()->back();

  }

}



?>
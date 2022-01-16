<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\ItemTransfer;
use App\Model\ItemTransferDetail;
use App\Model\Customer\Customermaster;
use App\Model\Warehouse\Pallet;
use App\Model\Warehouse\PalletItems;

use Auth;
use DB;
use DataTables;

class ItemTransferController extends Controller
{

	public function index(){

		$item_transfer = ItemTransfer::all();

		return view('item_transfer.all', compact('item_transfer'));

	}

	public function detail(ItemTransfer $item_transfer){

		$pallet_from = DB::select(" 

			SELECT a.*, b.item_name, c.cust_name, c.cust_id, b.spq_item FROM `wms_m_pallet_stock` a 
			LEFT JOIN wms_m_item b ON a.item_number = b.item_number 
			LEFT JOIN wms_m_customer c ON b.cust_id = c.cust_id 
			WHERE c.cust_id = '".$item_transfer->cust_id."' and pallet_id = '".$item_transfer->pallet_from."' and a.qty > 0 ORDER BY `a`.`id_pallet_stock` ASC

		 ");

		$pallet = Pallet::where('is_delete', 'N')->where('pallet_full', '0')->get();

		$item_transfer_detail = ItemTransferDetail::where('id_item_transfer', $item_transfer->id_item_transfer)->get();
		
		return view('item_transfer.detail', compact('item_transfer', 'pallet_from', 'pallet', 'item_transfer_detail'));

	}

	public function add(){

		$no_item_transfer = DB::select(" SELECT count(*)+1 as 'a' FROM wms_t_item_transfer WHERE MONTH(input_date) = MONTH(NOW()) and year(input_date) = year(now()) ");
		$no_item_transfer = sprintf('%04s', $no_item_transfer[0]->a);

		$customer = Customermaster::where('is_delete', 'N')->orderBy('cust_name', 'ASC')->get();

		
		return view('item_transfer.add', compact('no_item_transfer', 'customer'));

	}

	public function save(Request $request){

		$no_item_transfer = DB::select(" SELECT count(*)+1 as 'a' FROM wms_t_item_transfer WHERE MONTH(input_date) = MONTH(NOW()) and year(input_date) = year(now()) ");
		$no_item_transfer = sprintf('%04s', $no_item_transfer[0]->a);

		$ItemTransfer = new ItemTransfer;

		$ItemTransfer->id_item_transfer   = NULL;
		$ItemTransfer->no_item_transfer   = 'IT'.date('Ymd').$no_item_transfer;
		$ItemTransfer->desc_item_transfer = $request->desc_item_transfer;
		$ItemTransfer->cust_id            = $request->cust_id;
		$ItemTransfer->pallet_from        = $request->pallet_from;
		$ItemTransfer->input_by           = Auth::user()->username;
		$ItemTransfer->input_date         = date('y-m-d');
		$ItemTransfer->save();

		toastr()->success('Saved');

		return redirect(route('item_transfer.detail', $ItemTransfer->id_item_transfer));

	}

	public function edit(){
		
		return view('item_transfer.edit');

	}

	public function transfer_item(Request $request){

        $before = DB::select(DB::raw("select null, '".$request->cust_id."', count(*) as c, curdate() from (select pallet_id from wms_m_pallet_stock where qty > 0 and item_number in (select item_number from wms_m_item x where x.cust_id = '".$request->cust_id."') group by pallet_id) a"));

        $oldItem = DB::select("

				SELECT a.*, b.item_name, c.cust_name, c.cust_id FROM `wms_m_pallet_stock` a 
				LEFT JOIN wms_m_item b ON a.item_number = b.item_number 
				LEFT JOIN wms_m_customer c ON b.cust_id = c.cust_id 
				WHERE c.cust_id = '$request->cust_id' and pallet_id = '$request->pallet_from' and a.qty > 0 
				GROUP BY a.pallet_id 
				ORDER BY `a`.`id_pallet_stock` ASC

		");
		$oldItem = $oldItem[0];
	    
		//get Item
		$item = PalletItems::where([
			'id_pallet_stock' => $request->id_pallet_stock
		])->first();

		// Kurangi Pallet Stock
		PalletItems::where([
			'id_pallet_stock' => $request->id_pallet_stock
		])->update([
			'qty' => ( $item->qty - $request->qty ),
			'qty_detail' => $item->qty_detail - ( $item->item->spq_item * $request->qty ),
		]);
		
		if(@$request->pallet_full == '1'){
		    Pallet::where('pallet_id', $request->pallet_id)->update([
	            "pallet_full" => '1'
	        ]);
		}
		
	    $pallet_from = PalletItems::where('pallet_id', $item->pallet_id)->sum('qty');
	    
	    if($pallet_from <= 0){
	        Pallet::where('pallet_id', $item->pallet_id)->update([
	            "pallet_full" => '0',
	            'pallet_fill' => '0'
	        ]);
	        
	    }else{
	        
	        Pallet::where('pallet_id', $item->pallet_id)->update([
	            "pallet_full" => '0'
	        ]);
	    }

		// Create New Pallet Stock
		$PalletItems = new PalletItems;
		$PalletItems->plant_id        = $oldItem->plant_id;
		$PalletItems->inv_no          = $oldItem->inv_no;
		$PalletItems->batch           = $oldItem->batch;
		$PalletItems->division        = $oldItem->division;
		$PalletItems->id_pallet_stock = NULL;
		$PalletItems->pallet_id       = $request->pallet_id;
		$PalletItems->item_id         = $item->item_id;
		$PalletItems->item_number     = $request->item_number;
		$PalletItems->qty             = $request->qty;
		$PalletItems->qty_detail      = ( $item->item->spq_item * $request->qty );
		$PalletItems->doc_type        = "Item Transfer";
		$PalletItems->doc_number      = $request->no_item_transfer;
		$PalletItems->input_date      = date('Y-m-d H:i:s');
		$PalletItems->tgl_masuk       = $item->tgl_masuk;
		$PalletItems->save();

		// Add to History
		$ItemTransferDetail = new ItemTransferDetail;
		$ItemTransferDetail->id_item_transfer_detail = NULL;
		$ItemTransferDetail->id_item_transfer        = $request->id_item_transfer;
		$ItemTransferDetail->item_number             = $request->item_number;
		$ItemTransferDetail->qty                     = $request->qty;
		$ItemTransferDetail->qty_detail              = ( $item->item->spq_item * $request->qty );
		$ItemTransferDetail->pallet_id               = $request->pallet_id;
		$ItemTransferDetail->input_by           = Auth::user()->username;
		$ItemTransferDetail->input_date         = date('y-m-d');
		$ItemTransferDetail->save();
		
        $after = DB::select(DB::raw("select null, '".$request->cust_id."', count(*) as c, curdate() from (select pallet_id from wms_m_pallet_stock where qty > 0 and item_number in (select item_number from wms_m_item x where x.cust_id = '".$request->cust_id."') group by pallet_id) a"));
	    
	    $after_count = ($after[0]->c - $before[0]->c) >= 0 ? ($after[0]->c - $before[0]->c) : 0;
	    
        // update pallet usage history
        DB::update(DB::raw("insert into wms_t_pallet_usage_history values (null, '".$request->cust_id."', '".$before[0]->c."', '".($after_count)."', '0', '".$after[0]->c."', now())"));

		toastr()->success('Success');

		return redirect()->back();
		
	}

	public function get_pallet_item_transfer($cust_id){
		echo '<option value="">- Pilih Sumber Pallet -</option>';
		foreach(DB::select(DB::raw(" SELECT a.*, b.item_name, c.cust_name, c.cust_id FROM `wms_m_pallet_stock` a LEFT JOIN wms_m_item b ON a.item_number = b.item_number LEFT JOIN wms_m_customer c ON b.cust_id = c.cust_id WHERE c.cust_id = '".$cust_id."' and a.qty > 0 GROUP BY a.pallet_id ORDER BY `a`.`id_pallet_stock` ASC ")) as $data){
			echo '<option value="'.$data->pallet_id.'">' .$data->pallet_id. '</option>';
		}
	}

}
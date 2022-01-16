<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Picking\Picking;
use App\Model\Picking\PickingDetail;
use App\Model\Customer\Customermaster;
use App\Model\Customer\Customeraddress;
use App\Model\Deliverynote;
use App\Model\Loading\Loading;
use App\Model\Loading\LoadingDetail;
use App\Model\DeliveryNoteDetail;
use App\Model\Warehouse\Vehicle;
use App\Model\Warehouse\PalletItems;
use App\Model\Warehouse\Pallet;

use DB;
use Auth;

class DeliveryNoteController extends Controller
{

	public function index(){

		$dataDN = [];

		if ( isset($_GET['filter_by_status']) ) {
			$dn = Deliverynote::where(['is_delete' => 'N', 'dn_status' => $_GET['filter_by_status']])->orderBy('dn_id', 'DESC')->get();
		}else{
			$dn = Deliverynote::where('is_delete', 'N')->orderBy('dn_id', 'DESC')->get();
		}

		foreach($dn as $data ){

			$data->total_pallet = $data->items()->distinct('pallet_id')->count('pallet_id');

			$dataDN[] = $data;

		}

		$dn_status = DB::select(' SELECT DISTINCT dn_status FROM `wms_t_dn` WHERE is_delete = "N" ');

		return view('delivery_note.all', compact('dataDN', 'dn_status') );

	}

	public function datatables(Request $request){

		$no = 1 + ($request->length * $request->start);
		$data = [];

		$length = @$request->length == '' ? 25 : $request->length;
		$start = @$request->start == '' ? 0 : $request->start;

		if ( isset($_GET['filter_by_status']) ) {
			$dn = Deliverynote::where(['is_delete' => 'N', 'dn_status' => $_GET['filter_by_status']])->orderBy('dn_id', 'DESC');
		}else{
			$dn = Deliverynote::where('is_delete', 'N')->orderBy('dn_id', 'DESC');
		}

		if($request->search['value'] != ""){

			$dn = $dn->where('dn_id', 'like', '%'.$request->search['value'].'%')->where('is_delete', 'N')
								->orWhere('dn_number', 'like', '%'.$request->search['value'].'%')->where('is_delete', 'N')
								->orWhere('dn_driver_name', 'like', '%'.$request->search['value'].'%')->where('is_delete', 'N')
								->orWhere('dn_date', 'like', '%'.$request->search['value'].'%')->where('is_delete', 'N')
								->orWhere('dn_status', 'like', '%'.$request->search['value'].'%')->where('is_delete', 'N');

		}

		if($request->order[0]['column'] == 0){
			$dn = $dn->orderBy('dn_id', $request->order[0]['dir']);
		}
		if($request->order[0]['column'] == 1){
			$dn = $dn->orderBy('dn_number', $request->order[0]['dir']);
		}
		if($request->order[0]['column'] == 2){
			$dn = $dn->orderBy('dn_number', $request->order[0]['dir']);
		}
		if($request->order[0]['column'] == 3){
			$dn = $dn->orderBy('dn_number', $request->order[0]['dir']);
		}
		if($request->order[0]['column'] == 4){
			$dn = $dn->orderBy('dn_number', $request->order[0]['dir']);
		}
		if($request->order[0]['column'] == 5){
			$dn = $dn->orderBy('dn_number', $request->order[0]['dir']);
		}
		if($request->order[0]['column'] == 6){
			$dn = $dn->orderBy('dn_driver_name', $request->order[0]['dir']);
		}
		if($request->order[0]['column'] == 7){
			$dn = $dn->orderBy('dn_id', $request->order[0]['dir']);
		}
		if($request->order[0]['column'] == 8){
			$dn = $dn->orderBy('dn_date', $request->order[0]['dir']);
		}
		if($request->order[0]['column'] == 9){
			$dn = $dn->orderBy('dn_status', $request->order[0]['dir']);
		}
		if($request->order[0]['column'] == 10){
			$dn = $dn->orderBy('dn_id', $request->order[0]['dir']);
		}
		if($request->order[0]['column'] == 11){
			$dn = $dn->orderBy('dn_id', $request->order[0]['dir']);
		}

		$count_total = $dn->count();

		$dn = $dn->take($length)->skip($start)->get();

		
		foreach ($dn as $key => $value) {

			$value['no'] = $no++;
			$value['dn_number'] = $value->dn_number;
			$value['cust_name'] = @$value->customer->cust_name;
			$value['cust_address'] = @$value->address->add_name;
			$value['cust_vehicle'] = @$value->vehicle->plat_no;
			$value['cust_actual_vehicle'] = @$value->actual_vehicle->plat_no;
			$value['driver'] = $value->dn_driver_name;
			$value['total_pallet'] = $value->items()->distinct('pallet_id')->count('pallet_id');
			$value['date'] = date('d/m/Y', strtotime($value->dn_date));
			$value['status'] = @$value->dn_status == 'DELIVERED' ? '<span class="text-success">DELIVERED</span>' : 'DELIVERING';
			$value['option'] = '<a href="'. route('delivery_note.print', $value->dn_id).'" class="btn btn-sm btn-success d-block" target="_blank"> <i class="fa fa-print mx-2"></i></a>';

			$data[] = $value;

		}

		return json_encode([
			'recordsFiltered' => $count_total,
			'recordsTotal' => $count_total,
			'data' => $data,
			'draw' => $request->draw
		]);


	}

	public function picking(Picking $picking, Customermaster $customer){

		$dn_id = DB::select("SELECT COUNT(*)+1 AS 'a' FROM wms_t_dn");
		$dn_id = $dn_id[0]->a;
		$dn_id = sprintf('%02s', $dn_id);

		$PickingDetail = PickingDetail::where('is_delete', 'N')->get();

		$customeraddress = DB::select("  SELECT * FROM wms_m_customer_add WHERE cust_id = '$customer->cust_id'  ");

		$vehicle = Vehicle::all();

		return view('delivery_note.delivery_note', compact('picking', 'PickingDetail', 'customer', 'customeraddress', 'dn_id', 'vehicle'));

	}

	public function add(){

		$dn_id = DB::select("SELECT COUNT(*)+1 AS 'a' FROM wms_t_dn");
		$dn_id = $dn_id[0]->a;
		$dn_id = sprintf('%02s', $dn_id);

		$vehicle = Vehicle::all();
		$customer = Customermaster::where('is_delete', 'N')->get();
		$customeraddress = Customeraddress::where('is_delete', 'N')->get();

		$loading = Loading::where(['is_delete' => 'N', 'loading_status' => 'finish_loading'])->orderBy('loading_no', 'DESC')->get();

		return view('delivery_note.add', compact('dn_id', 'vehicle', 'customeraddress', 'customer', 'loading'));

	}

	protected function save(Request $request){

		$dn_id = DB::select("SELECT COUNT(*)+1 AS 'a' FROM wms_t_dn");
		$dn_id = $dn_id[0]->a;
		$dn_id = sprintf('%02s', $dn_id);

		$dn = new Deliverynote;
		$dn->dn_number       = "DN-".date('dmy')."-".$dn_id;
		$dn->dn_date         = date('Y-m-d H:i:s');
		$dn->dn_vehicle      = $request->dn_vehicle;
		$dn->dn_actual_vehicle      = $request->dn_actual_vehicle; 
		$dn->dn_driver_name  = $request->dn_driver_name;
		$dn->pallet_used     = $request->pallet_used;
		$dn->do_number       = $request->do_number;
		$dn->cust_id         = $request->cust_id;
		$dn->cust_address_id = $request->cust_address_id;
		$dn->dn_status       = "deliver";
		$dn->input_by        = Auth::user()->username;
		$dn->input_date      = date('Y-m-d H:i:s');
		$dn->save();
		
		$dn_last = Deliverynote::orderBy('dn_id', 'desc')->first();
		
		// Qrcode Generate
		if (!file_exists('qrcode/'.$request->dn_number.'.png' )) {

			\QrCode::backgroundColor(255, 255, 0)->color(255, 0, 127)
			->format('png')->size(150)
			->generate($request->dn_number, 'qrcode/'.$request->dn_number.'.png');
			
		}
		
		if(empty($request->loading_no)){

		    toastr()->success('Gagal, tidak ada Loading Number dipilih.');

		    return redirect(route('delivery_note.add'));
		    
		}else{

    		foreach ($request->loading_no as $key => $value) {

    			// get loading detail
    			$loading_detail  = LoadingDetail::where('loading_no', $value)->where('loading_qty', '>', '0')->where('is_issue', 'Y')->where('is_dn', 'N')->where('is_delete', 'N')->get();
    			
    			// get loading
    			$loading = Loading::where('loading_no', $value)->first();
	            
	            $before = DB::select(DB::raw("select null, '".$loading->cust_id."', count(*) as c, curdate() from (select pallet_id from wms_m_pallet_stock where qty > 0 and item_id in (select item_id from wms_m_item x where x.cust_id = '".$loading->cust_id."') group by pallet_id) a"));
	    
    			foreach($loading_detail as $detail){

    				$ld = LoadingDetail::where('loading_detail_id', $detail->loading_detail_id)->update([
	        				'is_dn' => 'Y'
	        		]);
    			
        			$item_to_update = PalletItems::where('id_pallet_stock', $detail->id_pallet_stock)->leftJoin('wms_m_item', 'wms_m_item.item_id', 'wms_m_pallet_stock.item_id')->leftJoin('wms_m_uom', 'wms_m_uom.uom_id', 'wms_m_item.uom_id')->first();

        			// update m_pallet_stock
                    PalletItems::where(['id_pallet_stock' => $detail->id_pallet_stock])->update([
                        'qty' => $item_to_update->qty - $detail->loading_qty,
                        'qty_detail' => $item_to_update->qty_detail - $detail->loading_detail_qty
                    ]);
                    
                    $is_fill = 1;
                    $cek = PalletItems::where('qty', '>', '0')->where('pallet_id', $item_to_update->pallet_id)->sum('qty');
                    
                    if($cek == 0){
                        $is_fill = 0;
                    }
                    
                    Pallet::where('pallet_id', $item_to_update->pallet_id)->update(['pallet_full' => '0', 'pallet_fill' => $is_fill]);
    
        			$dn_detail = new DeliveryNoteDetail;
        			$dn_detail->dn_id              = $dn_last->dn_id;
        			$dn_detail->dn_number          = $request->dn_number;
        			$dn_detail->cust_id             = $loading->cust_id;
        			$dn_detail->loading_no         = $value;
        			$dn_detail->item_id            = $detail->item_id;
        			$dn_detail->item_number        = $detail->item_number;
        			$dn_detail->loading_qty        = $detail->loading_qty;
        			$dn_detail->picking_no 		   = $detail->picking_no;
        			
        			$dn_detail->loading_detail_id  = $detail->loading_detail_id;
        			$dn_detail->is_valuated        = $detail->is_valuated;
        			$dn_detail->picking_detail_id  = $detail->picking_detail_id;
        			$dn_detail->id_pallet_stock    = $detail->id_pallet_stock;
        			
        			$dn_detail->loading_detail_qty = $detail->loading_detail_qty;
        			$dn_detail->uom_code           = $item_to_update->uom_code;
        			$dn_detail->second_uom         = $item_to_update->second_uom;
        			$dn_detail->pallet_id          = $detail->pallet_id;
        			$dn_detail->save();

        			// delivered_qty on wms_m_picking
        			$delivered_qty = DeliveryNoteDetail::where('picking_no', $detail->picking_no)->sum('loading_qty');
        			// update wms_m_picking
        			Picking::where('picking_no', $detail->picking_no)->update([
        				'delivered_qty' => $delivered_qty
        			]);

        			// delivered_qty on wms_m_loading
        			$delivered_qty_loading = DeliveryNoteDetail::where('loading_no', $detail->loading_no)->sum('loading_qty');
        			// Update wms_m_loading
        			Loading::where('loading_no', $detail->loading_no)->update([
        				'delivered_qty' => $delivered_qty_loading
        			]);
    			    
    			}
    
    			//update status
    			Loading::where('loading_no', $value)->update(['loading_status' => 'deliver']);
    			LoadingDetail::where('loading_no', $value)->update(['loading_detail_status' => 'deliver']);
    			
	            $after = DB::select(DB::raw("select null, '".$loading->cust_id."', count(*) as c, curdate() from (select pallet_id from wms_m_pallet_stock where qty > 0 and item_id in (select item_id from wms_m_item x where x.cust_id = '".$loading->cust_id."') group by pallet_id) a"));
    		
	            // update pallet usage history
	            DB::update(DB::raw("insert into wms_t_pallet_usage_history values (null, '".$loading->cust_id."', '".$before[0]->c."', '0', '".($before[0]->c - $after[0]->c)."', '".$after[0]->c."', now())"));
	            
    
    		}
		    toastr()->success('Delivery Note Tersimpan');

		    return redirect(route('delivery_note.index'));
		
		}

	}

	protected function save_print(Request $request){

		$dn_id = DB::select("SELECT COUNT(*)+1 AS 'a' FROM wms_t_dn");
		$dn_id = $dn_id[0]->a;
		$dn_id = sprintf('%02s', $dn_id);

		$dn_number = "DN".date('dmy')."-".$dn_id;

    // Qrcode Generate
		if (!file_exists('qrcode/'.$dn_number.'.png' )) {

			\QrCode::backgroundColor(255, 255, 0)->color(255, 0, 127)
			->format('png')->size(150)
			->generate($dn_number, 'qrcode/'.$dn_number.'.png');
			
		}

		// // Insert
		$dn = new Deliverynote;
		$dn->dn_id = NULL;
		$dn->dn_number = $dn_number;
		$dn->dn_date = $request->date;
		$dn->pallet_used = $request->pallet_used;
		$dn->picking_no = $request->picking_no;
		$dn->cust_id = $request->cust_id;
		$dn->cust_address_id = $request->address;
		$dn->do_number = $request->do_no;
		$dn->dn_driver_name = $request->driver;
		$dn->dn_vehicle = $request->vehicle_id;
		// $dn->dn_rmk = $request->rmk;
		$dn->dn_status = "Deliver";
		$dn->input_by            = Auth::user()->username;
		$dn->input_date          = date("y-m-d H:i:s");
		$dn->save();

		foreach ($_POST['items'] as $key => $value) {

			$picking_detail = PickingDetail::where([
				'is_delete' => 'N',
				'picking_detail_id' => $_POST['items'][$key]
			])->first();


			$dn_detail = new DeliveryNoteDetail;
			$dn_detail->dn_detail_id = NULL;
			$dn_detail->dn_id = $dn->dn_id;
			$dn_detail->dn_number = $request->number;
			$dn_detail->item_id = $picking_detail->item_id;
			$dn_detail->item_number = $picking_detail->item_number;
			$dn_detail->picking_detail_id = $picking_detail->picking_detail_id;
			$dn_detail->picking_no = $request->picking_no;
			$dn_detail->picking_qty = $picking_detail->picking_qty;
			$dn_detail->picking_detail_qty = $picking_detail->picking_detail_qty;
			$dn_detail->uom_code = $picking_detail->item->uom->uom_code;
			$dn_detail->second_uom = $picking_detail->item->second_uom;
	 // $dn_detail->dn_qty = ;
			$dn_detail->picking_open_qty = $picking_detail->picking_open_qty;
			$dn_detail->save();

		}

		toastr()->success("Delivery Note Tersimpan");

		return "<script>window.open('".route('delivery_note.print', $dn->dn_id)."', '_blank'); window.location.href = '".route('delivery_note.picking', ['picking' => $request->picking_no, 'customer' => $request->cust_id])."';</script>";

	}

	public function print(Deliverynote $delivery_note){

		$dn_detail = DeliveryNoteDetail::where([
			'dn_id' => $delivery_note->dn_id
		])->where('loading_detail_qty', '>', '0')->leftJoin('wms_m_item', 'wms_m_item.item_id', 'wms_t_dn_detail.item_id')->leftJoin('wms_m_uom', 'wms_m_uom.uom_id', 'wms_m_item.uom_id')
		    ->leftJoin('wms_m_pallet_stock', 'wms_m_pallet_stock.id_pallet_stock', 'wms_t_dn_detail.id_pallet_stock')->get();
		
		// Qrcode Generate
		if (!file_exists('qrcode/'.$delivery_note->dn_number.'.png' )) {

			\QrCode::backgroundColor(255, 255, 0)->color(255, 0, 127)
			->format('png')->size(150)
			->generate($delivery_note->dn_number, 'qrcode/'.$delivery_note->dn_number.'.png');
			
		}

		return view('delivery_note.print', compact('delivery_note', 'dn_detail'));

	}

	public function detail(Request $request){
        
        $delivery_note = Deliverynote::where('dn_number', $request->dn_number)->first();
        
		$dn_detail = DeliveryNoteDetail::where([
			'dn_id' => $delivery_note->dn_id
		])->where('loading_detail_qty', '>', '0')->leftJoin('wms_m_item', 'wms_m_item.item_id', 'wms_t_dn_detail.item_id')->leftJoin('wms_m_uom', 'wms_m_uom.uom_id', 'wms_m_item.uom_id')
		    ->leftJoin('wms_m_pallet_stock', 'wms_m_pallet_stock.id_pallet_stock', 'wms_t_dn_detail.id_pallet_stock')->get();

		return view('delivery_note.detail', compact('delivery_note', 'dn_detail'));

	}


	public function get_address($id_address){
		echo '<option value="">- Pilih Address -</option>';
		foreach(DB::select(DB::raw("SELECT * FROM wms_m_customer_add where cust_id = '$id_address' ")) as $data){
			echo '<option value='.$data->cust_add_id.'">' .$data->add_name. ' (' . $data->add_desc . ') '. '</option>';
		}
	}

	public function get_loading($cust_id, $vehicle_id){

		$loading = Loading::where(['is_delete' => 'N', 'vehicle_id' => $vehicle_id, 'cust_id' => $cust_id])->orderBy('loading_no', 'DESC')->get();
		
		
		$i = 1;
		foreach ($loading as $data) {

			$total_cancel_loading = 0;
			$total_loading_qty = 0;
			$total_loaded_qty = 0;
		  //  echo 'Loading <b>'.$data->loading_no.'</b><br>';

			$loading_detail = LoadingDetail::where(['is_delete' => 'N', 'loading_no' => $data->loading_no, 'is_dn' => 'N', 'is_issue' => 'Y'])->where('loading_qty', '>', '0')->get();
			$loading_pallet_count = LoadingDetail::where('loading_no', $data->loading_no)->groupBy('pallet_id')->count();
		
            $total_qty = $loading_detail->sum('loading_qty');
            if($total_qty > 0){
            
			echo '<tr>';
			echo '<td><input type="checkbox" id="checkbox" data-count-pallet="'.$loading_detail->count().'" data-count-pallet2="'.$loading_pallet_count.'" value="'.$data->loading_no.'" onchange="sumPallet()" name="loading_no[]"></td>';
			echo '<td class="expand-button" onclick="expandDetail(this)" data-id="'.$i.'"><i class="fa fa-chevron-right"></i></td>';
			echo '<td>'.$data->picking_no.'</a></td>';
			echo '<td>'.$data->loading_no.'</a></td>';
			echo '<td>'.$data->picking->customer->cust_name.'</td>';
			echo '<td>'.$total_qty.'</a></td>';
			echo '<td><span class="badge badge-success">'.$data->loading_status.'</span> <small>'.date("d-m-Y", strtotime($data->status_date)).'</small></td>';
			echo '</tr>';
			echo '<tr class="hide-table-padding">
			<td colspan="6">
			<div id="target_'.$i.'" style="display: none; border: 1px solid #DDD;">
			    <div style="padding: 10px;">
        			<table class="table mb-0">
        			<thead>
        			<tr>
        			<th>Item Number</th>
        			<th>Name</th>
        			<th>Loading Qty</th>
        			<th>Cancel Qty</th>
        			<th>Loaded Qty</th>
        			</tr>
        			</thead>
        			<tbody>';
        
        			foreach ($loading_detail as $value) {
        			    
        				echo '<tr class="item-list">';
        				echo '<td>'.$value->item_number.'</td>';
        				echo '<td>'.@$value->item->item_name.'</td>';
        				echo '<td>'.$value->loading_qty.'</td>';
        				echo '<td>'.$value->cancel_qty.'</td>';
        				echo '<td>'.($value->loading_qty - $value->cancel_qty).'</td>';
        				echo '</tr>';

        				$total_cancel_loading += $value->cancel_qty;
        				$total_loading_qty += $value->loading_qty;
        				$total_loaded_qty += ($value->loading_qty - $value->cancel_qty);
        			    
        			}
        
        			echo '</tbody>
        			<tfoot>
        			<tr>
        			<th></th>
        			<th></th>
        			<th>'.$total_loaded_qty.'</th>
        			<th>'.$total_cancel_loading.'</th>
        			<th>'.$total_loaded_qty.'</th>
        			</tr>
        			</tfoot>
        			</table>
    			</div>
			</div>
			</td>
			</tr>';

			$i++;
			
            }


		}

	}	

}
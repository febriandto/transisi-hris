<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Auth;
use DB;

use App\Model\Users;
use App\Model\Tally\Tally;
use App\Model\Tally\TallyDetail;

use App\Model\Picking\Picking;
use App\Model\Picking\PickingDetail;

use App\Model\Putaway\Putaway;
use App\Model\Putaway\PutawayDetail;

use App\Model\StockOpname\StockOpname;
use App\Model\StockOpname\StockOpnameDetail;

use App\Model\Warehouse\Pallet;
use App\Model\Warehouse\PalletItems;
use App\Model\Warehouse\PalletMovement;
use App\Model\Warehouse\Warehouselocation;
use App\Model\Item\ItemMaster;

use App\Model\Deliverynote;
use App\Model\DeliveryNoteDetail;

use App\Model\Loading\Loading;
use App\Model\Loading\LoadingDetail;

use App\Model\Vehicle;
use App\Model\LoadingDock;

class ApiController extends Controller
{
    
    public $app_version = "1.1.9";
    
    public function auth($username, $password, $imei = ""){
        
        $user = Users::where("username", $username)->first();

        if(!empty($user->username)){
            
            if (Hash::check($password, $user->password)) {
                
                $data = array();
                $data['username']   = $user->username;
                $data['name']       = $user->name;
                $data['level']      = $user->level;
                $data['status']     = $user->status;
                $data['id_user']    = $user->id_user;
                
                echo json_encode(array("data" => $data), JSON_PRETTY_PRINT);
                
            }else{
                return "invalid";
            }
        }else{
            return "invalid";
        }
        
    }
    
    public function app_version(){
        return $this->app_version;
    }
    
    public function reset_location_fill(){
        
        $locations = DB::select(DB::raw("SELECT a.location_id, b.location_id as id2 FROM wms_m_location a left join wms_m_pallet b on a.location_id = b.location_id where location_fill = 1  
ORDER BY `b`.`location_id` ASC"));
        
        $locs = array();
        foreach($locations as $loc){
            if($loc->id2 == "")
                $locs[] = $loc->location_id;
        }
        
        Warehouselocation::whereIn("location_id", $locs)->update(["location_fill" => '0']);
        
    }
    
    public function get_pallet(Request $req){
        
        $pallet = Pallet::where('pallet_id', $req->id)->first();
        
        $items = PalletItems::where('qty', '>', '0')->where('pallet_id', $req->id)->count();
        
        if($items == 0){
            Pallet::where('pallet_id', $req->id)->update([
                "pallet_full" => "0"
            ]);
        }
        
        if(@$pallet->pallet_id == ""){
            echo "not_found";
        }else{
            
            $items = PalletItems::where('qty', '>', '0')->where('pallet_id', $req->id)->get();
            
            $data = array();
            foreach($items as $t){
                $data[] = $t;
            }
            
            echo json_encode(array("data" => $data), JSON_PRETTY_PRINT);
            
        }
        
    }
    
    public function tally_history(){
        
        $tally = Tally::where('is_delete', 'N')->whereIn('tally_status', ['putaway_proccess', 'putaway_process'])->take(10)->skip(0)->orderBy('input_date', 'desc')->get();
        
        $data = array();
        foreach($tally as $t){
            $t['input_date'] = date("d/m/Y H:i", strtotime($t->input_date));
            $data[] = $t;
        }
        
        echo json_encode(array("data" => $data), JSON_PRETTY_PRINT);
        
    }
    
    public function tally_detail($tally_no){
        
        $tally_data = array();
        $tallys = PutawayDetail::where('tally_no', $tally_no)->orderBy('pallet_id', 'asc')->get();
        foreach($tallys as $tally){
            
            $tally_data[] = [
                    "id_tally_detail" => $tally->id_tally_detail,
                    // "item_number" => $tally->item_number != $tally->item->item_name ? $tally->item_number.' - '.$tally->item->item_name : $tally->item->item_name,
                    "item_number" => $tally->item_number,
                    "putaway_qty" => $tally->putaway_qty,
                    "putaway_detail_qty" => $tally->putaway_detail_qty,
                    "pallet_id" => $tally->pallet_id,
                    "location_id" => $tally->location_id,
                    "is_processed" => $tally->is_processed,
                    "putaway_no" => $tally->putaway_no
                ];
            
        }
        
        echo json_encode(array("data" => $tally_data), JSON_PRETTY_PRINT);
        
    }
    
    public function tally_data($mode, $keyword, Request $req){
        
        $tally = Tally::where('is_delete', 'N');
        
        if($mode == 'keyword'){
            $tally = $tally->where('tally_no', 'like', '%'.$keyword.'%');
        }
        
        if($mode == 'tally_no'){
            $tally = $tally->where('tally_no', $keyword);
        }
        
        $tally = $tally->whereIn('tally_status', ['finish_tally', 'putaway_proccess', 'putaway_process', 'tally_close'])->get();
        
        $data = array();
        foreach($tally as $t){
            $detail_count = TallyDetail::where('tally_no', $t->tally_no)->where('open_qty', '>', '0')->where('is_delete', 'N')->sum('open_qty');
            if($detail_count > 0){
                $t['total_open_qty'] = $detail_count;
                $data[] = $t;
            }
        }
        
        echo json_encode(array("data" => $data), JSON_PRETTY_PRINT);
        
    }
    
    public function tally_data_detail($tally_no){
        
        $tally = TallyDetail::where("tally_no", $tally_no)->where('open_qty', '>', '0')->where("is_delete", "N")->get();
        
        $data = array();
        foreach($tally as $t){
            if(isset($t->item)){
                $t['item_name'] = $t->item->item_number.' - '.$t->item_name;
                $t['item_id'] = $t->item_id;
                $t['item_number'] = $t->item_id;
                $t['tally_qty'] = $t->tally_qty;
                $t['item_qty'] = $t->tally_qty;
                $t['put_qty'] = $t->put_qty;
                $t['open_qty'] = $t->open_qty;
                $t['tally_detail_status'] = $t->tally_detail_status;
                $data[] = $t;
            }
        }
        
        $pallet = array();
        
        $pallet_data = Pallet::where(['is_delete' => 'N', 'pallet_full' => '0'])->get();
        
        foreach($pallet_data as $p){
            $pallet[] = $p->pallet_id;
        }
        
        $pallet = implode("#", $pallet);
        
        echo json_encode(array("data" => $data, "pallet" => $pallet), JSON_PRETTY_PRINT);
        
    }
    
    public function tally_save($tally_no, Request $request){
        
        $tally = Tally::where('tally_no', $tally_no)->first();
        Tally::where('tally_no', $tally_no)->update(['tally_status' => 'putaway_proccess']);
        
		$putaway_no = DB::select(" SELECT COUNT(*)+1 AS 'a' FROM wms_t_putaway WHERE MONTH(input_date) = MONTH(NOW()) and year(input_date) = year(now()) ");
		$putaway_no = "P".date("ymd").sprintf('%04s', $putaway_no[0]->a);
		
		$Putaway = new Putaway;

		$Putaway->putaway_no   = $putaway_no;
		$Putaway->putaway_date = date("Y-m-d H:i:s");
		$Putaway->periode_id   = date("m-Y");
		$Putaway->tally_no     = $tally_no;
		$Putaway->putaway_rmk  = "Putaway from tally no ".$tally_no.". Mobile";
		$Putaway->status_date  = date('Y-m-d H:i:s');
		
		$Putaway->input_by   = $request->username;
		$Putaway->input_date = date('Y-m-d H:i:s');
		$Putaway->edit_by    = $request->username;
		$Putaway->edit_date  = date('Y-m-d H:i:s');
		$Putaway->save();
		
		$tally_item = TallyDetail::where('tally_no', $tally_no)->where('is_delete', 'N')->get();
		
		$avail_qty = array();
		foreach($tally_item as $avail){
		    $avail_qty[$avail->item_id] = $avail->open_qty;
		}
		
		$inserted = array();
        
        $i = 0;
        $a = array();
        
        $items = array();
        foreach($request->item as $item){
            
            if(isset($items[$item.$request->pallet[$i]])){
                $items[$item.$request->pallet[$i]]['qty'] = $items[$item.$request->pallet[$i]]['qty'] + $request->item_qty[$i];
            }else{
                $items[$item.$request->pallet[$i]]['item'] = $item;
                $items[$item.$request->pallet[$i]]['qty'] = $request->item_qty[$i];
                $items[$item.$request->pallet[$i]]['pallet'] = $request->pallet[$i];
                $items[$item.$request->pallet[$i]]['pallet_full'] = $request->pallet_full[$i];
                $items[$item.$request->pallet[$i]]['pallet_note'] = @$request->pallet_note[$i];
            }
            
            $i++;
            
        }
        
        $i = 0;
        foreach($items as $item){
            
            $pick_item = $request->item[$i];
            $pick_qty = $request->item_qty[$i];
            $pallet_full = $request->pallet_full[$i];
            $pallet_note = @$request->pallet_note[$i];
            
            $detail = TallyDetail::where(['tally_no' => $tally_no, 'item_id' => $pick_item])->where('is_delete', 'N')->first();
            $item_detail = ItemMaster::where('item_id', $pick_item)->first();
            
            $id_pallet = $item['pallet'];
            
            // $inserted[] = "$avail_qty[$pick_item] > 0 && $avail_qty[$pick_item] >= $pick_qty";
            
            if(isset($avail_qty[$pick_item])){
                
                if($avail_qty[$pick_item] > 0 && $avail_qty[$pick_item] >= $pick_qty){
                    
                    // $inserted[] = $pick_item.' => '.$pick_qty;
                    
                    PutawayDetail::create([
                        'putaway_no' => $putaway_no,
                        'tally_no' => $tally_no,
                        'item_id' => $pick_item,
                        'item_number' => $item_detail->item_number,
                        'tally_qty' => $detail->tally_qty,
                        'pallet_note' => $pallet_note,
                        'putaway_qty' => $pick_qty,
                        'putaway_detail_qty' => $pick_qty * $item_detail->spq_item,
                        'available_pick_qty' => $pick_qty,
                        'available_pick_qty_detail' => $pick_qty * $item_detail->spq_item,
                        'pallet_id' => $id_pallet,
                        'input_by' => $request->username.' mobile',
                        'input_date' => date("Y-m-d H:i:s")
                    ]);
                        
                    Pallet::where('pallet_id', $id_pallet)->update(["pallet_full" => $pallet_full, "pallet_fill" => "1"]);
                    
                    TallyDetail::where(['tally_no' => $tally_no, 'item_id' => $pick_item])->where('is_delete', 'N')->update([
                            'put_qty' => $detail->put_qty + $pick_qty,
                            'open_qty' => $detail->open_qty - $pick_qty,
                            'tally_detail_status' => 'putaway'
                        ]);
                    
                }
                
            }
                
            $i++;
            
        }
        
        if($i > 0)
            echo $putaway_no;
        else
            echo 'failed';
        // echo json_encode($avail_qty);
        // echo json_encode($inserted);
        // // echo json_encode($a);
        
        
    }
    
    public function putaway_pallet_data(){
        
        $pallet_data = Warehouselocation::where(['is_delete' => 'N'])->get();
        $location = array();
        
        $pallet_id = array();
        $pallet_item = array();
        
        $pallet_data = Pallet::where(['is_delete' => 'N'])->get();
        
        $pallet = array();
        
        foreach($pallet_data as $p){
            
            $pallet_item2 = array();
            foreach($p->items->where('qty', '>', '0') as $item){
                $pallet_item2[] = $item->item->item_name.' ('.$item->qty.')';
            }
            
            $pallet_id = array();
            $pallet_id['pallet_name'] = $p->pallet_name;
            $pallet_id['pallet_id'] = $p->pallet_id;
            $pallet_id['items'] = '- '.implode("\n- ", $pallet_item2);
            $pallet[] = $pallet_id;
        }
        
        echo json_encode(array('pallet' => $pallet, "location" => $location), JSON_PRETTY_PRINT);
        
    }
    
    public function pallet_data(Request $request){
        
        $pallet_data = Pallet::where(['is_delete' => 'N']);
        
        if(@$request->empty_pallet == 'false'){
            $pallet_data = $pallet_data->where("pallet_fill", "1");
        }
        
        if(@$request->location_id != ''){
            $pallet_data = $pallet_data->where("location_id", $request->location_id);
        }
        
        if(@$request->picking_id != ''){
            
            $cust_id = Picking::where('picking_no', $request->picking_id)->first();
            if(!empty($cust_id)){
                $item_number = array();
                $item_number2 = ItemMaster::where('cust_id', $cust_id->cust_id)->get();
                foreach($item_number2 as $item){
                    $item_number[] = $item->item_id;
                }
            }else
                $item_number = array(); 
            
            $pallet_data = $pallet_data->whereIn("pallet_id", PalletItems::select('pallet_id')->whereIn('item_id', $item_number)->where('qty', '>', '0')->groupBy('pallet_id')->pluck('pallet_id'));
            
        }
        
        // var_dump($item_number);
        
        // echo $request->picking_id;
        
        $pallet_data = $pallet_data->get();
        
        $pallet = array();
        
        foreach($pallet_data as $p){
            
            // if($p->items != null){
            
                $pallet_item2 = array();
                
                if(@$request->picking_id != ''){
                    
                    $items = PickingDetail::selectRaw("item_number, item_id, id_pallet_stock, sum(picking_open_qty) as picking_open_qty")->where(['picking_no' => $request->picking_id, 'pallet_id' => $p->pallet_id])->where('is_delete', 'N')->groupBy('item_id', 'id_pallet_stock')->get();
                    
                    foreach($items as $item){
                        $qty_stock = PalletItems::where('pallet_id', $p->pallet_id)->where('item_id', $item->item_id)->sum('qty');
                    
                        if($item->picking_open_qty > 0 && $qty_stock > 0){
                            $pallet_item2[] = 
                                [
                                    "item_id" => $item->item_id, 
                                    "item_number" => $item->item_number, 
                                    "id_pallet_stock" => $item->id_pallet_stock, 
                                    "qty" => $item->picking_open_qty
                                ];
                        }
                    }
                    
                    // var_dump($items);
                    
                }else{
                    
                    $items = $p->items->where('qty', '>', 0);
                    
                    foreach($items as $item){
                        if($item->qty > 0){
                            $pallet_item2[] = 
                                [
                                    "item_id" => $item->item_id, 
                                    "item_number" => $item->item_number, 
                                    "qty" => $item->qty, 
                                    "id_pallet_stock" => $item->id_pallet_stock, 
                                    "pallet_id" => $item->pallet_id
                                ];
                        }
                    }
                }
                
                if(count($pallet_item2) > 0){
                
                    $pallet_id['pallet_name'] = $p->pallet_name;
                    $pallet_id['pallet_id'] = $p->pallet_id;
                    $pallet_id['pallet_fill'] = $p->pallet_fill;
                    $pallet_id['pallet_full'] = $p->pallet_full;
                    $pallet_id['items'] = $pallet_item2;
                    $pallet[] = $pallet_id;
                
                }
                
                
            // }
            
        }
        
        echo json_encode(array('data' => $pallet, "empty_pallet" => @$request->empty_pallet), JSON_PRETTY_PRINT);
        
    }
    
    public function putaway_pallet_save(Request $request){
        
        $pallet = Pallet::where('pallet_id', $request->pallet_id)->first();
        $location = Warehouselocation::where('location_code', $request->location_id)->first();
        
        $cek_location = Pallet::where('location_id', $location->location_id)->count();
        if($cek_location == 0){
            Warehouselocation::where('location_code', $request->location_id)->update(["location_fill" => 0]);
        }
        
        $cek2 = PalletItems::whereIn("pallet_id", Pallet::where('location_id', $location->location_id)->pluck('pallet_id'))->sum('qty');
        
        if($cek2 == 0){
            Warehouselocation::where('location_code', $request->location_id)->update(["location_fill" => 0]);
        }
        
        $location = Warehouselocation::where('location_code', $request->location_id)->first();
        
        // var_dump($location);
        
        if($pallet->location_id == $request->location_id){
            
            echo "location_same";
            
        }else{
        
            // if((isset($location->pallets) ? $location->pallets->count() : 0) >= (isset($location->max_pallet) ? $location->max_pallet : 1)){
                
            //     echo "location_full";
                
            // }else{
                
                // empty existing location
                Warehouselocation::where('location_id', $pallet->location_id)->update(['location_fill' => "0", "pallet_id" => null]);
                
                // fill new location
                Warehouselocation::where('location_code', $request->location_id)->update(['location_fill' => "1", "pallet_id" => $request->pallet_id]);
            
                // PutawayDetail::whereRaw('location_id is null')->where('pallet_id', $request->pallet_id)->update(['location_id' => $location->location_id]);
                
                Pallet::where('pallet_id', $request->pallet_id)->update(['location_id' => $location->location_id]);
                
                PalletMovement::create([
                    "pallet_id" => $pallet->pallet_id,
                    "location_from" => $pallet->location_id == '' ? '-' : $pallet->location_id,
                    "location_to" => $location->location_id,
                    "move_by" => $request->username,
                    "move_date" => date("Y-m-d H:i:s"),
                    "remarks" => $request->remarks
                ]);
                
                $items = PalletItems::where('pallet_id', $request->pallet_id)->get();
                
                foreach($items as $item){
            
                    DB::table("wms_t_movement_history")->insert([
                        "move_date" => date("Y-m-d"),
                        "item_number" => $item->item_number,
                        "location_id" => $item->location_id,
                        "location_target" => $location->location_id,
                        "pallet_id" => $request->pallet_id,
                        "pallet_target" => $request->pallet_id,
                        "move_qty" => $item->qty,
                        "doc_type" => "transfer",
                        "remarks" => $request->remarks,
                        "moved_by" => $request->username
        
                    ]);
                
                }
                
            
                echo "success";
            
            // }
            
        }
        
    }
    
    public function putaway_data($mode, $keyword, Request $req){
        
        $putaway = Putaway::where('is_delete', 'N')->where('putaway_status', '!=', 'putaway_finish');
        
        if($mode == 'keyword'){
            $putaway = $putaway->where('putaway_no', 'like', '%'.$keyword.'%');
        }
        
        if($mode == 'putaway_no'){
            $putaway = $putaway->where('putaway_no', $keyword);
        }
        
        $putaway = $putaway->get();
        
        $data = array();
        foreach($putaway as $t){
            $data[] = $t;
        }
        
        echo json_encode(array("data" => $data), JSON_PRETTY_PRINT);
        
    }
    
    public function putaway_data_detail($putaway_no){
        
        $tally = PutawayDetail::where("putaway_no", $putaway_no)->where("is_delete", "N")->get();
        
        $used_pallet = array();
        $pallet_item = array();
        
        $id_pallet = "";
        $data = array();
        foreach($tally as $t){
            $t['item_name'] = $t->item->item_name;
            $t['item_number'] = $t->item_number;
            $t['putaway_detail_id'] = $t->putaway_detail_id;
            $t['putaway_qty'] = $t->putaway_qty;
            $t['putaway_detail_qty'] = $t->putaway_detail_qty;
            $t['pallet_id'] = $t->pallet_id;
            $t['pallet_name'] = $t->pallet->pallet_name;
            $id_pallet = $t->pallet_id;
            
            $pallet_item[$t->pallet_id][] = $t->item->item_number.' ('.$t->putaway_qty.')';
            $used_pallet[] = $t->pallet_id; 
            
            $data[] = $t;
        }
        
        $pallet_data = Warehouselocation::where(['is_delete' => 'N'])->get();
        $location = array();
        
        foreach($pallet_data as $p){
            $p['location_code'] = $p->location_code;
            $p['location_id'] = $p->location_id;
            $location[] = $p;
        }
        
        $pallet_data = Pallet::where(['is_delete' => 'N'])->whereIn('pallet_id', $used_pallet)->get();
        $pallet = array();
        
        foreach($pallet_data as $p){
            $p['pallet_name'] = $p->pallet_name;
            $p['pallet_id'] = $p->pallet_id;
            $p['items'] = implode("\n", $pallet_item[$p->pallet_id]);
            $pallet[] = $p;
        }
        
        echo json_encode(array("data" => $data, 'pallet' => $pallet, "location" => $location), JSON_PRETTY_PRINT);
        
    }
    
    public function putaway_save($putaway_no, Request $request){
        
        $putaway = Putaway::where('putaway_no', $putaway_no)->first();
        
        Putaway::where('putaway_no', $putaway_no)->update(['putaway_status' => 'putaway_finish']);
        
        $i = 0;
        foreach($request->pallet_id as $id){
            PutawayDetail::where("pallet_id", $id)->update(["location_id" => $request->location_id[$i]]);
            $i++;
        }
        
        $tally = DB::select(
            DB::raw("
                select 
                    sum(case tally_detail_status when 'putaway' then 1 else 0 end) as count_putaway,
                    sum(case tally_detail_status when 'putaway' then 0 else 1 end) as count_non_putaway
                from 
                    wms_t_tally_detail 
                where 
                    tally_no = '$putaway->tally_no'
            ")
        );
        
        // if all tally detail is all putaway
        if($tally[0]->count_non_putaway == 0){
            
            $detail_tally = TallyDetail::where(['tally_no' => $putaway->tally_no])->where('open_qty', '<=', '0')->count();
            
            // if open qty is all empty
            if($detail_tally >= 0){
                Tally::where('tally_no', $putaway->tally_no)->update(['tally_status' => 'tally_close']);
            }
            
        }
        
        echo "success";
        
    }
    
    public function transfer_save(Request $request){
        
        $username = $request->username;
        
        // wms_t_movement_history
        $pallet_from = $request->pallet_from;
        $pallet_to = $request->pallet_to;
        $remarks = $request->remarks;
        $pallet_full = $request->pallet_full;
        
        $i = 0;
        foreach($request->id_pallet_stock as $item_stock){
            
            $item = $request->id_pallet_stock[$i];
            $move_qty = $request->item_qty[$i];
            $item_number = $request->item_number[$i];
            
//             echo "Moving $item from $pallet_from to $pallet_to with qty $move_qty and item_number = $item_number

// ";
            
            if($move_qty > 0){
            
                $pallet_item = PalletItems::where('id_pallet_stock', $item)->first();
                $pallet_target = Pallet::where('pallet_id', $pallet_to)->first();
                
                DB::table("wms_t_movement_history")->insert([
                    
                    "move_date" => date("Y-m-d"),
                    "item_id" => $pallet_item->item_id,
                    "item_number" => $pallet_item->item_number,
                    "location_id" => $pallet_item->pallet->location_id,
                    "location_target" => $pallet_target->location_id,
                    "pallet_id" => $pallet_from,
                    "pallet_target" => $pallet_to,
                    "move_qty" => $move_qty,
                    "doc_type" => "transfer",
                    "remarks" => $remarks,
                    "moved_by" => $username
    
                ]);
                
                if($move_qty == $pallet_item->qty){
                    PalletItems::where('id_pallet_stock', $item)->update(['pallet_id' => $pallet_to]);
                }else{
                    PalletItems::where('id_pallet_stock', $item)->update(['qty' => $pallet_item->qty - $move_qty, 'qty_detail' => $pallet_item->qty_detail/$pallet_item->qty * $move_qty]);
                    
                    PalletItems::create(['pallet_id' => $pallet_to, 'item_id' => $pallet_item->item_id, 'item_number' => $pallet_item->item_number, 'tgl_masuk' => $pallet_item->tgl_masuk, 'qty' => $move_qty, 'qty_detail' => $pallet_item->qty_detail, 'doc_type' => $pallet_item->doc_type, 'doc_number' => $pallet_item->doc_number]);
                }
                
            }
            
            $i++;
        }
        
        $pallet_id_from = Pallet::where('pallet_id', $pallet_from)->first();
        $location = Warehouselocation::where('location_id', $pallet_id_from->location_id)->first();
        
        if(isset($location->location_code)){
        
            if($location->pallets->count() == 1){
                Warehouselocation::where('location_id', $pallet_id_from->location_id)->update(['location_fill' => '0', 'pallet_id' => null]);
            }
        
        }
        
        $pallet_items = PalletItems::where('pallet_id', $pallet_from)->sum('qty');
        
        if($pallet_items > 0){
            Pallet::where('pallet_id', $pallet_from)->update(['pallet_full' => '0']);
        }else{
            Pallet::where('pallet_id', $pallet_from)->update(['pallet_full' => '0', 'location_id' => null, 'pallet_fill' => "0"]);
        }
        
        Pallet::where('pallet_id', $pallet_to)->update(['pallet_full' => $pallet_full, 'pallet_fill' => "1"]);
        
        echo "success";
        
    }
    
    public function picking_data(Request $request){
        
        if(@$request->picking_id != ''){
            $picking_data = Picking::where(['is_delete' => 'N'])->whereIn('picking_status', ['finish_picking', 'loading_process'])->where('picking_no', $request->picking_id)->get();
        }else{
            $picking_data = Picking::where(['is_delete' => 'N'])->whereIn('picking_status', ['finish_picking', 'loading_process'])->get();
        }
        
        $picking = array();
        
        foreach($picking_data as $p){
            
            $picking_id['picking_name'] = $p->picking_no.' ('.$p->customer->cust_name.')';
            $picking_id['picking_no'] = $p->picking_no;
            $picking[] = $picking_id;
            
        }
        
        echo json_encode(array('data' => $picking), JSON_PRETTY_PRINT);
        
    }
    
    public function picking_save(Request $request){
        
        $username = $request->username;
        $remarks =  $request->remarks;

		$loading_no = DB::select("SELECT COUNT(*)+1 AS 'a' FROM wms_t_loading WHERE MONTH(input_date) = MONTH(NOW()) and year(input_date) = year(now()) ");
		$loading_no = sprintf('%04s', $loading_no[0]->a);

        $Loading = new Loading;
        
        $picking = Picking::where('picking_no', $request->picking_no)->first();

        $picking_no = $picking->picking_no;

		$Loading->loading_no   = "LO".date('ymd').$loading_no;
		$Loading->loading_date = date('Y-m-d');
		$Loading->picking_no   = $request->picking_no;
		$Loading->cust_id      = $picking->cust_id;
		$Loading->loading_rmk  = $request->remarks;
		$Loading->id_loading_dock  = $picking->id_loading_dock;
		$Loading->status_date  = date('Y-m-d H:i:s');
		
		$Loading->input_by   = $request->username.' mobile';
		$Loading->input_date = date('Y-m-d H:i:s');
		$Loading->edit_by    = $request->username;
		$Loading->edit_date  = date('Y-m-d H:i:s');

		$Loading->save();

		// update picking status
		DB::table('wms_t_picking')->where('picking_no', $request->picking_no)->update([

				'picking_status'      => 'loading_process',
				'picking_status_date' => date('Y-m-d H:i:s'),
				
				'edit_by'   => $request->username,
				'edit_date' => date('Y-m-d H:i:s')

		]);
		
		$loading_no = "LO".date('ymd').$loading_no;
		
		$i = 0;
		foreach($request->item as $item_detail){
		    
		    $item = $request->item[$i];
		    $qty = $request->item_qty[$i];
		    $pallet = $request->item_pallet[$i];
    		
    		$pallet = Pallet::where('pallet_name', $pallet)->first();
    		
            $pickings = PickingDetail::where('picking_no', $request->picking_no)->where('id_pallet_stock', $item)->where('is_delete', 'N')->get();
            
    		foreach($pickings as $picking){
            
        		$pallet_items = PalletItems::leftJoin("wms_m_item", "wms_m_item.item_id", "wms_m_pallet_stock.item_id")->where('id_pallet_stock', $item)->get();
        		
    		    $sisa_picking = $picking->picking_qty;
    		    
        		foreach($pallet_items as $pallet_item){
        		
            		if($qty <= $pallet_item->qty){
            		    
            		    $picked_qty = $qty > $picking->picking_qty ? $picking->picking_qty : $qty;
            		    
            		    $sisa_picking = $qty - $picked_qty;

                        $spq = isset($pallet_item->spq_item) ? $pallet_item->spq_item : 1;
            		    
                		$LoadingDetail = new LoadingDetail;
                		
                        $LoadingDetail->loading_no                 = $loading_no;
                		$LoadingDetail->picking_no                 = $picking_no;
                		$LoadingDetail->item_id                    = $pallet_item->item_id;
                		$LoadingDetail->item_number                = $pallet_item->item_number;
                		$LoadingDetail->picking_qty                = $picking->picking_qty;
                		$LoadingDetail->id_pallet_stock            = $pallet_item->id_pallet_stock;
                		$LoadingDetail->picking_detail_id          = $picking->picking_detail_id;
                		$LoadingDetail->loading_qty                = $picked_qty;
                		$LoadingDetail->loading_detail_qty         = $picked_qty * $spq;
                		$LoadingDetail->pallet_id                  = $pallet->pallet_id;
                		$LoadingDetail->location_id                = $pallet->location_id;
                		$LoadingDetail->is_valuated                = $picking->is_valueted == 'Y' ? '1' : '0';
                		$LoadingDetail->loading_detail_status      = 'entry_loading';
                		$LoadingDetail->loading_detail_status_date = date('Y-m-d H:i:s');
                
                		$LoadingDetail->input_by                   = $username.' mobile';
                		$LoadingDetail->input_date                 = date('Y-m-d H:i:s');
                		$LoadingDetail->edit_by                    = $username;
                		$LoadingDetail->edit_date                  = date('Y-m-d H:i:s');
                		$LoadingDetail->save();
            		       
            		    $before = PickingDetail::where('picking_detail_id', $picking->picking_detail_id)->first();
            		    
            		    DB::table('wms_t_picking_detail')->where('picking_detail_id', $picking->picking_detail_id)->update([
        
                				'picking_detail_status'      => 'loading',
                				'picking_detail_status_date' => date('Y-m-d H:i:s'),
                				'loading_qty'                => $before->loading_qty + $picked_qty,
                				'picking_open_qty'           => $before->picking_open_qty - $picked_qty,
                				'picking_open_detail_qty'    => ($before->picking_open_qty - $picked_qty) * $spq,
                
                				'edit_by'   => $username,
                				'edit_date' => date('Y-m-d H:i:s')
                
                		]);
            		    
            		}
            		    
        		    if($sisa_picking <= 0)
        		        break;
        		    
        		}
        		
    		}
    
    		DB::table('wms_t_picking')->where('picking_no', $request->picking_no)->update([
    
    			'picking_status'      => 'loading_process',
    			'picking_status_date' => date('Y-m-d H:i:s'),
    
    			'edit_by'   => $username,
    			'edit_date' => date('Y-m-d H:i:s')
    
    		]);
		    
		    $i++;
		}
		
		$open_qty = 0;
		$picking_items = DB::table('wms_t_picking_detail')->where('picking_no', $request->picking_no)->get();
		foreach($picking_items as $picking_item){
		    $open_qty += $picking_item->picking_open_qty;
		}
		
		if($open_qty <= 0){
		    DB::table('wms_t_picking')->where('picking_no', $request->picking_no)->update(['picking_status' => 'picking_close']);
		}
        
        echo "success"; 
		
    }
    
    public function picking_history(){
        
        $picking_data = Loading::where(['is_delete' => 'N'])->take(10)->skip(0)->orderBy('input_date', 'desc')->get();
        
        $picking = array();
        
        foreach($picking_data as $p){
            
            $picking_id['loading_no'] = $p->loading_no;
            $picking_id['picking_no'] = $p->picking_no;
            $picking_id['input_date'] = date("d/m/Y H:i", strtotime($p->input_date));
            
            $picking[] = $picking_id;
            
        }
        
        echo json_encode(array('data' => $picking), JSON_PRETTY_PRINT);
        
    }
    
    public function picking_detail($loading_no){
        
        $picking_data = LoadingDetail::where(['loading_no' => $loading_no])->get();
        
        $picking = array();
        
        foreach($picking_data as $p){
            
            $picking_id['pallet_id'] = $p->pallet_id;
            $picking_id['item_number'] = $p->item_number;
            $picking_id['loading_qty'] = $p->loading_qty;
            
            $picking[] = $picking_id;
            
        }
        
        echo json_encode(array('data' => $picking), JSON_PRETTY_PRINT);
        
    }
    
    public function loading_save(Request $request){
        
        // $key = session('request_key', 'default');
        
        // if($key == 'default'){
        //     echo "'Request Key' unknown, please update your app.";
        // }
        
        // if($request_key != $request->request_key && $key != 'default'){
            
            session(['request_key' => $request->request_key]);
            
            $username = $request->username;
            $vehicle_id = $request->vehicle_id;
            $remarks = $request->remarks;
            
            $vehicle = Vehicle::where('plat_no', $vehicle_id)->first();
            $vehicle_id = $vehicle->vehicle_id;
            
            // $loading_no = strlen($request->loading_dock_id) == 1 ? '0'.$request->loading_dock_id : $request->loading_dock_id;
            
            $picking_no = "";
            
            $loading_dock = LoadingDock::where("id_loading_dock", $request->loading_dock_id)->first();
            
            $loading = Loading::where('id_loading_dock', $loading_dock->id_loading_dock)->where('loading_status', '!=', 'deliver')->get();
            
            $lls = array();
            foreach($loading as $ll){
                $lls[] = $ll->loading_no;
                
                $picking_no = $ll->picking_no;
                
                $loaded_qty = LoadingDetail::where('picking_no', $picking_no)->sum('loading_qty');
                    
        		// Update
        		Picking::where('picking_no', $picking_no)->update([
        			'loaded_qty' => $loaded_qty
        		]);
            }
            
            $items = LoadingDetail::whereIn('loading_no', $lls)->get();
            
            if(count($items) == 0){
                echo "Loading empty at Loading Dock ".$loading_dock->no_loading_dock;
            }else{
                
                foreach($items as $item){
                    
                    DB::table("wms_t_movement_history")->insert([
                        "move_date" => date("Y-m-d"),
                        "item_number" => $item->item_number,
                        "location_id" => $item->location_id,
                        "location_target" => null,
                        "doc_type" => "loading",
                        "pallet_id" => $item->pallet_id,
                        "pallet_target" => null,
                        "move_qty" => $item->loading_qty,
                        "remarks" => "Items is proceed to Loading",
                        "moved_by" => $username
            
                    ]);
                    
                }
                
                Loading::where('id_loading_dock', $loading_dock->id_loading_dock)->where('loading_status', '!=', 'deliver')->update(['loading_status' => 'finish_loading', 'vehicle_id' => $vehicle_id, 'finish_remark' => $remarks, 'edit_by' => $username, 'edit_date' => date("Y-m-d H:i:s")]);
                LoadingDetail::whereIn('loading_no', $lls)->update(['loading_detail_status' => 'finish_loading']);
                
                echo "success"; 
                
            }
        
        // }
        
    }
    
    public function delivery_data(){
        
        $delivery_note_data = Deliverynote::where(['is_delete' => 'N', 'dn_status' => 'Deliver'])->get();
        
        $delivery_note = array();
        
        foreach($delivery_note_data as $p){
            
            $delivery_note_item2 = "";
            foreach($p->items as $item){
                $delivery_note_item2 .= $item->pallet_id.' - '.$item->item_number." ( " . $item->loading_qty . " )\n";
            }
            
            $delivery_note_id['dn_number'] = $p->dn_number;
            $delivery_note_id['dn_id'] = $p->dn_id;
            $delivery_note_id['items'] = $delivery_note_item2;
            $delivery_note[] = $delivery_note_id;
            
        }
        
        echo json_encode(array('data' => $delivery_note), JSON_PRETTY_PRINT);
        
    }
    
    public function delivery_save($id, $status, Request $request){
        
        $username = $request->username;
        $remarks = $request->remarks;
        
        Deliverynote::where('dn_id', $id)->update(["dn_status" => $status, "dn_status_rmk" => $remarks, "edit_date" => date("Y-m-d H:i:s"), "edit_by" => $username]);
        
        echo "success"; 
        
    }
    
    public function vehicle_data(){
        
        $vehicles = Vehicle::all();
        
        $vehicle = array();
        
        foreach($vehicles as $p){
            $v = array();
            $v['vehicle_id'] = $p->plat_no;
            $v['plat_no'] = $p->plat_no;
            $vehicle[] = $v;
            
        }
        
        echo json_encode(array('data' => $vehicle), JSON_PRETTY_PRINT);
        
    }
    
    public function loading_dock_data(){
        
        $vehicles = LoadingDock::all();
        
        $vehicle = array();
        
        foreach($vehicles as $p){
            $v = array();
            $v['id_loading_dock'] = $p->id_loading_dock;
            $v['no_loading_dock'] = $p->no_loading_dock;
            $v['remarks'] = $p->remarks;
            $vehicle[] = $v;
            
        }
        
        echo json_encode(array('data' => $vehicle), JSON_PRETTY_PRINT);
        
    }
    
    public function location_data(Request $request){
        
        $location_data = Warehouselocation::where(['is_delete' => 'N']);
        
        if(@$request->last_id != ""){
            $location_data = $location_data->where('location_id', '>', $request->last_id);
        }
        
        $location_data = $location_data->get();
        
        $location = array();
        
        foreach($location_data as $p){
            $loc = array();
            $loc['location_id'] = $p->location_id;
            $loc['location_code'] = $p->location_code;
            $location[] = $loc;
        }
        
        echo json_encode(array("location" => $location), JSON_PRETTY_PRINT);
        
    }
    
    public function item_data($source, $id, Request $request){
        
        if($source == 'location'){
            
            $loc_detail = Warehouselocation::where('location_code', $id)->first();
            $location_data = Pallet::where(['location_id' =>  $loc_detail->location_id])->get();
        
            $item = array();
            $items_count = 0;
        
            foreach($location_data as $p){
                $loc = array();
                $loc['pallet_name'] = $p->pallet_name;
                $loc['items'] = array();
                
                $no = 0;
                
                foreach($p->items->where('qty', '>', 0) as $items){
                    
                    $i = array();
                    $i['pallet_name'] = $p->pallet_name;
                    $i['item_id'] = $items->item_id;
                    $i['item_number'] = $items->item_number;
                    $i['id_pallet_stock'] = $items->id_pallet_stock;
                    $i['lot'] = $items->batch == null ? 'Lot : -' : 'Lot : '.$items->batch;
                    $i['item_name'] = $items->item_name;
                    $i['qty'] = $items->qty;
                    $i['company'] = $items->item->customer->cust_name;
                    $loc['items'][$no] = $i;
                    $items_count++;
                    $no++;
                    
                }
                
                $item[] = $loc;
            }
            
            $title = "Items from location ".$loc_detail->location_code." (".$items_count." items)";
            
        }
        
        if($source == 'pallet'){
            
            $location_data = Pallet::where(['pallet_id' =>  $id])->first();
        
            $item = array();
            $items_count = 0;
        
            $loc = array();
            $loc['pallet_name'] = $location_data->pallet_name;
            
            $loc["items"] = array();
            
            $no = 0;
            foreach($location_data->items->where('qty', '>', 0) as $items){
                $i = array();
                $i['pallet_name'] = $location_data->pallet_name;
                $i['item_number'] = $items->item_number;
                $i['item_name'] = $items->item->item_name;
                $i['id_pallet_stock'] = $items->id_pallet_stock;
                $i['lot'] = $items->batch == null ? 'Lot : -' : 'Lot : '.$items->batch;
                $i['item_id'] = $items->item_id;
                $i['qty'] = $items->qty;
                $i['company'] = $items->item->customer->cust_name;
                $loc['items'][$no] = $i;
                $items_count++;
                $no++;
            }
            
            $item[] = $loc;
            
            $title = "Items from pallet ".$location_data->pallet_name." (".$items_count." items)";
            
        }
        
        $item_other = array();
        
        $others = DB::select(DB::raw("SELECT item_id, item_number FROM `wms_m_item` where is_delete = 'N' and item_status = 'active'"));
        foreach($others as $o){
            
            $item_other[] = [
                    "item_id" => $o->item_id,
                    "item_number" => $o->item_number
                ];
            
        }
        
        echo json_encode(array("item" => $item, "title" => $title, "item_others" => $item_other), JSON_PRETTY_PRINT);
        
    }
    
    public function opname_save(Request $request){
        
        $pallet = Pallet::where('pallet_id', $request->pallet_id)->first();
        
        $i = 0;
        
        if(!empty($request->item_id)){
            foreach($request->item_id as $item){
                StockOpnameDetail::where('id_stock_opname', null)->where('id_pallet_stock', $request->id_pallet_stock[$i])->delete();
                StockOpnameDetail::create([
                        "item_id" => $request->item_id[$i],
                        "item_number" => $request->item_number[$i],
                        "ending_stock" => $request->item_qty[$i],
                        "real_qty" => $request->item_new_qty[$i],
                        "pallet_id" => $request->pallet_id,
                        "id_pallet_stock" => $request->id_pallet_stock[$i],
                        "location_id" => $pallet->location_id,
                        "input_by" => $request->username,
                        "item_type" => $request->item_type[$i],
                    ]);
                $i++;
            }
        }
        
        echo "success";
        
    }
    
}













<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\LocationTransfer;
use App\Model\LocationTransferDetail;
use App\Model\Customer\Customermaster;
use App\Model\Warehouse\Pallet;
use App\Model\Warehouse\PalletItems;
use App\Model\Warehouse\Warehouselocation;

use Auth;
use DB;
use DataTables;

class LocationTransferController extends Controller
{

	public function index(){

		$location_transfer = LocationTransfer::all();

		return view('location_transfer.all', compact('location_transfer'));

	}

	public function preview($location_id, $location_to){

		$list_pallet = Pallet::where("location_id", $location_id)->get();
		
		$location_to = Warehouselocation::where('location_id', $location_to)->where('is_delete', 'N')->first();
		
		// ini ULTIMATE WHY
// 		foreach($list_pallet as $pallet){
// 		    if($pallet->qty <= 0){
// 		        Pallet::where('pallet_id', $pallet->pallet_id)->update(['location_id' => '0']);
// 		    }
// 		}
		
		return view('location_transfer.preview', compact('list_pallet', 'location_to'));

	}

	public function detail($id){

		$location_transfer = LocationTransfer::where('id_location_transfer', $id)->first();
		
		return view('location_transfer.detail', compact('location_transfer'));

	}

	public function add(Request $request){
        
		$dn_id = DB::select("SELECT COUNT(*)+1 AS 'a' FROM wms_t_location_transfer");
		$dn_id = $dn_id[0]->a;
		$dn_id = sprintf('%02s', $dn_id);
		
        $location_from = Warehouselocation::where('is_delete', 'N')
            ->where('location_full', '0')
            ->where('plant_id', Auth::user()->plant_id)
            ->pluck('location_code', 'location_id');

        $location_to = Warehouselocation::where('is_delete', 'N')
            ->where('location_full', '0')
            ->where('plant_id', Auth::user()->plant_id)
            ->pluck('location_code', 'location_id');
        
		return view('location_transfer.add', compact('location_from', 'location_to', 'dn_id'));

	}

	public function save(Request $request){
        
		$dn_id = DB::select("SELECT COUNT(*)+1 AS 'a' FROM wms_t_location_transfer");
		$dn_id = $dn_id[0]->a;
		$dn_id = sprintf('%02s', $dn_id);
	    
	    $username = Auth::user()->username;
	    
	    $input = $request->all();
	    $input['input_by'] = $username;
	    $input['kode_transfer'] = "LT".date("Ymd").$dn_id;
	    
	    LocationTransfer::create($input);
	    
	    Warehouselocation::where('location_id', $request->location_from)->update([
	        "location_fill" => 0]);
	    Warehouselocation::where('location_id', $request->location_to)->update([
	        "location_fill" => 1]);
	    
	    $last = LocationTransfer::select('id_location_transfer')->orderBy('id_location_transfer', 'desc')->first();
	    
		$list_pallet = PalletItems::whereIn("pallet_id", Pallet::where("location_id", $request->location_from)->pluck("pallet_id"))->get();
		
		foreach($list_pallet as $pallet){
		    
		    LocationTransferDetail::create([
		            "id_location_transfer" => $last->id_location_transfer,
		            "pallet_id" => $pallet->pallet_id,
		            "input_by" => $username,
		            "location_from" => $request->location_from,
		            "location_to" => $request->location_to
		        ]);
		    
		    DB::table('wms_t_movement_history')->insert([
		            'move_date' => date("Y-m-d"),
		            'location_id' => $request->location_from,
		            'location_target' => $request->location_to,
		            'pallet_id' => $pallet->pallet_id,
		            'remarks' => 'Transfer location',
		            'doc_number' => $last->id_location_transfer,
		            'doc_type' => 'location_transfer',
		            'moved_time' => date("Y-m-d H:i:s"),
		            'moved_by' => $username,
		        ]);
		    
		}
	    
	    Pallet::where('location_id', $request->location_from)->update([
	            "location_id" => $request->location_to
	        ]);

		toastr()->success('Location items moved successfully.');

		return redirect(route('location_transfer.detail', $last->id_location_transfer));

	}

}
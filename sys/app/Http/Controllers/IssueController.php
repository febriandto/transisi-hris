<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Item\ItemMaster;
use App\Model\Warehouse\PalletItems;
use App\Model\Warehouse\Pallet;
use App\Model\Customer\Customermaster;
use App\Model\StockHistoryDetail;
use App\Model\StockHistory;
use App\Model\Picking\Picking;
use App\Model\Picking\PickingDetail;
use App\Model\Loading\Loading;
use App\Model\Loading\LoadingDetail;
use App\Model\Issue;
use App\Model\IssueDetail;

use DB;
use Auth;
use DataTables;

class IssueController extends Controller
{

	function datatables(Request $request){

		$data = [];
		$i = 1;

		$customers = Issue::where(['is_delete' => 'N', 'picking_no' => $request->picking_no])->get();

		foreach( $customers as $customer ){

			$customer['no'] = $i;
			$customer['issue_no'] = $customer->issue_no;
			$customer['issue_type'] = $customer->issue_type;
			$customer['input_by'] = $customer->inputor->name;
			$customer['tanggal'] = date("d/m/Y", strtotime($customer->issue_date));
			$customer['cust_ref'] = $customer->cust_ref;
			$customer['qty'] = $customer->total_qty;
			$customer['qty_detail'] = $customer->total_qty_detail;
			
			$customer['aksi'] = '<a href="'.route('issue.detail', $customer->picking_no).'?issue_no='.$customer->issue_no.'">
									<i class="fa fa-search"></i> &nbsp; Detail
								</a>';

			$data[] = $customer;
			$i++;

		}

		return datatables::of($data)->escapecolumns([])->make(true);

	}

	public function index(Picking $picking)
	{

		$items = LoadingDetail::where('picking_no', $picking->picking_no)->where('is_issue', 'N')->where('is_delete', 'N')->count();
		
		return view('issue.index', compact('picking', 'items'));
	}

	public function add(Picking $picking, Request $request)
	{
	    $loading = Loading::where('picking_no', $picking->picking_no)->first();
	    $total_picking = PickingDetail::where('picking_no', $picking->picking_no)->where('is_delete', 'N')->sum('picking_qty');
	    $total_loading = LoadingDetail::where('picking_no', $picking->picking_no)->where('is_delete', 'N')->sum('loading_qty');

	    // return $total_loading;
	    
		$items = LoadingDetail::where('picking_no', $picking->picking_no)->where('is_issue', 'N')->where('wms_t_loading_detail.is_delete', 'N')
		    ->leftJoin('wms_m_pallet_stock', 'wms_m_pallet_stock.id_pallet_stock', 'wms_t_loading_detail.id_pallet_stock')
		    ->leftJoin('wms_m_item', 'wms_m_item.item_id', 'wms_t_loading_detail.item_id')
		    ->leftJoin('wms_m_uom', 'wms_m_uom.uom_id', 'wms_m_item.uom_id')->get();

		return view('issue.add', compact('items', 'picking', 'total_loading', 'total_picking'));
	}
    
    // not used
	public function add2(Picking $picking, Request $request)
	{
	    $loading = Loading::where('picking_no', $picking->picking_no)->first();
	    $total_picking = PickingDetail::where('picking_no', $picking->picking_no)->where('is_delete', 'N')->sum('picking_qty');
	    $total_loading = LoadingDetail::where('loading_no', $picking->loading_no)->where('is_delete', 'N')->sum('loading_qty');
	    
		$items = PickingDetail::where('picking_no', $picking->picking_no)->where('is_processed', 'N')->where('wms_t_picking_detail.is_delete', 'N')
		    ->leftJoin('wms_m_pallet_stock', 'wms_m_pallet_stock.id_pallet_stock', 'wms_t_picking_detail.id_pallet_stock')
		    ->leftJoin('wms_m_item', 'wms_m_item.item_id', 'wms_t_picking_detail.item_id')
		    ->leftJoin('wms_m_uom', 'wms_m_uom.uom_id', 'wms_m_item.uom_id')->get();

		return view('issue.add', compact('items', 'picking', 'total_loading', 'total_picking'));
	}

	public function save(Picking $picking, Request $request)
	{
	    
		$issue_no = DB::select("SELECT COUNT(*)+1 AS 'a' FROM wms_t_issue  WHERE MONTH(input_date) = MONTH(NOW()) and year(input_date) = year(now()) ");
		$issue_no = sprintf('%04s', $issue_no[0]->a);
		
		$new_id = "GI".date('ymd').$issue_no;
	    
	    $buffers = array();
	    $items = LoadingDetail::whereIn('loading_detail_id', $request->stock_id)->where('is_delete', 'N')->get();

	    $qty_total = 0;
	    $qty_detail_total = 0;
	    $i = 0;
	    $picking_detail_id = array();
	    
	    foreach($items as $item){
	        
	        if($item->loading_qty > 0){
    	        $item_number = ItemMaster::select('cust_id')->where('item_id', $item->item_id)->first();
    	        
    	        $buffers[$i]["item_id"] = $item->item_id;
    	        $buffers[$i]["item_number"] = $item->item_number;
    	        $buffers[$i]["issue_no"] = $new_id;
    	        $buffers[$i]["picking_no"] = $item->picking_no;
    	        $buffers[$i]["qty"] = $item->loading_qty;
    	        $buffers[$i]["loading_detail_id"] = $item->loading_detail_id;
    	        $buffers[$i]["detail_qty"] = $item->loading_detail_qty;
    	        $buffers[$i]["pallet_id"] = $item->pallet_id;
    	        $buffers[$i]["picking_detail_id"] = $item->picking_detail_id;
    	        $buffers[$i]["cust_id"] = $item_number->cust_id;
    	        
    	        $qty_total += $item->loading_qty;
    	        $qty_detail_total += $item->loading_detail_qty;
    
    	        $picking_detail_id[] = $item->picking_detail_id;
	        
	            $i++;
	        }
	    }
		
		Issue::create([
		        "issue_no" => $new_id,
		        "picking_no" => $picking->picking_no,
		        "issue_type" => $request->issue_type,
		        "cust_ref" => $request->cust_ref,
		        "issue_date" => date("Y-m-d"),
		        "total_qty" => $qty_total,
		        "total_qty_detail" => $qty_detail_total,
		        "input_by" => Auth::user()->username
		    ]);
		    
	    foreach($buffers as $buffer){
	       IssueDetail::create($buffer);
	    }
	    
	    if($picking->issue_type == 'CR'){
	        
	        PickingDetail::whereIn('picking_detail_id', $picking_detail_id)->update(['is_processed' => 'C']);
	        LoadingDetail::whereIn('loading_detail_id', $request->stock_id)->update(['is_issue' => 'C', 'issue_no' => $new_id]);
	        
	    }else{

	        PickingDetail::whereIn('picking_detail_id', $picking_detail_id)->update(['is_processed' => 'Y']);
	        LoadingDetail::whereIn('loading_detail_id', $request->stock_id)->update(['is_issue' => 'Y', 'issue_no' => $new_id]);
	        
	    }
	    //Update issued_qty on wms_m_picking
	    $issued_qty = IssueDetail::where('picking_no', $picking->picking_no)->sum('qty');
	    // Update
	    Picking::where('picking_no', $picking->picking_no)->update([
	    	'issued_qty' => $issued_qty
	    ]);

	    return redirect()->route('issue.index', $picking->picking_no);
		
	}
	public function delete($issue_no)
	{
        
        $issue = Issue::where('issue_no', $issue_no)->first();
		    
		Issue::where('issue_no', $issue_no)->update([
		        'is_delete' => 'Y',
		        'delete_by' => Auth::user()->username,
		        'delete_date' => date('Y-m-d H:i:s')
		    ]);
        
	    toastr()->success("Issue deleted");
	    
	    return redirect()->route('issue.index', $issue->picking_no);
	    
	}
	
	public function detail(Picking $picking, Request $request)
	{
        
		$items = LoadingDetail::whereIn('picking_no', IssueDetail::where('issue_no', $request->issue_no)->pluck('picking_no') )
		    ->where('issue_no', $request->issue_no)
		    ->leftJoin('wms_m_pallet_stock', 'wms_m_pallet_stock.id_pallet_stock', 'wms_t_loading_detail.id_pallet_stock')
		    ->leftJoin('wms_m_item', 'wms_m_item.item_id', 'wms_t_loading_detail.item_id')
		    ->leftJoin('wms_m_uom', 'wms_m_uom.uom_id', 'wms_m_item.uom_id')->get();
		    
		$issue = Issue::where('issue_no', $request->issue_no)->first();

		return view('issue.detail', compact('picking', 'items', 'issue'));
	}

	public function print(Picking $picking, Request $request)
	{
	    
	    $issue = Issue::where('issue_no', $request->issue_no)->first();
	    
		$picking = Picking::where('picking_no', $picking->picking_no)->first();

		$items = LoadingDetail::whereIn('picking_no', IssueDetail::where('issue_no', $request->issue_no)->pluck('picking_no'))
		    ->where('issue_no', $request->issue_no)
    		->leftJoin('wms_m_item', 'wms_m_item.item_id', 'wms_t_loading_detail.item_id')
		    ->leftJoin('wms_m_pallet_stock', 'wms_m_pallet_stock.id_pallet_stock', 'wms_t_loading_detail.id_pallet_stock')
    		->leftJoin('wms_m_uom', 'wms_m_uom.uom_id', 'wms_m_item.uom_id')->get();
		
		return view('issue.print', compact('picking', 'items', 'issue'));

	}

	public function print_available(Picking $picking, Request $request)
	{
	    
		$picking = Picking::where('picking_no', $picking->picking_no)->first();

		$items = PickingDetail::where('picking_no', $picking->picking_no)->where('is_processed', 'N')->leftJoin('wms_m_item', 'wms_m_item.item_id', 'wms_t_picking_detail.item_id')->leftJoin('wms_m_uom', 'wms_m_uom.uom_id', 'wms_m_item.uom_id')->get();

		return view('issue.print_available', compact('picking', 'items'));

	}

}

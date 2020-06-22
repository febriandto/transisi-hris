<?php

namespace App\Http\Controllers\Item;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Item\ItemCategory;

use Auth;
use DB;

class ItemCategoryController extends Controller
{
	
	public function index(){

		$item_category = DB::select("
			SELECT * FROM wms_m_item_cat where is_delete = 'N'
		");

		return view('item_category.all', compact('item_category'));

	}

	public function add(){

		return view('item_category.add' );

	}

	public function save(Request $request){

		$ItemCategory = new ItemCategory;

		$ItemCategory->item_cat_name  = $request->item_cat_name;
		$ItemCategory->item_cat_desc  = $request->item_cat_desc;
		
		$ItemCategory->input_by   = Auth::user()->username;
		$ItemCategory->input_date = date('Y-m-d H:i:s');
		$ItemCategory->save();

		toastr()->success('Category created successfully');

		return redirect( route('itemcategory.index') );

  }

  public function edit(ItemCategory $ItemCategory){

  	return view('item_category.edit', compact('ItemCategory'));

  }

  public function update(Request $request){

  	$insert = DB::table('wms_m_item_cat')->where('item_cat_id', $request->item_cat_id)->update([

		'item_cat_name' => $request->item_cat_name,
		'item_cat_desc' => $request->item_cat_desc,
		
		'edit_by'   => Auth::user()->username,
		'edit_date' => date('Y-m-d H:i:s')

  	]);

		toastr()->success('Edit successfully');

		return redirect( route('itemcategory.index') );

  }

  public function delete(Request $request){

  	DB::table('wms_m_item_cat')->where('item_cat_id', $request->item_cat_id)->update([

		'is_delete' => 'Y',
		
		'del_by'   => Auth::user()->username,
		'del_date' => date('Y-m-d H:i:s')

  	]);

		toastr()->success('Delete successfully');

		return redirect( route('itemcategory.index') );

  }

}

?>
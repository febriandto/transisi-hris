<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use Auth;
use DB;

use App\Model\Customer\Customeraddress;

class CustomerAddressController extends Controller
{


  function index()
  {
    $customer_address = DB::select(" 
      SELECT * FROM
      `wms_m_customer_add`
      INNER JOIN `wms_m_customer` 
      ON (`wms_m_customer_add`.`cust_id` = `wms_m_customer`.`cust_id`)
      where wms_m_customer_add.is_delete = 'N'
    ");

    return view('customer_address.all', compact('customer_address'));
  }

  public function add(){

    $customer = DB::select(" SELECT * FROM wms_m_customer WHERE is_delete = 'N' ");

    return view('customer_address.add', compact('customer'));

  }

  public function save(Request $request){

    $Customeraddress = new Customeraddress;

    $Customeraddress->cust_id  = $request->cust_id;
    $Customeraddress->add_name = $request->add_name;
    $Customeraddress->add_desc = $request->add_desc;

    $Customeraddress->input_by   = Auth::user()->username;
    $Customeraddress->input_date = date('Y-m-d H:i:s');
    $Customeraddress->save();

    toastr()->success('Address Added Successfully');

    return redirect( route('customeraddress.index') );

  }

  public function edit(Customeraddress $customeraddress){

    $customer = DB::select(" SELECT * FROM wms_m_customer WHERE is_delete = 'N' ");

    return view('customer_address.edit', compact('customeraddress', 'customer'));

  }

  public function update(Request $request){

    $insert = DB::table('wms_m_customer_add')->where('cust_add_id', $request->cust_add_id)->update([

    'cust_id'   => $request->cust_id,
    'add_name'  => $request->add_name,
    'add_desc'  => $request->add_desc,
    
    'edit_by'   => Auth::user()->username,
    'edit_date' => date('Y-m-d H:i:s')

    ]);

    toastr()->success('Edit successfully');

    return redirect( route('customeraddress.index') );

  }

  public function delete(Request $request){

    DB::table('wms_m_customer_add')->where('cust_add_id', $request->cust_add_id)->update([
      
      'is_delete'   => 'Y',
      'delete_by'   => Auth::user()->username,
      'delete_date' => date('Y-m-d H:i:s')

    ]);

    toastr()->success('Delete successfully');

    return redirect( route('customeraddress.index') );

  }

}

<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use Auth;

use App\Model\Customer\Customermaster;

class CustomerMasterController extends Controller
{
    
    //
	
	function datatables(Request $request)
    {   
        $data = array();

        $is_delete = $request->is_delete;

        $customers = Customermaster::where(['is_delete'=> $is_delete])->get();

        $no = 1;
        foreach($customers as $customer)
        {
            $customer->no = $no++;

            if($is_delete == 'N')
            {
                $customer->aksi = '
                    <a href="#" class="btn-edit" data-id ="'.$customer->cust_id.'"><i class="fa fa-edit"></i></a>&nbsp;
                    <a href="#" class="btn-hapus" data-id = "'.$customer->cust_id.'"><i class="fa fa-trash"></i></a>
                ';
            }
            else
            {
                $customer->aksi = '<a href="#" class="btn-restore" data-id = "' .$customer->cust_id. '"> <i class="fa fa-undo"></i> </a>';
            }

            $data[] = $customer;
        }

        return datatables::of($data)->escapecolumns([])->make(true);
    
    }


    function index()
    {
        return view('customer.customermaster');
    }


    function simpan(Request $request)
    {
        $customer = new Customermaster;

        $customer->cust_id             = $request->cust_id;
        $customer->cust_name           = $request->cust_name;
        $customer->cust_address        = $request->cust_address;
        $customer->cust_phone          = $request->cust_phone;
        $customer->cust_email          = $request->cust_email;
        $customer->cust_fax            = $request->cust_fax;
        $customer->cust_person         = $request->cust_person;
        $customer->cust_contact_person = $request->cust_contact_person;
        $customer->cust_remarks        = $request->cust_remarks;

        
        $customer->input_by    = Auth::user()->username;
        $customer->input_date  = date('Y-m-d H:i:s');
        $customer->save();

        toastr()->success('Customer saved successfully');

        return response()->json(['status' => 'success', 'customer' => $customer], 200);
    }

    protected function edit($id)
    {
        $customer = Customermaster::findOrFail($id);

        return response()->json(['status' => 'success', 'customer' => $customer], 200);
    }

    protected function perbarui($id, Request $request)
    {
        
        $customer = Customermaster::findOrFail($id);
        
        $customer->cust_id             = $request->cust_id;
        $customer->cust_name           = $request->cust_name;
        $customer->cust_address        = $request->cust_address;
        $customer->cust_phone          = $request->cust_phone;
        $customer->cust_email          = $request->cust_email;
        $customer->cust_fax            = $request->cust_fax;
        $customer->cust_person         = $request->cust_person;
        $customer->cust_contact_person = $request->cust_contact_person;
        $customer->cust_remarks        = $request->cust_remarks;

        $customer->edit_by   = Auth::user()->username;
        $customer->edit_date = date('Y-m-d H:i:s');
        $customer->update();

        toastr()->success('Customer edit successfully');

        return response()->json(['status' => 'success'], 200);
    }

    protected function hapus($id)
    {
        $customer = Customermaster::findOrFail($id);

        $customer->del_by    = Auth::user()->username;
        $customer->del_date  = date('Y-m-d H:i:s');
        $customer->is_delete = "Y";
        $customer->update();

        toastr()->success('Deleted success');
        return response()->json(['status' => 'success'], 200);
    }

    protected function restore($id)
    {
        $customer = Customermaster::findOrFail($id);

        $customer->update(['is_delete' => 'N']);

        toastr()->success('Resored success');
        return response()->json(['status' => 'success', 200]);
    }

}

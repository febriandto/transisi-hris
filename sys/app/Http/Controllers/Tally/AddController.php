<?php

namespace App\Http\Controllers\Tally;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Tally\Tally;
use Auth;
use DB;

class AddController extends Controller
{
	function index()
	{
		$tally_no = DB::select(" SELECT count(*)+1 as 'a' FROM wms_t_tally WHERE MONTH(tally_date) = MONTH(NOW()) ");
		$tally_no = sprintf('%04s', $tally_no[0]->a);

		$customers = DB::select(" SELECT * FROM wms_m_customer WHERE is_delete = 'N' ");

		return view('tally.add', compact('customers', 'tally_no'));
  }

}



?>
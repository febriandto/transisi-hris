<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;



class BerandaController extends Controller
{

    public function dashboard(){

        $all_tally_sheet      = DB::select(" SELECT COUNT(*) AS 'a' FROM wms_t_tally WHERE is_delete = 'N' ");
        $entry_tally_sheet    = DB::select(" SELECT COUNT(*) AS 'a' FROM wms_t_tally WHERE is_delete = 'N' and tally_status = 'entry' ");
        $finished_tally_sheet = DB::select(" SELECT COUNT(*) AS 'a' FROM wms_t_tally WHERE is_delete = 'N' and tally_status = 'finish_tally' ");
        $tally_sheet_closed   = DB::select(" SELECT COUNT(*) AS 'a' FROM wms_t_tally where is_delete = 'N' and tally_status = 'tally_close' ");

        $all_putaway          = DB::select(" SELECT COUNT(*) AS 'a' FROM wms_t_putaway where is_delete = 'N' ");
        $entry_putaway_sheet  = DB::select(" SELECT COUNT(*) AS 'a' FROM wms_t_putaway where is_delete = 'N' and putaway_status = 'entry_putaway' ");
        $finish_putaway_sheet = DB::select(" SELECT COUNT(*) AS 'a' FROM wms_t_putaway where is_delete = 'N' and putaway_status = 'putaway' ");
        $putaway_finish       = DB::select(" SELECT COUNT(*) AS 'a' FROM wms_t_putaway where is_delete = 'N' and putaway_status = 'putaway_finish' ");

    	return view('dashboard.home', compact(
            'all_tally_sheet',
            'entry_tally_sheet',
            'finished_tally_sheet',
            'tally_sheet_closed',
            'all_putaway',
            'entry_putaway_sheet',
            'finish_putaway_sheet',
            'putaway_finish'
        ));

    }

    public function logout () {
		  //logout user
		  auth()->logout();
		  
		  // redirect to homepage
		  return redirect('/');
	}

}

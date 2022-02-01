<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Sp;
use DB;
use Auth;

class SpController extends Controller
{
    public function index()
    {
        $sp = DB::select("
            SELECT
                `hris_sp`.`no_sp`
                , `hris_sp`.`sp_date`
                , `hris_sp`.`id_spcat`
                , `hris_sp`.`sp_title`
                , `hris_sp`.`sp_status`
                , `hris_sp`.`sp_valid_date`
                , `hris_sp`.`is_delete`
                , `hris_m_emp`.`emp_name`
                , `hris_m_emp`.`emp_status`
            FROM
                `hris_sp`
                INNER JOIN `hris_m_emp` 
                    ON (`hris_sp`.`id_emp` = `hris_m_emp`.`id_emp`)
                WHERE `hris_sp`.`is_delete` = 'N' ;
        ");

        return view('sp.index', compact('sp'));
    }

    public function add()
    {
        $emp = DB::select("SELECT * from hris_m_emp WHERE is_delete='N'");

        $no = DB::select("select count(*)+1 as 'a' from hris_sp ");
        $no = $no[0]->a;

        $sp_cat = DB::select("select * from hris_spcat where is_delete = 'N' ");

        return view('sp.add', compact('emp', 'no', 'sp_cat'));
    }

    protected function save(Request $request)
    {

        $sp = new Sp;

        $sp->no_sp = $request->no_sp; 
        $sp->sp_date = $request->sp_date; 
        $sp->id_spcat = $request->id_spcat;
        $sp->sp_title = $request->sp_title;
        $sp->sp_description = $request->sp_description;
        $sp->sp_punishment = $request->sp_punishment;
        $sp->sp_valid_date = $request->sp_valid_date;
        $sp->id_emp = $request->id_emp;
        $sp->input_date = Auth::user()->name;
        $sp->input_by = date('Y-m-d');
        $sp->save();

        return redirect(route('sp.index'));

    }
}

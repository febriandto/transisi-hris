<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Model\MasterMutasi;
use App\Model\MasterEmploye;

class MutasiController extends Controller
{
    public function index()
    {
        $mutasi = DB::select("SELECT * FROM hris_m_mutasi
                    INNER JOIN hris_m_emp ON hris_m_mutasi.id_emp = hris_m_emp.id_emp
                    INNER JOIN hris_m_dept ON hris_m_mutasi.id_dept = hris_m_dept.id_dept
                    WHERE hris_m_mutasi.is_delete='N' 
                    and hris_m_mutasi.mutasi_category != 'first_dept'
                ");

        return view('mutasi.index', compact('mutasi'));
    }

    public function add()
    {
        $employee = DB::select("SELECT * from hris_m_emp WHERE is_delete='N'");
        $dept = DB::select("SELECT * from hris_m_dept WHERE is_delete='N'");

        return view('mutasi.add', compact('employee', 'dept'));
    }

    protected function save(Request $request)
    {

        $mutasi = new MasterMutasi;

        $mutasi->id_emp            = $request->id_emp;
        $mutasi->id_dept           = $request->id_dept;
        $mutasi->mutasi_activedate = $request->mutasi_activedate;
        $mutasi->input_by          = Auth::user()->name;
        $mutasi->input_date        = date('Y-m-d');
        $mutasi->is_delete         = 'N';
        $mutasi->save();

        MasterEmploye::where('id_emp', $request->id_emp)->update([

            'id_dept' => $request->id_dept

        ]);

        return redirect(route('mutasi.index'))->with('success','success');

    }
}

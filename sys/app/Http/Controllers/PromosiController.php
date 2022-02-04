<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Promosi;
use App\Model\MasterEmploye;
use DB;
use Auth;

class PromosiController extends Controller
{

    public function index()
    {
        $promosi = DB::select("
                        SELECT
                            hris_promosi.id_emp
                            , hris_promosi.id_grade
                            , hris_promosi.promosi_activedate
                            , hris_promosi.promosi_category
                            , hris_promosi.input_date
                            , hris_promosi.input_by
                            , hris_promosi.is_delete
                            , hris_m_grade.grade_name
                            , hris_m_grade.grade_level
                            , hris_promosi.id_promosi
                            , hris_m_emp.emp_name
                        FROM
                            hris_promosi
                            INNER JOIN hris_m_emp 
                                ON (hris_promosi.id_emp = hris_m_emp.id_emp)
                            INNER JOIN hris_m_grade 
                                ON (hris_promosi.id_grade = hris_m_grade.id_grade)
                            where hris_promosi.is_delete = 'N'
                            AND promosi_category != 'first_grade'
                            ;
                        ");

        return view('promosi.index', compact('promosi'));
    }

    public function add()
    {

        $employee = DB::select("SELECT * from hris_m_emp WHERE is_delete='N'");
        $dept = DB::select("SELECT * from hris_m_grade WHERE is_delete='N'");

        return view('promosi.add', compact('employee', 'dept'));
    }

    protected function save(Request $request)
    {

        $promosi = new Promosi;
        $promosi->id_emp             = $request->id_emp;
        $promosi->id_grade           = $request->id_grade;
        $promosi->promosi_activedate = $request->promosi_activedate;
        $promosi->promosi_category   = $request->promosi_category;
        $promosi->input_date         = Auth::user()->name;
        $promosi->input_by           = date('Y-m-d');
        $promosi->save();

        MasterEmploye::where('id_emp', $request->id_emp)->update([

            'id_grade'  => $request->id_grade,
            'edit_by'   => Auth::user()->name,
            'edit_date' => date('Y-m-d')

        ]);

        return redirect(route('promosi.index'))->with('success', 'success');

    }

}

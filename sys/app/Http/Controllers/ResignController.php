<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ResignController extends Controller
{
    public function index()
    {
        $resign = DB::select("
                        SELECT
                            hris_m_emp.emp_name
                            , hris_resignation.id_emp
                            , hris_resignation.rsg_category
                            , hris_resignation.rsg_date
                            , hris_resignation.rsg_reason
                            , hris_resignation.input_by
                            , hris_resignation.input_date
                            , hris_resignation.is_delete
                            , hris_m_dept.dept_name
                            , hris_m_grade.grade_name
                            , hris_m_section.section_name
                        FROM
                            hris_resignation
                            INNER JOIN hris_m_emp 
                                ON (hris_resignation.id_emp = hris_m_emp.id_emp)
                            INNER JOIN hris_m_dept 
                                ON (hris_m_emp.id_dept = hris_m_dept.id_dept)
                            INNER JOIN hris_m_grade 
                                ON (hris_m_emp.id_grade = hris_m_grade.id_grade)
                            INNER JOIN hris_m_section 
                                ON (hris_m_emp.id_section = hris_m_section.id_section);
                        ");

        return view('resign.index', compact('resign'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\MasterEmploye;

class EmployeeController extends Controller
{
    // index
    public function index()
    {

        SELECT * FROM hris_m_emp
                        LEFT JOIN hris_m_dept ON hris_m_emp.id_dept = hris_m_dept.id_dept
                        LEFT JOIN hris_m_grade ON hris_m_emp.id_grade = hris_m_grade.id_grade
                                LEFT JOIN hris_m_section ON hris_m_emp.id_section = hris_m_section.id_section
                        WHERE hris_m_emp.is_delete='N' and emp_status != 'Resign' 
                        order by hris_m_emp.id_grade asc
        
        $employee = MasterEmploye::where('is_delete', 'N')->where('emp_status', '!=', 'Resign')->get();

        return view('employee.index');
    }

}

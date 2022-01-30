<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Contract;

use Auth;
use DB;

class ContractController extends Controller
{

    public function index()
    {
        $contract = DB::select("
                        SELECT
                        hris_contract.id_emp
                        , hris_contract.contract_status
                        , hris_contract.contract_start_date
                        , hris_contract.id_emp
                        , hris_contract.contract_status
                        , hris_contract.contract_start_date
                        , hris_contract.contract_end_date
                        , hris_contract.remarks
                        , hris_contract.input_by
                        , hris_contract.input_date
                        , hris_contract.is_delete
                        , hris_m_grade.grade_name
                        , hris_m_emp.emp_name
                        , hris_m_emp.emp_gender
                        , hris_m_emp.emp_address
                        , hris_m_emp.emp_email
                        , hris_m_emp.emp_status
                        , hris_m_emp.emp_datebirth
                        , hris_m_emp.emp_placebirth
                        , hris_m_emp.emp_phone_no
                        , hris_m_emp.emp_join_date
                        , hris_m_dept.dept_name
                        , hris_m_section.section_name
                        , hris_m_dept.dept_parent
                        , YEAR(hris_contract.contract_end_date)-YEAR(hris_contract.contract_start_date) AS 'durasi'
                    FROM
                        hris_contract
                        INNER JOIN hris_m_emp 
                            ON (hris_contract.id_emp = hris_m_emp.id_emp)
                        INNER JOIN hris_m_dept 
                            ON (hris_m_emp.id_dept = hris_m_dept.id_dept)
                        INNER JOIN hris_m_section 
                            ON (hris_m_section.id_section = hris_m_emp.id_section)
                        INNER JOIN hris_m_grade 
                            ON (hris_m_emp.id_grade = hris_m_grade.id_grade)
                        WHERE hris_contract.is_delete = 'N'        
                            ;
                        ");

        return view('contract.index', compact('contract'));
    }

}

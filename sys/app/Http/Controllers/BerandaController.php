<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Model\MasterEmploye;


class BerandaController extends Controller
{

    public function dashboard(){

        // ---
        $CountEmploye        = MasterEmploye::where('is_delete', 'N')->where('emp_status', '!=', 'Resign')->count();
        $CountBOD            = MasterEmploye::where('is_delete', 'N')->where('emp_status', '!=', 'Resign')->WhereIn('id_grade', ['1','2','3','4'])->count();
        $CountLocalEmploye   = MasterEmploye::where('is_delete', 'N')->where('emp_status', '!=', 'Resign')->where('emp_region', 'Indonesia')->where('id_grade', '>', 4)->count();
        $CountForeignEmploye = MasterEmploye::where('is_delete', 'N')->where('emp_status', '!=', 'Resign')->where('emp_region', '!=', 'Indonesia')->count();

        // Employment Status Chart
        $CountProbation    = MasterEmploye::where('is_delete', 'N')->where('emp_status', 'Probation')->count();
        $CountContract     = MasterEmploye::where('is_delete', 'N')->where('emp_status', 'Contract')->count();
        $CountPermanent    = MasterEmploye::where('is_delete', 'N')->where('emp_status', 'Permanent')->count();
        $CountOutsourching = MasterEmploye::where('is_delete', 'N')->where('emp_status', 'Outsourching')->count();

        // Gender Chart
        $CountMale   = MasterEmploye::where('is_delete', 'N')->where('emp_gender', 'male')->count();
        $CountFemale = MasterEmploye::where('is_delete', 'N')->where('emp_gender', 'female')->count();

        // Monitoring Karyawan Kontrak
        $CountToday = DB::select("SELECT COUNT(*) AS 'a' FROM hris_m_emp  WHERE emp_status != 'Permanent' AND emp_status != 'Resign' AND emp_contract_end_date = CURDATE()");
        $CountToday = $CountToday[0]->a;

        $CountMonth = DB::select(" SELECT COUNT(*) as 'a', MONTH(emp_contract_end_date) FROM hris_m_emp WHERE emp_status != 'Permanent' AND emp_status != 'Resign' AND YEAR(emp_contract_end_date) = YEAR(NOW()) AND MONTH(emp_contract_end_date) =  MONTH(NOW()) ");
        $CountMonth = $CountMonth[0]->a;

        $CountNextMonth = DB::select(" SELECT COUNT(*) as 'a', MONTH(emp_contract_end_date) FROM hris_m_emp WHERE emp_status != 'Permanent'  AND emp_status != 'Resign'  AND YEAR(emp_contract_end_date)     =  YEAR(NOW()) AND MONTH(emp_contract_end_date)    =  MONTH(NOW())+1 ");
        $CountNextMonth = $CountNextMonth[0]->a;

        $CountAll = DB::select("SELECT COUNT(*) AS 'a' FROM hris_m_emp  WHERE emp_status != 'Permanent' AND emp_status != 'Resign' ");
        $CountAll = $CountAll[0]->a;

        return view('dashboard.index', compact('CountEmploye','CountBOD', 'CountLocalEmploye', 'CountForeignEmploye', 'CountOutsourching', 'CountPermanent', 'CountContract', 'CountProbation', 'CountFemale', 'CountMale', 'CountAll', 'CountNextMonth', 'CountMonth', 'CountToday'));

    }

    public function logout () {
          //logout user
          auth()->logout();
          
          // redirect to homepage
          return redirect('/');
    }

}

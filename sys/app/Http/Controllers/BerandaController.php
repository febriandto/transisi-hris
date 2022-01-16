<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Model\MasterEmploye;


class BerandaController extends Controller
{

    public function dashboard(){

        $CountEmploye = MasterEmploye::where('is_delete', 'N')->where('emp_status', '!=', 'Resign')->count();
        $CountBOD = MasterEmploye::where('is_delete', 'N')->where('emp_status', '!=', 'Resign')->WhereIn('id_grade', ['1','2','3','4'])->count();
        $CountLocalEmploye = MasterEmploye::where('is_delete', 'N')->where('emp_status', '!=', 'Resign')->where('emp_region', 'Indonesia')->where('id_grade', '>', 4)->count();
        $CountForeignEmploye = MasterEmploye::where('is_delete', 'N')->where('emp_status', '!=', 'Resign')->where('emp_region', '!=', 'Indonesia')->count();

        $CountProbation = MasterEmploye::where('is_delete', 'N')->where('emp_status', 'Probation')->count();
        $CountContract = MasterEmploye::where('is_delete', 'N')->where('emp_status', 'Contract')->count();
        $CountPermanent = MasterEmploye::where('is_delete', 'N')->where('emp_status', 'Permanent')->count();
        $CountOutsourching = MasterEmploye::where('is_delete', 'N')->where('emp_status', 'Outsourching')->count();

        return view('dashboard.index', compact('CountEmploye','CountBOD', 'CountLocalEmploye', 'CountForeignEmploye', 'CountOutsourching', 'CountPermanent', 'CountContract', 'CountProbation'));

    }

    public function logout () {
          //logout user
          auth()->logout();
          
          // redirect to homepage
          return redirect('/');
    }

}

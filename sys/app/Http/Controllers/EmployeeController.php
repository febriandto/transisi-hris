<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Model\MasterEmploye;
use App\Model\MasterDepartment;
use App\Model\MasterSection;
use App\Model\MasterSubSection;
use App\Model\MasterGrade;
use App\Model\MasterMutasi;
use App\Model\Promosi;
use App\Model\PersonalInformation;
use App\Model\Contract;
use App\Model\Users;
use Auth;
use DateTime;
use DB;

class EmployeeController extends Controller
{
    // index
    public function index()
    {

        $ActiveEmployee = MasterEmploye::where('emp_status', '!=', 'resign')->count();
        $ResignEmployee = MasterEmploye::where('emp_status', 'resign')->count();

        $CountBOD            = MasterEmploye::where('is_delete', 'N')->where('emp_status', '!=', 'Resign')->WhereIn('id_grade', ['1','2','3','4'])->count();
        $CountLocalEmploye   = MasterEmploye::where('is_delete', 'N')->where('emp_status', '!=', 'Resign')->where('emp_region', 'Indonesia')->where('id_grade', '>', 4)->count();
        $CountForeignEmploye = MasterEmploye::where('is_delete', 'N')->where('emp_status', '!=', 'Resign')->where('emp_region', '!=', 'Indonesia')->count();
        
        if( \Request::route()->getName() == 'employee.local' ){
            
            $employee = MasterEmploye::where('is_delete', 'N')->where('emp_status', '!=', 'Resign')->where('emp_region', 'Indonesia')->where('id_grade', '>', 4)->OrderBy('id_grade', 'ASC')->get();

        }else if(\Request::route()->getName() == 'employee.foreign'){
            
            $employee = MasterEmploye::where('is_delete', 'N')->where('emp_status', '!=', 'Resign')->where('emp_region', '!=', 'Indonesia')->OrderBy('id_grade', 'ASC')->get();

        }else if(\Request::route()->getName() == 'employee.bod'){

            $employee = MasterEmploye::where('is_delete', 'N')->where('emp_status', '!=', 'Resign')->WhereIn('id_grade', ['1','2','3','4'])->OrderBy('id_grade', 'ASC')->get();

        }else{

            $employee = MasterEmploye::where('is_delete', 'N')->where('emp_status', '!=', 'Resign')->OrderBy('id_grade', 'ASC')->get();
        }

        return view('employee.index', compact('employee', 'ActiveEmployee', 'ResignEmployee', 'CountLocalEmploye', 'CountForeignEmploye', 'CountBOD'));
    }

    public function add()
    {

        $atasanLangsung = MasterEmploye::where('is_delete', 'N')->where('emp_status', '!=', 'resign')->where('id_grade', '<=', '30')->OrderBy('emp_name', 'ASC')->get();

        $dept = MasterDepartment::where('is_delete', 'N')->OrderBy('dept_name', 'ASC')->get();
        $section = MasterSection::where('is_delete', 'N')->OrderBy('section_name', 'ASC')->get();
        $subSection = MasterSubSection::where('is_delete', 'N')->OrderBy('subsection_name', 'ASC')->get();
        $grade = MasterGrade::where('is_delete', 'N')->OrderBy('grade_name', 'ASC')->get();


        return view('employee.add', compact('atasanLangsung', 'dept', 'section', 'grade', 'subSection'));
    }

    protected function save(Request $request)
    {

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('emp_photo');
 
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'images/upload';
 
        // upload file
        $file->move($tujuan_upload, $request->id.".".$file->getClientOriginalExtension());

        $emp = new MasterEmploye;

        $emp->id_emp                 = $request->id;
        $emp->no_id                  = $request->no_id;
        $emp->emp_idktp              = $request->id_ktp;
        $emp->emp_name               = $request->nama;
        $emp->emp_datebirth          = $request->tgl_lahir;
        $emp->emp_placebirth         = $request->tempat_lahir;
        $emp->emp_gender             = $request->emp_gender;
        $emp->emp_address            = $request->alamat;
        $emp->emp_region             = $request->emp_region;
        $emp->emp_main_cat           = $request->emp_main_cat;
        $emp->emp_phone_no           = $request->telepon;
        $emp->emp_email              = $request->email;
        $emp->id_dept                = $request->dept;
        $emp->id_section             = $request->id_section;
        $emp->id_subsection          = $request->id_subsection;
        $emp->id_grade               = $request->grade;
        $emp->emp_join_date          = $request->tgl_join;
        $emp->emp_status             = $request->status;
        $emp->emp_contract_startdate = $request->tgl_join;
        $emp->emp_contract_end_date  = $request->emp_contract_end_date;
        $emp->emp_contract_remarks   = $request->emp_contract_remarks;
        $emp->emp_photo              = $request->id.".".$file->getClientOriginalExtension();
        $emp->emp_atasan             = $request->emp_atasan;
        $emp->input_by               = Auth::user()->name;
        $emp->input_date             = date('Y-m-d');
        $emp->is_delete              = "N";
        $emp->save();

        $mutasi = new MasterMutasi;
        $mutasi->id_emp            = $request->id;
        $mutasi->id_dept           = $request->dept;
        $mutasi->mutasi_activedate = date('Y-m-d');
        $mutasi->mutasi_category   = "first_dept";
        $mutasi->input_by          = Auth::user()->name;
        $mutasi->input_date        = date('Y-m-d');
        $mutasi->save();

        $promosi = new Promosi;
        $promosi->id_emp             = $request->id;
        $promosi->id_grade           = $request->grade;
        $promosi->promosi_activedate = date('Y-m-d');
        $promosi->promosi_category   = "first_grade";
        $promosi->input_by           = Auth::user()->name;
        $promosi->input_date         = date("Y-m-d");
        $promosi->save();

        $pi = new PersonalInformation;
        $pi->id_emp     = $request->id;
        $pi->input_by   = Auth::user()->name;
        $pi->input_date = date("Y-m-d");
        $pi->save();

        $contract = new Contract;
        $contract->id_emp              = $request->id;
        $contract->contract_status     = $request->status;
        $contract->contract_start_date = $request->tgl_join;
        $contract->contract_end_date   = $request->emp_contract_end_date;
        $contract->remarks             = $request->emp_contract_remarks;
        $contract->input_by            = Auth::user()->name;
        $contract->input_date          = date("Y-m-d");
        $contract->save();

        $user = new Users;
        $user->username = $request->id;
        $user->password = Hash::make($request->id);
        $user->name     = $request->name;
        $user->save();

        return redirect(route('employee.index'));

    }

    public function detail(MasterEmploye $id)
    {

        $employee = $id;

        $join_date = $employee->emp_join_date;
        $date = new DateTime($join_date);
        $now = new DateTime('now');
        $interval = $date->diff($now);
        $lamaKerja =  $interval->format('%y Tahun %m Bulan %d Hari');

        $mutasi = DB::select("SELECT
            `hris_m_mutasi`.`id_dept`
            , `hris_m_mutasi`.`id_emp`
            , `hris_m_mutasi`.`id_mutasi`
            , `hris_m_emp`.`emp_name`
            , `hris_m_dept`.`dept_name`
            , `hris_m_dept`.`dept_head`
            , `hris_m_mutasi`.`mutasi_activedate`
            , `hris_m_mutasi`.`mutasi_category`
        FROM
            `hris_m_mutasi`
            INNER JOIN `hris_m_emp` 
                ON (`hris_m_mutasi`.`id_emp` = `hris_m_emp`.`id_emp`)
            INNER JOIN `hris_m_dept` 
                ON (`hris_m_mutasi`.`id_dept` = `hris_m_dept`.`id_dept`)
        WHERE `hris_m_emp`.`id_emp` = '".$id->id_emp."'");

        $jabatanPromosi = DB::select("
            SELECT
                `hris_promosi`.`id_grade`
                , `hris_promosi`.`promosi_activedate`
                , `hris_promosi`.`promosi_category`
                , `hris_promosi`.`input_date`
                , `hris_promosi`.`input_by`
                , `hris_promosi`.`is_delete`
                , `hris_m_grade`.`grade_name`
                , `hris_m_grade`.`grade_remarks`
                , `hris_m_grade`.`grade_level`
                , `hris_m_emp`.`emp_name`
            FROM
                `hris_promosi`
                INNER JOIN `hris_m_emp`
                    ON (`hris_promosi`.`id_emp` = `hris_m_emp`.`id_emp`)
                INNER JOIN `hris_m_grade`
                    ON (`hris_promosi`.`id_grade` = `hris_m_grade`.`id_grade`)
            WHERE `hris_promosi`.`id_emp` = '".$id->id_emp."' and promosi_category != 'first_grade'
            ");

        $kontrak = DB::select("
                  SELECT
                      `hris_contract`.`no_contract`
                      , `hris_contract`.`id_emp`
                      , `hris_m_emp`.`emp_name`
                      , `hris_contract`.`contract_status`
                      , `hris_contract`.`contract_start_date`
                      , `hris_contract`.`contract_end_date`
                      , TIMESTAMPDIFF(MONTH, contract_start_date, contract_end_date) AS 'selisih_bulan'
                                            , TIMESTAMPDIFF(YEAR, contract_start_date, contract_end_date) AS 'selisih_tahun'
                      , `hris_contract`.`remarks`
                  FROM
                      `hris_contract`
                      INNER JOIN `hris_m_emp`
                          ON (`hris_contract`.`id_emp` = `hris_m_emp`.`id_emp`)
                  WHERE `hris_contract`.`id_emp` = '".$id->id_emp."'
                  ");

        $sp = DB::select("
                SELECT
                    `hris_m_emp`.`emp_name`
                    , `hris_sp`.`no_sp`
                    , `hris_sp`.`sp_date`
                    , `hris_sp`.`id_spcat`
                    , `hris_sp`.`sp_title`
                    , `hris_sp`.`sp_valid_date`
                    , `hris_sp`.`sp_description`
                    , `hris_sp`.`sp_punishment`
                    , `hris_sp`.`id_emp`
                    , `hris_sp`.`input_date`
                    , `hris_sp`.`input_by`
                    , `hris_sp`.`edit_by`
                    , `hris_sp`.`edit_date`
                    , `hris_sp`.`is_delete`
                FROM
                    `hris_sp`
                    INNER JOIN `hris_m_emp`
                        ON (`hris_sp`.`id_emp` = `hris_m_emp`.`id_emp`)
                    where `hris_sp`.`id_emp` = '".$id->id_emp."'
                        ;
                ");

        $training = DB::select("
                        SELECT
                            `hris_m_emp`.`id_emp`
                            , `hris_m_emp`.`emp_name`
                            , `hris_training`.`training_name`
                            , `hris_training_detail`.`training_as`
                            , `hris_training`.`training_date`
                            , `hris_training_detail`.`id_training_detail`
                            , `hris_training_detail`.`id_training`
                            , `hris_training`.`training_trainer`
                            , `hris_training`.`training_desc`
                            , `hris_training`.`training_helder`
                            , `hris_training`.`training_duration`
                            , `hris_training`.`training_location`
                        FROM
                            `hris_training`
                            INNER JOIN `hris_training_detail` 
                                ON (`hris_training`.`id_training` = `hris_training_detail`.`id_training`)
                            INNER JOIN `hris_m_emp` 
                                ON (`hris_training_detail`.`id_emp` = `hris_m_emp`.`id_emp`)
                            where `hris_m_emp`.`id_emp` = '".$id->id_emp."'
                                ;
                        ");

        $atasan = DB::select("
                        SELECT
                            `hris_m_emp`.`id_emp`
                            , `hris_m_emp`.`emp_name`
                            , `hris_m_emp_1`.`emp_name` as 'atasan'
                        FROM
                            `hris_m_emp`
                            INNER JOIN `hris_m_emp` AS `hris_m_emp_1` 
                                ON (`hris_m_emp`.`emp_atasan` = `hris_m_emp_1`.`id_emp`)
                            WHERE hris_m_emp.id_emp = '".$id->id_emp."';
                        ");

        $personal_information = PersonalInformation::where('id_emp', $id->id_emp)->first();

        $work_experience = DB::select("
                            SELECT
                                `hris_experience`.`id_emp`
                                , `hris_experience`.`id_experience`
                                , `hris_experience`.`exp_company_name`
                                , `hris_experience`.`exp_start_date`
                                , `hris_experience`.`exp_end_date`
                                , `hris_experience`.`exp_bussiness_type`
                                , `hris_experience`.`exp_company_location`
                                , `hris_experience`.`exp_last_position`
                                , `hris_experience`.`exp_jobdesc`
                                , `hris_experience`.`exp_quit_reason`
                                , `hris_experience`.`exp_region`
                                , `hris_experience`.`input_by`
                                , `hris_experience`.`is_delete`
                                , `hris_m_emp`.`emp_name`
                            FROM
                                `hris_experience`
                                INNER JOIN `hris_m_emp`
                                    ON (`hris_experience`.`id_emp` = `hris_m_emp`.`id_emp`)
                            WHERE `hris_experience`.`id_emp` = '".$id->id_emp."'");

        return view('employee.detail', compact("employee", "lamaKerja", "mutasi", "jabatanPromosi", "kontrak", "sp", "training", "atasan", "personal_information", "work_experience"));
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Accident;
use DB;
use Auth;

class AccidentEmployeeController extends Controller
{
    public function index()
    {
        $accident_employee = DB::select(" SELECT * FROM hris_accident
                                INNER JOIN hris_m_acc_category ON hris_m_acc_category.id_acc_cat = hris_accident.id_acc_cat
                                INNER JOIN hris_m_emp ON hris_accident.id_emp = hris_m_emp.id_emp
                                INNER JOIN hris_m_dept ON hris_m_emp.id_dept = hris_m_dept.id_dept
                                WHERE hris_accident.is_delete='N' ");

        return view('accident_employee.index', compact('accident_employee'));
    }

    public function add()
    {
        $employee = DB::select("SELECT * from hris_m_emp WHERE is_delete='N'");
        $accident_category = DB::select("SELECT * from hris_m_acc_category WHERE is_delete='N'");

        return view('accident_employee.add', compact('employee', 'accident_category'));
    }

    protected function save(Request $request)
    {

        $acc = new Accident;
        $acc->id_accident       = $request->id_accident;
        $acc->id_acc_cat        = $request->id_acc_cat;
        $acc->acc_date          = $request->acc_date;
        $acc->id_emp            = $request->id_emp;
        $acc->acc_recovery_desc = $request->acc_recovery_desc;
        $acc->acc_status        = $request->acc_status;
        $acc->acc_time          = $request->acc_time;
        $acc->acc_condition     = $request->acc_condition;
        $acc->acc_desc          = $request->acc_desc;
        $acc->input_by          = Auth::user()->name;
        $acc->input_date        = date('Y-m-d');
        $acc->save();

        return redirect(route('accident.index'));

    }

    public function edit(Accident $accident)
    {

        $employee = DB::select("SELECT * from hris_m_emp WHERE is_delete='N'");
        $accident_category = DB::select("SELECT * from hris_m_acc_category WHERE is_delete='N'");

        return view('accident_employee.edit', compact('accident', 'employee', 'accident_category'));
    }

    protected function update(Request $request)
    {

        // dd(Accident::where('id_accident', $request->id_accident_old)->first());

        Accident::where('id_accident', $request->id_accident_old)->update([

            'id_accident'       => $request->id_accident,
            'id_acc_cat'        => $request->id_acc_cat,
            'acc_date'          => $request->acc_date,
            'id_emp'            => $request->id_emp,
            'acc_recovery_desc' => $request->acc_recovery_desc,
            'acc_status'        => $request->acc_status,
            'acc_time'          => $request->acc_time,
            'acc_condition'     => $request->acc_condition,
            'acc_desc'          => $request->acc_desc,
            'edit_by'           => Auth::user()->name,
            'edit_date'         => date('Y-m-d')

        ]);

        return redirect(route('accident.index'));

    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Team;
use DB;

class TeamController extends Controller
{
    public function index()
    {
        $team = DB::select("
            SELECT 
                hris_m_emp.id_emp, hris_m_emp.emp_name, hris_m_dept.dept_name, hris_t_team.team_id,
                hris_t_team.update_by, hris_t_team.update_date
            FROM hris_t_team
                LEFT JOIN hris_m_emp    ON hris_t_team.team_leader_id   = hris_m_emp.id_emp
                LEFT JOIN hris_m_dept   ON hris_m_emp.id_dept           = hris_m_dept.id_dept
            WHERE hris_t_team.is_delete = 'N'
            ORDER BY hris_m_emp.emp_name ASC
        ");

        return view('team.index', compact('team'));
    }

    public function add()
    {

        $employee = DB::select("
          SELECT * FROM hris_m_emp
            INNER JOIN hris_m_dept ON hris_m_emp.id_dept = hris_m_dept.id_dept
            WHERE hris_m_emp.is_delete = 'N' AND hris_m_emp.emp_status != 'resign'
            ORDER BY hris_m_emp.emp_name ASC 
        ");

        return view('team.add', compact('employee'));
    }

    public function view(Team $team)
    {
        $team_leader = DB::select("
            SELECT team_leader FROM hris_t_team
            WHERE team_id = '".$team->team_id."' 
        ");
        $team_leader = $team_leader[0]->team_leader;

        $team = DB::select("
            SELECT * FROM hris_t_team_detail
                LEFT JOIN hris_m_emp ON hris_t_team_detail.id_emp = hris_m_emp.id_emp
                LEFT JOIN hris_m_dept ON hris_m_emp.id_dept = hris_m_dept.id_dept
                LEFT JOIN hris_m_grade ON hris_m_emp.id_grade = hris_m_grade.id_grade
            WHERE hris_t_team_detail.is_delete = 'N' AND hris_t_team_detail.team_id = '".$team->team_id."'
            ORDER BY hris_m_emp.emp_name ASC
        ");

        return view('team.view', compact('team_leader', 'team'));
    }
}

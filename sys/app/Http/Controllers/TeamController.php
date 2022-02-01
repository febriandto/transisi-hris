<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Team;
use App\Model\TeamDetail;
use DB;
use Auth;

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

    protected function save(Request $request)
    {
        $today = date('Y-m-d');

        $data = DB::select("
        SELECT max(team_id) AS last FROM hris_t_team WHERE input_date Like'$today%'");
        foreach( $data as $ulala ){

          $lastID       = $ulala->last;
          $lastNoUrut   = substr($lastID, 8, 2); 
          $nextNoUrut   = $lastNoUrut + 1;
          $nextDocID    = sprintf('%02s', $nextNoUrut);
          $new_id       = date('dmy');
          $team_id      = "TL".$new_id.$nextDocID;

        }

        $team_leader_id = DB::select("
            SELECT emp_name FROM hris_m_emp
            WHERE hris_m_emp.id_emp = '".$request->team_leader_id."' 
        ");

        foreach( $team_leader_id as $team_leader_id){
            $team_leader = $team_leader_id->emp_name;
        }

        $team = new Team;
        $team->team_id        = $team_id;
        $team->team_leader_id = $request->team_leader_id;
        $team->team_leader    = $team_leader;
        $team->input_by       = Auth::user()->name;
        $team->input_date     = date('Y-m-d');
        $team->update_by      = Auth::user()->name;
        $team->update_date    = date('Y-m-d');
        $team->save();

        return redirect(route('team.view', $team_id));

    }

    public function view(Team $team)
    {
        $team_leader = DB::select("
            SELECT team_leader FROM hris_t_team
            WHERE team_id = '".$team->team_id."' 
        ");
        $team_leader = $team_leader[0]->team_leader;

        $team_id = $team->team_id;

        $team = DB::select("
            SELECT * FROM hris_t_team_detail
                LEFT JOIN hris_m_emp ON hris_t_team_detail.id_emp = hris_m_emp.id_emp
                LEFT JOIN hris_m_dept ON hris_m_emp.id_dept = hris_m_dept.id_dept
                LEFT JOIN hris_m_grade ON hris_m_emp.id_grade = hris_m_grade.id_grade
            WHERE hris_t_team_detail.is_delete = 'N' AND hris_t_team_detail.team_id = '".$team->team_id."'
            ORDER BY hris_m_emp.emp_name ASC
        ");

        return view('team.view', compact('team_leader', 'team', 'team_id'));
    }

    public function add_team(Team $team, Request $request)
    {
        $employee = DB::select("
          SELECT * FROM hris_m_emp
            INNER JOIN hris_m_dept ON hris_m_emp.id_dept = hris_m_dept.id_dept
            WHERE hris_m_emp.is_delete = 'N' AND hris_m_emp.emp_status != 'resign'
            ORDER BY hris_m_emp.emp_name ASC 
        ");

        return view('team.add_team', compact('employee', 'team'));
    }

    protected function save_team(Request $request){

        $today2 = date('Y-m-d');

        $query2 = DB::select("SELECT max(team_detail_id) AS last2 FROM hris_t_team_detail WHERE input_date Like'$today2%'");
        $query2 = $query2[0];

        $lastDocID2  = $query2->last2;
        $lastNoUrut2 = substr($lastDocID2, 8, 3); 
        $nextNoUrut2 = $lastNoUrut2 + 1;
        $nextDocID2  = sprintf('%03s', $nextNoUrut2);
        $doctoday2   = date('dmy');
        $doc_id      = "TD".$doctoday2.$nextDocID2;


        $data2 = DB::select("SELECT team_leader_id FROM hris_t_team WHERE team_id = '".$request->team_id."'");
        foreach($data2 as $data2) {
            $team_leader_id = $data2->team_leader_id;
        }

        $team_detail = new TeamDetail;

        $team_detail->team_detail_id = $doc_id;
        $team_detail->team_leader_id = $team_leader_id;
        $team_detail->team_id        = $request->team_id;
        $team_detail->id_emp         = $request->id_emp;
        $team_detail->input_by       = Auth::user()->name;
        $team_detail->input_date     = date('Y-m-d');
        $team_detail->update_by      = Auth::user()->name;
        $team_detail->update_date    = date('Y-m-d');
        $team_detail->save();

        return redirect(route('team.view', $request->team_id));

    }

    protected function delete(Request $request)
    {
        Team::where('team_id', $request->team_id)->update([

            'is_delete' => 'Y',
            'update_by' => Auth::user()->name,
            'update_date' => date('Y-m-d')

        ]);

        TeamDetail::where('team_id', $request->team_id)->update([

            'is_delete' => 'Y',
            'update_by' => Auth::user()->name,
            'update_date' => date('Y-m-d')

        ]);

        return redirect(route('team.index', ['hapus' => 'sukses']));

    }

    protected function delete_team(Request $request)
    {

        TeamDetail::where('team_id', $request->team_id)->where('team_detail_id', $request->team_detail_id)->update([

            'is_delete' => 'Y',
            'update_by' => Auth::user()->name,
            'update_date' => date('Y-m-d')

        ]);

        return redirect(route('team.view', $request->team_id, ['hapus' => 'sukses']));
    }
}
<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    //
    
    protected $table = 'hris_t_absen';

    protected $primaryKey = 'absen_id';

    public $timestamps = false;

    protected $fillable = ['absen_id', 'finger_id',   'id_emp',  'absen_date',  'absen_working_hours', 'absen_in_time',   'absen_out_time',  'absen_scan_in_time',  'absen_scan_out_time', 'absen_normal',    'absen_real',  'absen_scan_late', 'absen_go_home_early', 'absen_absent',    'absen_overtime',  'absen_work_hour', 'absen_weekend',   'absen_holiday',   'absen_total_att', 'absen_overtime_normal',   'absen_overtime_weekend',  'absen_overtime_holiday',  'input_by',    'input_date',  'edit_by', 'edit_date',   'is_delete'   ];
}

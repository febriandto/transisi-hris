<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ViewTraining1 extends Model
{
    //
    
    protected $table = 'hris_t_team_detail';

    protected $primaryKey = 'id_training';

    public $timestamps = false;

    protected $fillable = ['id_training',  'training_name',   'training_date',   'training_trainer',    'training_desc',   'training_helder', 'training_start_time', 'training_end_time',   'training_duration',   'training_location',   'id_training_detail',  'id_emp',  'training_as', 'input_by',    'is_delete',   'emp_name',    'emp_datebirth',   'emp_placebirth',  'emp_address', 'emp_phone_no',    'emp_email',   'dept_name',   'grade_name',  'emp_join_date',   'emp_status',  'emp_photo'];
}

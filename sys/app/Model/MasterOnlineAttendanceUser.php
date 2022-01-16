<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MasterOnlineAttendanceUser extends Model
{
    //
    
    protected $table = 'hris_m_online_attendance_user';

    protected $primaryKey = 'online_attendance_user_id';

    public $timestamps = false;

    protected $fillable = [ 'online_attendance_user_id','id_emp','input_by','input_date','is_delete'];
    
}

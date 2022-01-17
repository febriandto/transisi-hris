<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OnlineAttendance extends Model
{
    //
    
    protected $table = 'hris_t_online_attendance';

    protected $primaryKey = 'online_att_id';

    public $timestamps = false;

    protected $fillable = ['online_att_id',    'id_emp',  'online_att_photo',    'latitude',    'longitude',   'online_att_cat',  'input_by',    'input_date',  'is_delete'];
}

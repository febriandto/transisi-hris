<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    //
    
    protected $table = 'hris_experience';

    protected $primaryKey = 'id_experience';

    public $timestamps = false;

    protected $fillable = [ 'id_experience','id_emp','exp_company_name','exp_start_date','exp_end_date','exp_bussiness_type','exp_company_location','exp_last_position','exp_jobdesc','exp_quit_reason','exp_region','input_date','input_by','is_delete'];
    
}

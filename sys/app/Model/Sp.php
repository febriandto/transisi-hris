<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sp extends Model
{
    //
    
    protected $table = 'hris_sp';

    protected $primaryKey = 'no_sp';

    public $timestamps = false;

    protected $fillable = ['no_sp','sp_date','id_spcat','sp_title','sp_description','sp_punishment','sp_valid_date','sp_status','id_emp','input_date','input_by','edit_by','edit_date','is_delete'];
}

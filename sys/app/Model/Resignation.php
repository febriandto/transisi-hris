<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Promosi extends Model
{
    //
    
    protected $table = 'hris_resignation';

    protected $primaryKey = 'id_resign';

    public $timestamps = false;

    protected $fillable = ['id_resign','id_emp','rsg_category','rsg_date','rsg_reason','input_by','input_date','is_delete'];
}

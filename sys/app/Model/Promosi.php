<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Promosi extends Model
{
    //
    
    protected $table = 'hris_promosi';

    protected $primaryKey = 'id_promosi';

    public $timestamps = false;

    protected $fillable = ['id_promosi','id_emp','id_grade','promosi_activedate','promosi_category','input_date','input_by','is_delete'];
}

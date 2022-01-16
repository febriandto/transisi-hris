<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    //
    
    protected $table = 'hris_competence';

    protected $primaryKey = 'id_competence';

    public $timestamps = false;

    protected $fillable = [ 'id_competence','comp_name','id_dept','remarks','input_by','input_date','edit_by','edit_Date','is_delete'];
    
}

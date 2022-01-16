<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CompetenceDetail extends Model
{
    //
    
    protected $table = 'hris_competence_detail';

    protected $primaryKey = 'id_comp_detail';

    public $timestamps = false;

    protected $fillable = [ 'id_comp_detail','id_competence','id_skillset','point','remarks','input_by','input_date','edit_by','edit_date','is_delete'];
    
}

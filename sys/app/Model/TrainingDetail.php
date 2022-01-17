<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TrainingDetail extends Model
{
    //
    
    protected $table = 'hris_training_detail';

    protected $primaryKey = 'id_training_detail';

    public $timestamps = false;

    protected $fillable = ['id_training_detail','id_training','id_emp','training_as','input_by','input_date','edit_by','edit_date','is_delete'];
}

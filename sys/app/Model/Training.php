<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    //
    
    protected $table = 'hris_training';

    protected $primaryKey = 'id_training';

    public $timestamps = false;

    protected $fillable = ['id_training','training_name','training_date','training_trainer','training_desc','training_helder','training_start_time','training_end_time','training_duration','training_location','input_by','input_date','edit_by','edit_date','is_delete'];
}

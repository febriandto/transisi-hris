<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Saran extends Model
{
    //
    
    protected $table = 'hris_t_saran';

    protected $primaryKey = 'saran_id';

    public $timestamps = false;

    protected $fillable = ['saran_id','saran_category','saran_text','username','input_by','input_date','input_time','is_delete'];
}

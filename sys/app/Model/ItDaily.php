<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ItDaily extends Model
{
    //
    
    protected $table = 'hris_it_daily';

    protected $primaryKey = 'id_daily';

    public $timestamps = false;

    protected $fillable = [ 'id_daily','daily_date','daily_desc','input_by','input_date','is_delete'];
    
}

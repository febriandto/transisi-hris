<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ItExt extends Model
{
    //
    
    protected $table = 'hris_it_ext';

    protected $primaryKey = 'id_ext';

    public $timestamps = false;

    protected $fillable = [ 'id_ext','ext_number','ext_owner','dept_name','intl_call','indo_call','input_by','input_date','edit_by','edit_date','is_delete'];
    
}

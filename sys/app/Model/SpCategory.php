<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SpCategory extends Model
{
    //
    
    protected $table = 'hris_spcat';

    protected $primaryKey = 'id_spcat';

    public $timestamps = false;

    protected $fillable = ['id_spcat','spcat_name','spcat_desc','is_delete'];
}

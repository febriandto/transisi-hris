<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MasterExt extends Model
{
    //
    
    protected $table = 'hris_m_ext';

    protected $primaryKey = 'id_ext';

    public $timestamps = false;

    protected $fillable = ['id_ext','nomor_ext','pemilik_ext','dept','status'];
    
}

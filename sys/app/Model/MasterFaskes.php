<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MasterFaskes extends Model
{
    //
    
    protected $table = 'hris_m_faskes';

    protected $primaryKey = 'id_faskes';

    public $timestamps = false;

    protected $fillable = ['id_faskes','faskes_name','faskes_address','faskes_phone','faskes_email','is_delete'];
    
}

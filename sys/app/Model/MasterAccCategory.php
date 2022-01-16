<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MasterAccCategory extends Model
{
    //
    
    protected $table = 'hris_m_acc_category';

    protected $primaryKey = 'id_acc_cat';

    public $timestamps = false;

    protected $fillable = ['id_acc_cat','acc_catcode','acc_catname','acc_catremarks','is_delete'];
    
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MasterIjin extends Model
{
    //
    
    protected $table = 'hris_m_ijin';

    protected $primaryKey = 'id_ijin';

    public $timestamps = false;

    protected $fillable = ['id_ijin',  'tgl_ijin',    'waktu_ijin',  'ijin_cat_id', 'sifat_ijin_id',   'tujuan_ijin', 'keperluan_ijin',  'lama_jam',    'lama_hari',   'status_app_atasan',   'tgl_app_atasan',  'status_app_manager',  'tgl_app_manager', 'status_app_hrd',  'tgl_app_hrd', 'input_date',  'edit_by', 'edit_date',   'input_by',    'is_delete'   ];
    
}

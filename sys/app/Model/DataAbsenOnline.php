<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DataAbsenOnline extends Model
{
    //
    
    protected $table = 'hris_t_data_absen_online';

    protected $primaryKey = 'id_data_absen_online';

    public $timestamps = false;

    protected $fillable = ['id_data_absen_online','id_emp','absen_online_cat_id','absen_online_cat_alias','absen_online_cat_id_pulang','absen_online_cat_alias_pulang','tgl_absen_online','jam_masuk','lat_masuk','long_masuk','photo_masuk','suhu_masuk','jam_pulang','lat_pulang','long_pulang','photo_pulang','suhu_pulang','input_by','input_date','edit_by','edit_date','is_delete'];
}

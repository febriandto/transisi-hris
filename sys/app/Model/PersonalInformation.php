<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PersonalInformation extends Model
{
    //
    
    protected $table = 'hris_personal_information';

    protected $primaryKey = 'id_personal_info';

    public $timestamps = false;

    protected $fillable = ['id_personal_info','id_emp','pers_blood_type','pers_education','pers_education_jhs','pers_education_shs','pers_education_univ1','pers_education_univ2','pers_major','pers_marital','pers_pasangan','pers_pekerjaan_pasangan','pers_child_qty','pers_anak1','pers_anak2','pers_anak3','pers_anak4','pers_anak5','pers_mother_name','tax_id_number','rekening','nomor_hp_2','nama_saudara','phone_saudara','alamat_saudara','hubungan_saudara','input_date','input_by','update_date','update_by','is_delete'];
}

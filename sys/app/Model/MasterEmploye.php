<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MasterEmploye extends Model
{
    //
    
    protected $table = 'hris_m_emp';

    protected $primaryKey = 'id_emp';

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = ['id_emp','no_id','emp_idktp','emp_name','emp_datebirth','emp_placebirth','emp_gender','emp_address','emp_address2','emp_address_ktp','emp_phone_no','emp_email','id_dept','id_section','id_subsection','id_grade','emp_join_date','emp_status','emp_contract_startdate','emp_contract_end_date','resign_date','emp_contract_remarks','emp_region','emp_main_cat','emp_photo','emp_photo_v','emp_atasan','input_by','input_date','edit_by','edit_date','is_delete'];

    public function department()
    {
        return $this->belongsTo('App\Model\MasterDepartment', 'id_dept', 'id_dept');
    }

    public function grade()
    {
        return $this->belongsTo('App\Model\MasterGrade', 'id_grade', 'id_grade');
    }

    public function section()
    {
        return $this->belongsTo('App\Model\MasterSection', 'id_section', 'id_section');
    }
    
}

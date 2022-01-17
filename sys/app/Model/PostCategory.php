<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    //
    
    protected $table = 'hris_post_cat';

    protected $primaryKey = 'cat_id';

    public $timestamps = false;

    protected $fillable = ['cat_id','cat_name','input_by','input_date','edit_by','edit_date','is_delete'];
}

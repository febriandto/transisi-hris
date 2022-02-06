<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    
    protected $table = 'hris_post';

    protected $primaryKey = 'post_id';

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = ['post_id','post_title','post_desc','post_exerp','cat_id','post_img','post_img_v','input_by','input_date','edit_by','edit_date','is_delete'];
}

<?php

namespace App\Model\Item;
use Eloquent;

use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
  protected $table = 'wms_m_item_cat';

  protected $primaryKey = 'item_cat_id';

  protected $keyType = 'string';

  public $timestamps = false;

  protected $guarded = [];
}

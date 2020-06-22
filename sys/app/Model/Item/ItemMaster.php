<?php

namespace App\Model\Item;
use Eloquent;

use Illuminate\Database\Eloquent\Model;

class ItemMaster extends Model
{
  protected $table = 'wms_m_item';

  protected $primaryKey = 'item_number';

  protected $keyType = 'string';

  public $timestamps = false;

  protected $guarded = [];
}

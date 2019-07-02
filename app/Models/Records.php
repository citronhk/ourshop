<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Records extends Model
{
    public $table="goods_records";

    public function records_good()
    {
    	return $this->belongsTo('App\Models\Goods','gid');
    }
}

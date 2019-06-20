<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phtoto extends Model
{
    //
    public $table = 'goods_phtoto';

    public function phtoto_goods()
    {
    	return $this->belongsTo('App\Models\Goods','gid');
    }
}

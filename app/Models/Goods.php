<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    public $table = 'goods';











    public function goods_cate()
    {
    	return $this->belongsTo('App\Models\Cates','cid');
    }
}

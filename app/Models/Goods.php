<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    public $table = 'goods';

    public function goods_cate()
    {
    	return $this->belongsTo('App\Models\Cates','cid');
    }

    public function goods_photo()
    {
    	return $this->hasOne('App\Models\Photo','gid');
    }

   
}

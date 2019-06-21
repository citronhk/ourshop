<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    public $table = 'goods_detail';

    public function detail_gid(){
    	return $this->belongsTo('App\Models\Goods','gid');
    }
}

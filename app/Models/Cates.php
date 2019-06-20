<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cates extends Model
{
    //
    public $table = 'cates';






    public function goods_cate()
    {
    	return $this->belongsTo('App\Models\Goods','cid');
    }
}

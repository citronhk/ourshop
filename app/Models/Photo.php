<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    public $table = 'goods_photo';

    public function photo_goods()
    {
    	return $this->belongsTo('App\Models\Goods','gid');
    }
}

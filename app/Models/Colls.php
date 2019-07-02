<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colls extends Model
{
    public $table="goods_colls";

    public function colls_good()
    {
    	return $this->belongsTo('App\Models\Goods','gid');
    }
}

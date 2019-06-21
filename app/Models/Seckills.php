<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seckills extends Model
{
    public $table = 'seckills';











    public function seckills_goods()
    {
    	return $this->belongsTo('App\Models\Goods','gid');
    }
}

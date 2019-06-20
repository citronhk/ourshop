<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    public $table = 'car';
    // public $primaryKey  = 'uid';

   //配置属于关系模型
    public function cargood()
    {
    	return $this->belongsTo('App\Models\Goods','gid');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orders_infos extends Model
{
    public $table = 'orders_infos';











     public function users_infos()
    {
    	return $this->hasOne('App\Models\Orders_users','oid');
    }

     public function orders_goods()
    {
    	return $this->belongsTo('App\Models\Goods','gid');
    }
}

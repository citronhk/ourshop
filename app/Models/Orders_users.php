<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orders_users extends Model
{
    public $table = 'orders_users';











    public function orders_users()
    {
    	return $this->belongsTo('App\Models\Users','uid');
    }
}

<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Act_goods extends Model
{
    public $table='act_goods';

    public function act_goods()
    {
    	return $this->belongsTo('App\Models\Goods','gid');
    }
}
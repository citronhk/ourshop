<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Act_Goods extends Model
{
    //

    public $table='act_goods';

    public function a_goods()
    {
    	return $this->belongsTo('App\Models\Goods','gid');
    }

    public function act_act()
    {
    	return $this->belongsTo('App\Models\Activities','aid');
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ads_act_goods extends Model
{
    public $table = 'ads_act_goods';

    public function adsact_goods()
    {
    	return $this->belongsTo('App\Models\goods','gid');
    }
}

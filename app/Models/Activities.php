<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Activities extends Model
{
    public $table = 'activities';

<<<<<<< HEAD
=======

>>>>>>> origin/zhihao
    public function show()
    {
    	return $this->hasOne('App\Models\Act_goods','aid');
    }
<<<<<<< HEAD
=======




>>>>>>> origin/zhihao

    public function activities_goods()
    {
    	return $this->belongsTo('App\Models\Goods','gid');
    }
}
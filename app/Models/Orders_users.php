<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

<<<<<<< HEAD
class orders_users extends Model
{
    public $table = 'orders_users';


    public function orders_users()
    {
    	return $this->belongsTo('App\Models\Users','uid');
=======
class Orders_users extends Model
{
    public $table = 'orders_users';

     //配置一对多 模型关系
    public function orderUserInfo()
    {
    	return $this->hasMany('App\Models\orders_infos','oid');
>>>>>>> origin/dapeng
    }
}
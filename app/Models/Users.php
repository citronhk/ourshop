<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Users extends Model
{
    //设置表名
    public $table = 'users';




    //配置一对一
    public function userinfo()
    {
    	return $this->hasOne('App\Models\UsersInfo','uid');
    }

     //配置一对多 模型关系
    public function usercar()
    {
    	return $this->hasMany('App\Models\Car','uid');
    }
    
}

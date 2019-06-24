<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
           //设置表名
    public $table = 'roles';

   public $timestamps = false;   
   
   //配置一对多关系
   
   public function rolesnodes()
   {
   	  return $this->hasMany('App\Models\RolesNodes','rid');
   }
}

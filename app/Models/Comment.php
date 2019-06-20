<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	//指定数据表
    public $table = 'comment';











    public function comment_users()
    {
    	return $this->belongsTo('App\Models\Users','uid');
    }

    public function comment_Goods()
    {
    	return $this->belongsTo('App\Models\Goods','gid');
    }
}

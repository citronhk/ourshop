<?php

<<<<<<< HEAD
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

=======

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


>>>>>>> origin/dapeng
class orders_infos extends Model
{
    public $table = 'orders_infos';

<<<<<<< HEAD
=======





















>>>>>>> origin/dapeng
     public function users_infos()
    {
    	return $this->hasOne('App\Models\Orders_users','oid');
    }

<<<<<<< HEAD
=======

>>>>>>> origin/dapeng
     public function orders_goods()
    {
    	return $this->belongsTo('App\Models\Goods','gid');
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> origin/dapeng

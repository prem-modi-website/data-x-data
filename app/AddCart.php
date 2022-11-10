<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddCart extends Model
{
    public $table = "add_cart";
    
    public function package()
    {
        return $this->belongsTo('App\Package', 'package_id','id');
    }
}

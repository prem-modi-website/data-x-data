<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public $table = "packages";
    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id','id');
    }
}

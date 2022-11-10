<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $table = "category";
    
    
    public function exceldata()
    {
        return $this->hasMany('App\ExcelData', 'category_id','id');
    }
}

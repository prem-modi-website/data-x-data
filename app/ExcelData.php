<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExcelData extends Model
{
    public $table = "exceldata";
    
    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id','id');
    }
    

}

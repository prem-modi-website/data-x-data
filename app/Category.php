<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BlockNumber;

class Category extends Model
{
    public $table = "category";
    
    
    public function exceldata()
    {
        return $this->hasMany('App\ExcelData', 'category_id','id');
    }
    public static function getCategory()
    {
        return Static::where('is_active',1)->latest()->take(5)->get();
    }
    public static function excelCount($cat_id)
    {
        $blockData = BlockNumber::where('user_id',auth()->user()->id)->pluck('number');       
        return ExcelData::where('category_id',$cat_id)->whereNotIn('contact_number',$blockData)->where('is_active',1)->count();
    }
}

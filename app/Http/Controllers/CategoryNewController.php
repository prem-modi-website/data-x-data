<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Str;

class CategoryNewController extends Controller
{
    public function addCategory()
    {
        return view('category');

    }
    public function storecategory(Request $request)
    {  
        $category =   Category::where('name',$request['catName'])->where('is_active',1)->first();
        if(empty($category))
        {
            $category = new Category();
            $category->name = $request['catName'];
            
            if ($request['catImage'] == "")
            {
                $category->image = "";
            }
            else {
                $photo = $request['catImage'];
                $extension = rand().'.'.$request['catImage']->extension();
            
                $photo->move(public_path('images'), $extension);
                
                $category->image = $extension;
            }
    
            $category->is_active = 1;
            $execute =  $category->save();
            if($execute)
            {
                return response()->json(['status'=>200,'success'=>true,"message"=>"Data save successfully"]);
            }
            else {
                return response()->json(['status'=>500,'success'=>false,"message"=>"Internal server error"]);
            }
        }
        else {
            return response()->json(['status'=>400,'success'=>false,"message"=>"Category already exists"]);    
        }
    }

    public function getCategory()
    {
        $categories = Category::where('is_active',1)->get(['id','name','image']);
        if(!empty($categories))
        {
            $emptyarray = [];
            foreach($categories as $single)
            {
                $singlecategory = [
                    "id" => $single->id,
                    "name" => $single->name,
                    "image" => $single->image
                    
                ];
                array_push($emptyarray,$singlecategory);
            }
            return response()->json(["status"=>200,"success"=>true,"data"=>$emptyarray]); 
        }
        else
        {
            return response()->json(["status"=>200,"success"=>true,"data"=>[]]); 
        }
    }

    public function deleteCategory(Request $request)
    {
        \Log::info($request);
        $category = Category::where('id',$request->category_id)->where('is_active',1)->first();
        if($category)
        {
            $category->is_active  = 0;
            $execute = $category->save();
            if ($execute)
            {
                return response()->json(["status"=>200,"success"=>true,"message"=>"category delete successfully"]); 
            }
            else
            {
                return response()->json(["status"=>500,"success"=>false,"message"=>"Internal server error"]);       
            }
        }
        else
        {
            return response()->json(["status"=>404,"success"=>false,"message"=>"Data not found"]); 
        }
    }

    public function editCategory(Request $request)
    {
        $category = Category::where('id',$request->category_id)->where('is_active',1)->first(['id','name','image']);
        if(!empty($category))
        {
            $singlecategory = [
                "id" => $category->id,
                "name" => $category->name,
                "image" =>$category->image
            ];
            return response()->json(["status"=>200,"success"=>true,"data"=>$singlecategory]); 
        }
        else
        {
            return response()->json(["status"=>404,"success"=>false,"message"=>"Data not found"]); 
        }
    }
    
    public function showCategory()
    {
        $category = Category::where('is_active',1)->get();
        return view('viewCategory',compact('category'));
    }
    
    public function updatecategory(Request $request)
    {
        $category =   Category::where('id',$request['editcatid'])->where('is_active',1)->first();
        if(!empty($category))
        {
            $category->name = $request['editcatName'];
            
            if ($request['editcatImage'] == "")
            {
                $category->image = "";
            }
            else {
                $photo = $request['editcatImage'];
                $extension = rand().'.'.$request['editcatImage']->extension();
            
                $photo->move(public_path('images'), $extension);
                
                $category->image = $extension;
            }
    
            $category->is_active = 1;
            $execute =  $category->update();
            if($execute)
            {
                return response()->json(['status'=>200,'success'=>true,"message"=>"Category update successfully"]);
            }
            else {
                return response()->json(['status'=>500,'success'=>false,"message"=>"Internal server error"]);
            }
        }
        else {
            return response()->json(['status'=>400,'success'=>false,"message"=>"Category Not Found"]);    
        }
    }
}

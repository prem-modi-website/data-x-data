<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Str;

class categoryController extends Controller
{
    public function addCategory(Request $request)
    {
        if(auth()->user())
        {
            $rules = [
                'name'=>'required|unique:category',
                'image'=>'required'
             ];
             
             $messages = [
                'name.required' => 'category name is required',
                'name.unique' => 'unique category is required',
                'image.unique' => 'image is required'
             ];
            
            $validator = \Validator::make($request->all(),$rules, $messages);
            if ($validator->fails()) {
                return response()->json(['sucess' => false,'status' =>'422', 'message' =>$validator->errors()],422);
            }
            else
            {
                $category = new Category();
                $category->name  = $request->name;
                $image = base64_decode($request->image);
                $safeName = Str::random(12).'.'.'png';
                $save  = app()->basePath('public'.'/images/');
                if(!file_exists($save))
                {
                    $mkdir = mkdir($save,0777,true);
                }
                $fileUploaded = file_put_contents($save.$safeName,$image);
                $category->image = $safeName;
                $execute = $category->save();
                if ($execute)
                {
                    return response()->json(["status"=>200,"success"=>true,"message"=>"category add successfully"]); 
                }
                else
                {
                    return response()->json(["status"=>500,"success"=>false,"message"=>"Internal server error"]);       
                }
            }
        }
        else
        {
            return response()->json(['success' => false,'status' =>'401', 'message' =>"unothorized user"]);
        }
    }
    public function getAllCategory(Request $request)
    {
        if(auth()->user())
        {
            $page  = (int)$request->page;
            $countdata = Category::count();
            $pageperrecord = 1;
            $totalpage = ($countdata/$pageperrecord);
            
            if(($page-1) > 0)
            {
                $previouspage = $page-1;
            }
            else
            {
                $previouspage = NULL;
            }
            
            if($page >= $totalpage)
            {
                $nextpage = NULL;
            }
            else
            {
                $nextpage = $page+1;
            }
            
            $offset =  ($page*$pageperrecord)-1;
            
            $categories = Category::skip($offset)->limit($pageperrecord)->get();
            if(!empty($categories))
            {
                $emptyarray = [];
                foreach($categories as $single)
                {
                    $singlecategory = [
                        "id" => $single->id,
                        "name" => $single->name,
                        "image" => env('category_image_url').$single->image
                        
                    ];
                    array_push($emptyarray,$singlecategory);
                }
                $maindata = [
                    "totalPage" => $totalpage,
                    "totalRecords" => $countdata,
                    "previousPage" => $previouspage,
                    "currentPage" => $page,
                    "nextPage" => $nextpage,
                    "data" => $emptyarray
                ];
                return response()->json(["status"=>200,"success"=>true,"data"=>$maindata]); 
            }
            else
            {
                return response()->json(["status"=>200,"success"=>true,"data"=>[]]); 
            }
        }
        else
        {
            return response()->json(['success' => false,'status' =>'401', 'message' =>"unothorized user"]);
        }
    }
    
    public function getSingleCategory(Request $request)
    {
        if(auth()->user())
        {
            $category = Category::where('id',$request->id)->where('is_active',1)->first(['id','name','image']);
            if(!empty($category))
            {
                $singlecategory = [
                    "id" => $category->id,
                    "name" => $category->name,
                    "image" => env('category_image_url').$category->image
                  
                ];
                return response()->json(["status"=>200,"success"=>true,"data"=>$singlecategory]); 
            }
            else
            {
                return response()->json(["status"=>404,"success"=>false,"message"=>"Data not found"]); 
            }
        }
        else
        {
            return response()->json(['success' => false,'status' =>'401', 'message' =>"unothorized user"]);
        }
    }
    public function editCategory(Request $request)
    {
        if(auth()->user())
        {
            $rules = [
                'name'=>'required',
                'image'=>'required'
             ];
             
             $messages = [
                'name.required' => 'category name is required',
                'image.unique' => 'image is required'
             ];
            
            $validator = \Validator::make($request->all(),$rules, $messages);
            if ($validator->fails()) {
                return response()->json(['sucess' => false,'status' =>'422', 'message' =>$validator->errors()],422);
            }
            else
            {
                $category = Category::where('id',$request->id)->where('is_active',1)->first();
                if($category)
                {
                    $category->name  = $request->name;
                    $image = base64_decode($request->image);
                    $safeName = Str::random(12).'.'.'png';
                    $save  = app()->basePath('public'.'/images/');
                    if(!file_exists($save))
                    {
                        $mkdir = mkdir($save,0777,true);
                    }
                    $fileUploaded = file_put_contents($save.$safeName,$image);
                    $date = date('Y-m-d H:i:s');
                    $category->image = $safeName;
                    $category->updated_at = $date;
                    $execute = $category->save();
                    if ($execute)
                    {
                        return response()->json(["status"=>200,"success"=>true,"message"=>"category update successfully"]); 
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
        }
        else
        {
            return response()->json(['success' => false,'status' =>'401', 'message' =>"unothorized user"]);
        }
    }
    
    public function deleteCategory(Request $request)
    {
        if(auth()->user())
        {
            
            $category = Category::where('id',$request->id)->where('is_active',1)->first();
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
        else
        {
            return response()->json(['success' => false,'status' =>'401', 'message' =>"unothorized user"]);
        }
    }
    
    public function recentCategory()
    {
        if(auth()->user())
        {
            $categories = Category::where('is_active',1)->latest('updated_at')->with('exceldata')->get();
            if($categories)
            {
                $emptyarray = [];
                foreach($categories as $single)
                {
                    if($single['exceldata']->isEmpty())
                    {
                            $data = [
                                    "id"=>"",
                                    "catname"=>$single['name'],
                                    "contact_number"=>"",
                                    "pin_code"=>"",
                                    "sector"=>"",
                                    "state"=>"",
                                    "city"=>"",
                                    "country"=>""
                            ];   
                            array_push($emptyarray , $data);
                    }
                    else
                    {
                        foreach($single['exceldata'] as $singlemaindata)
                        {
                             $data = [
                                    "id"=>$singlemaindata['id'],
                                    "catname"=>$single['name'],
                                    "contact_number"=>$singlemaindata['contact_number'],
                                    "pin_code"=>$singlemaindata['pin_code'],
                                    "sector"=>$singlemaindata['sector'],
                                    "state"=>$singlemaindata['state'],
                                    "city"=>$singlemaindata['city'],
                                    "country"=>$singlemaindata['country'],
                                 ];   
                            array_push($emptyarray , $data);
                        }
                    }
                }
                return response()->json(["status"=>200,"success"=>true,"data"=>$emptyarray]); 
            }
            else
            {
                return response()->json(["status"=>404,"success"=>false,"message"=>"Data not found"]); 
            }
        }
        else
        {
            return response()->json(['success' => false,'status' =>'401', 'message' =>"unothorized user"]);
        }
    }
    
    
    public function exportData(Request $request)
    {
        return $request;    
    }
}

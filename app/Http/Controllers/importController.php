<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\Category;
use App\ExcelData;
use App\Imports\UsersImport;

class importController extends Controller
{
    public function importExcelForm()
    {
        return view('excelimport');
    }
    
    public function importExcelFile(Request $request)
    {
        $rules = [
            'catname'=>'required',
            'excelfile'=>'required',
         ];
         
         $messages = [
            'catname.required' => 'category name is required',
            'excelfile.unique' => 'excel file is required',
         ];
        
        $validator = \Validator::make($request->all(),$rules, $messages);
        if ($validator->fails()) {
            return response()->json(['sucess' => false,'status' =>'422', 'message' =>$validator->errors()],422);
        }
        else
        {
            $category = Category::where('name',$request->catname)->first();
            $rows = Excel::toArray(new UsersImport,$request->excelfile);
            
            if(empty($rows))
            {
                return response()->json(['success' => false,'status' =>'404', 'message' =>"data not found"]);
            }
            else
            {
                foreach($rows[0] as $key=>$singledata)
                {
                    $exceldata = new ExcelData();
                    $exceldata->category_id = $category->id;
                    if (isset($singledata['contact_number']))
                    {
                       if ($singledata['contact_number'] == NULL)
                       {
                            $exceldata->contact_number = "";
                       }
                       else
                       {
                            $exceldata->contact_number = $singledata['contact_number'];         
                       }
                    }
                    else
                    {
                             $exceldata->contact_number = "";
                    }
                    
                    if (isset($singledata['pin_code']))
                    {
                       if ($singledata['pin_code'] == NULL)
                       {
                            $exceldata->pin_code = "";
                       }
                       else
                       {
                            $exceldata->pin_code = $singledata['pin_code'];         
                       }
                    }
                    else
                    {
                             $exceldata->pin_code = "";
                    }
                    
                    
                    if (isset($singledata['sector']))
                    {
                       if ($singledata['sector'] == NULL)
                       {
                            $exceldata->sector = "";
                       }
                       else
                       {
                            $exceldata->sector = $singledata['sector'];         
                       }
                    }
                    else
                    {
                             $exceldata->sector = "";
                    }
                    
                    
                    if (isset($singledata['state']))
                    {
                       if ($singledata['state'] == NULL)
                       {
                            $exceldata->state = "";
                       }
                       else
                       {
                            $exceldata->state = $singledata['state'];         
                       }
                    }
                    else
                    {
                             $exceldata->state = "";
                    }
                    
                    
                    if (isset($singledata['city']))
                    {
                       if ($singledata['city'] == NULL)
                       {
                            $exceldata->city = "";
                       }
                       else
                       {
                            $exceldata->city = $singledata['city'];         
                       }
                    }
                    else
                    {
                             $exceldata->city = "";
                    }
                    
                    if (isset($singledata['country']))
                    {
                       if ($singledata['country'] == NULL)
                       {
                            $exceldata->country = "";
                       }
                       else
                       {
                            $exceldata->country = $singledata['country'];         
                       }
                    }
                    else
                    {
                             $exceldata->country = "";
                    }
                    $exceldata->is_active = 1;
                    $execute = $exceldata->save();
                }
                if($execute)
                {
                    return response()->json(['success' => true,'status' => 200 , 'message' =>"data save successfully"]);
                }
                else
                {
                    return response()->json(['success' => false,'status' =>500, 'message' =>"Internal server error"]);
                }
            }
        }
    }
    
    
    public function getExportData()
    {
        $exceldata = ExcelData::where('is_active',1)->get(['id','category_id','contact_number','pin_code','sector','state','city','country']);
        
        $emptydata = [];
        foreach($exceldata as $singledata)
        {
            $singlemaindata = [
                "id" => $singledata->id,
                
                "name" => $singledata->category->name,
                
                "contact_number" => $singledata->contact_number,
                
                "pin_code" => $singledata->pin_code,
                
                "sector" => $singledata->sector,
                
                "state" => $singledata->state,
                "city" => $singledata->city,
                
                "country" => $singledata->country
            ];
            array_push($emptydata , $singlemaindata);
        }
        
        return response()->json(['success' => true,'status' =>200, 'data' =>$emptydata]);
    }
    
    public function getExportDataSerialize(Request $request)
    {
            $page  = (int)$request->page;
            $countdata = ExcelData::count();
            $pageperrecord = 10;
            $totalpage = ceil($countdata/$pageperrecord);
            
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
            
            $offset =  ($page*$pageperrecord)-10;
            
            
        $exceldata = ExcelData::where('is_active',1)->latest('updated_at')->skip($offset)->limit($pageperrecord)->get(['id','category_id','contact_number','pin_code','sector','state','city','country','updated_at']);
        
        $emptydata = [];
        foreach($exceldata as $singledata)
        {
            if(isset($singledata->category->name))
            {
                $dataname = $singledata->category->name;
            }
            else
            {
                $dataname = "";
            }
            $singlemaindata = [
                "id" => $singledata->id,
                "name" => $dataname,
                
                "contact_number" => $singledata->contact_number,
                
                "pin_code" => $singledata->pin_code,
                
                "sector" => $singledata->sector,
                
                "state" => $singledata->state,
                "city" => $singledata->city,
                
                "country" => $singledata->country
            ];
            array_push($emptydata , $singlemaindata);
        }
        $maindata = [
               "previousPage" => $previouspage,
                "currentPage" => $page,
                "nextPage" => $nextpage, 
                "totalPages" =>$totalpage,
                "totalRecords" => $countdata,
               "data" => $emptydata
            ];
        return response()->json(['success' => true,'status' =>200, 'data' =>$maindata]);
    }
    
    public function deleteExportData(Request $request)
    {
        $exceldata = ExcelData::where('id',$request->id)->where('is_active',1)->first();
        if($exceldata)
        {
            $exceldata->is_active = 0;
            $exceldata->update();
            return response()->json(['success' => true,'status' =>200, 'data' =>'data delete successfully']);
        }
        else
        {
            return response()->json(['success' => false,'status' =>404, 'data' =>'data not found']);
        }
    }
    public function singleExportView(Request $request)
    {
        $exceldata = ExcelData::where('is_active',1)->where('id',$request->id)->first(['id','category_id','contact_number','pin_code','sector','state','city','country']);
        if($exceldata)
        {
            $emptydata = [];
            $singlemaindata = [
                "id" => $exceldata->id,
                
                "name" => $exceldata->category->name,
                
                "contact_number" => $exceldata->contact_number,
                
                "pin_code" => $exceldata->pin_code,
                
                "sector" => $exceldata->sector,
                
                "state" => $exceldata->state,
                "city" => $exceldata->city,
                
                "country" => $exceldata->country
            ];
            array_push($emptydata , $singlemaindata);
            return response()->json(['success' => true,'status' =>200, 'data' =>$emptydata]);
        }
        else
        {
            return response()->json(['success' => false,'status' =>404, 'message' =>"Data Not Found"]);
        }
    }
    
    //update singleexportdata
    public function updateExportView(Request $request)
    {
        $rules = [
            "id"=>"required",
            'catname'=>'required',
            'mobile_number'=>'required',
         ];
         
         $messages = [
             'id.required' => "id is required",
            'catname.required' => 'category name is required',
            'mobile_number.required' => 'mobile number is required',
         ];
        
        $validator = \Validator::make($request->all(),$rules, $messages);
        if ($validator->fails()) {
            return response()->json(['sucess' => false,'status' =>'422', 'message' =>$validator->errors()],422);
        }
        else
        {
            $exceldata = ExcelData::where('id',$request->id)->where('is_active',1)->first();
            if ($exceldata)
            {
                $category = Category::where('name',$request->catname)->first();
                if($category)
                {
                    $exceldata->category_id = $category->id;
                    $exceldata->contact_number = $request->mobile_number;
                    $execute = $exceldata->update();
                    if ($execute)
                    {
                        return response()->json(['success' => true,'status' =>200, 'message' =>"Data save successfully"]);
                    }
                    else
                    {
                        return response()->json(['success' => false,'status' =>500, 'message' =>"Internal server error"]);
                    }
                }
                else
                {
                    return response()->json(['success' => false,'status' =>404, 'message' =>"Data Not Found"]);
                }

            }
            else
            {
                return response()->json(['success' => false,'status' =>404, 'message' =>"Data Not Found"]);
            }

        }
    }
    
    public function searchData(Request $request)
    {
       $exceldata =  ExcelData::with('category')->whereHas('category', function($q) use($request)
                        {
                            $q->where('name', 'like', '%'.$request->searchkey.'%');
                    
                        })->orWhere('contact_number', 'LIKE', '%'.$request->searchkey.'%')->orWhere('country', 'LIKE', '%'.$request->searchkey.'%')->orWhere('state', 'LIKE', '%'.$request->searchkey.'%')->orWhere('city', 'LIKE', '%'.$request->searchkey.'%')->orWhere('sector', 'LIKE', '%'.$request->searchkey.'%')->orWhere('pin_code', 'LIKE', '%'.$request->searchkey.'%')->get(['id','category_id','contact_number','pin_code','sector','state','city','country']);
        
        if($exceldata)
        {
            $data = [];
    
            foreach($exceldata as $singledata)
            {
                $singlemaindata = [
                        "id" => $singledata->id,
                        "name" =>  $singledata->category->name,
                        "contact_number"=>$singledata->contact_number,
                        "pin_code"=>$singledata->pin_code,
                        "sector"=>$singledata->sector,
                        "state"=>$singledata->state,
                        "city"=>$singledata->city,
                        "country"=>$singledata->country
                    ];
                    
                    array_push($data,$singlemaindata);
            }
            
            return response()->json(['success' => true,'status' =>200, 'data' =>$data]);
        }
        else
        {
            return response()->json(['success' => true,'status' =>200, 'data' => []]);
        }
    }
}

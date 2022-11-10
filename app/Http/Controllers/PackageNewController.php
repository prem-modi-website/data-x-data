<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Package;
use Excel;
use App\ExcelData;
use App\Imports\UsersImport;

class PackageNewController extends Controller
{
    public function addPackage(Request $request)
    {
        $data = Category::all();
        return view('addPackage',compact('data'));
    }
    public function packageStore(Request $request)
    {
        $category = Category::where('is_active',1)->get();
        
        $packagedata = Package::where('is_active',1)->where('package_count',$request['pacakge_count'])->where('package_amount',$request['packge_amount'])->get();
        
        foreach ($packagedata as $singlepackagedata)
        {
            $singlepackagedata->is_active = 0;
            $execute = $singlepackagedata->update();
        }
        
        $token = rand();
        foreach ($category as $singlecategory)
        {
            $package = new Package();
            $package->category_id = $singlecategory['id'];
            $package->category_token = $token;
            $package->package_count = $request['pacakge_count'];
            $package->package_amount = $request['packge_amount'];
            $package->is_active = 1;
            $execute = $package->save();
        }
            
        if($execute)
        {
            return response()->json(['success' => true,'status' =>200, 'message' =>"package save successfully"]);
        }
        else
        {
            return response()->json(['success' => false,'status' =>500, 'message' =>"Internal server error"]);
        }
    }

    public function getPackage()
    {
        $packagedata = Package::where('is_active',1)->get(['id','category_id','package_amount','package_count']);
        
        	$packagedata = $packagedata->unique(function ($item) {
                            return $item['package_amount'].$item['package_count'];
                        });
        if($packagedata)
        {
            $emptydata = [];
            foreach($packagedata as $singledata)
            {
                $singlemaindata = [
                    "id" => $singledata->id,
                    
                    "name" => $singledata->category->name,
                    
                    "category_token" => $singledata->category_token,
                    
                    "package_amount" => $singledata->package_amount,
                    
                    "package_count" => $singledata->package_count
                ];
                array_push($emptydata , $singlemaindata);
            }
            return response()->json(['success' => true,'status' =>200, 'data' =>$emptydata]);
        }
        else
        {
            return response()->json(['success' => false,'status' =>404, 'data' =>"Data not found"]);
        }
    }

    public function deletePackage(Request $request)
    {
        $explode = explode('_',$request->package_id);
        $packagedata = Package::where('is_active',1)->where('package_count',$explode[0])->where('package_amount',$explode[1])->get();
        
        foreach ($packagedata as $singlepackagedata)
        {
            $singlepackagedata->is_active = 0;
            $execute = $singlepackagedata->update();
        }
        
        if($execute)
        {
            return response()->json(['success' => true,'status' =>200, 'data' =>'data delete successfully']);
        }
        else
        {
            return response()->json(['success' => false,'status' =>404, 'data' =>'data not found']);
        }
    }

    public function addsinglePackage(Request $request)
    {
        $packagedata = Package::where('is_active',1)->where('id',$request->package_id)->first(['id','category_id','category_token','package_amount','package_count']);
        
        if($packagedata)
        {
            $emptydata = [];
            $singlemaindata = [
                "id" => $packagedata->id,
                
                "name" => $packagedata->category->name,
                
                "category_token" => $packagedata->category_token,
                
                "package_amount" => $packagedata->package_amount,
                
                "package_count" => $packagedata->package_count
            ];
                array_push($emptydata , $singlemaindata);
            
            $category = Category::all();

            return response()->json(['success' => true,'status' =>200, 'data' =>[$emptydata,$category]]);
        }
        else
        {
            
        return response()->json(['success' => false,'status' =>404, 'data' =>"Data not found"]);
        }
    }
    
    public function showPackage()
    {
        $package =Package::where('is_active',1)->get();
        
        	$packagedata = $package->unique(function ($item) {
                            return $item['package_amount'].$item['package_count'];
                        });
        return view('viewPackage',compact('packagedata'));
    }
    
    public function editpackagestore(Request $request)
    {
        $category = Category::where('is_active',1)->get();
        
        $packagedata = Package::where('is_active',1)->where('category_token',$request['inputpackageid'])->get();
        
        foreach ($packagedata as $singlepackagedata)
        {
            $singlepackagedata->package_count = $request['pacakge_count'];
            $singlepackagedata->package_amount = $request['packge_amount'];
            $singlepackagedata->is_active = 1;
            $execute = $singlepackagedata->update();
        }
            
        if($execute)
        {
            return response()->json(['success' => true,'status' =>200, 'message' =>"package save successfully"]);
        }
        else
        {
            return response()->json(['success' => false,'status' =>500, 'message' =>"Internal server error"]);
        }
    }
    
    public function addFormData()
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
        $category = Category::where('is_active',1)->get();
        return view('addDataForm',compact('category','emptydata'));
    }
    
    public function excelexportdata(Request $request)
    {
            $rows = Excel::toArray(new UsersImport,$request->excelfile);
        
            $category = Category::where('id',$request->catname)->first();
            if(empty($category))
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
                    return redirect()->route('addFormData');
                }
                else
                {
                    return redirect()->route('addFormData');
                }
            }
    }
    
}

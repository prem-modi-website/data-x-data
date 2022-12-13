<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\ExcelData;
use App\BlockNumber;
use App\Package;
use App\Exports\DataExport;
use Excel;
use Auth;

class HomeController extends Controller
{    
    public function index()
    {
        $categories = Category::where('is_active',1)->get();
        $packages = Package::where('is_active',1)->groupBy('package_amount')->get();
        return view('frontend.index',compact('categories','packages'));
        
    }
    public function about()
    {
        return view('frontend.about');
        
    }
    public function completeOrder()
    {
        return view('frontend.order_complete');
        
    }
    public function contact()
    {
        return view('frontend.contact');
    }
    public function privacyPolicy()
    {
        return view('frontend.privacy_policy');
    }
    public function termAndCondition()
    {
        return view('frontend.terms_condition');
    }
    public function packages()
    {
        $packages = Package::where('is_active',1)->groupBy('package_amount')->get();        
    
        return view('frontend.packages',compact('packages'));
    }
    public function excelCategory($id)
    {
        $finalArary = [];
        $categories = Category::where('id',$id)->where('is_active',1)->first();
        $ExcelData = ExcelData::where('category_id',$categories->id)->take(10)->get();
        foreach($ExcelData as $d)
        {
           
            $arr = [
                'category_name'=>$categories->name,
                'contact_number' => $d->contact_number,
                'pin_code'  => $d->pin_code,
                'sector'=> $d->sector,
                'city'=> $d->city,
                'country'=> $d->country,
            ];
            $finalArary[] = $arr;
        }
        return Excel::download(new DataExport($finalArary), 'excelData.xlsx');
    }
    public function getCategory(Request $request)
    {
       
        if($request->has('search'))
        {
            $emptyArry = [];
            $name = $request->search;
            $getCategory = Category::where('name','like','%'. $name .'%')->pluck('id');
            foreach($getCategory as $cat)
            {
                array_push($emptyArry,$cat);
            }
            $excelData = ExcelData::where(function($query) use ($name){
                        $query->where('exceldata.contact_number', 'like', '%'.$name.'%');
                        $query->orWhere('exceldata.pin_code', 'like', '%'.$name.'%');
                        $query->orWhere('exceldata.city', 'like', '%'.$name.'%');
                        $query->orWhere('exceldata.country', 'like', '%'.$name.'%');
                    })->pluck('category_id');
            foreach($excelData as $exc)
            {
                array_push($emptyArry,$exc);
            }
            $categories = Category::whereIn('id',$emptyArry)->where('is_active',1)->get();
        }
        else
        {

            $categories = Category::where('is_active',1)->get();
        }

        return view('frontend.category',compact('categories'));
    }
    public function blockData(Request $request)
    {
        \Log::info($request->all());
        if(auth()->user())
        {
            if(auth()->user()->is_active == 1)
            {
                $excelData = ExcelData::where('contact_number',$request->number)->get();
                \Log::info($excelData);
                if(!$excelData->isEmpty())
                {

                    $data = new BlockNumber;
                    $data->user_id = auth()->user()->id;
                    $data->number = $request->number;
                    $data->save();
                    return response()->json(['message'=>'Number Block Successfully'],200);
                }
            }
        }else
        {
            return response()->json(['message'=>'you are unauthorized.'],401);

        }
    }
}

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
        $states = ExcelData::groupBy('state')->get();
        $cities = ExcelData::groupBy('city')->get();
        $pincodes = ExcelData::groupBy('pin_code')->get();
        $countries = ExcelData::groupBy('country')->get();
        $packages = Package::where('is_active',1)->groupBy('package_amount')->get();
        return view('frontend.index',compact('categories','packages','states','cities','countries','pincodes'));
        
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
        $emptyArry = [];
        if(isset($request->category))
        {
            
            $getCategory = Category::where('name','like','%'. $request->category .'%')->pluck('id');
            foreach($getCategory as $cat)
            {
                array_push($emptyArry,$cat);
            }

            $excelData = ExcelData::where(function($query) use ($request){
                        if(isset($request->state))
                        {
                            $query->where('exceldata.state', 'like', '%'.$request->state.'%');
                        }
                        elseif(isset($request->city))
                        {
                            $query->where('exceldata.city', 'like', '%'.$request->city.'%');
                        }
                        elseif(isset($request->country))
                        {
                            $query->where('exceldata.country', 'like', '%'.$request->country.'%');
                        }
                        elseif(isset($request->pincode))
                        {
                            $query->where('exceldata.pincode', 'like', '%'.$request->pincode.'%');
                        }
                        
                    })->pluck('category_id');
            foreach($excelData as $exc)
            {
                array_push($emptyArry,$exc);
            }
            $categories = Category::whereIn('id',$emptyArry)->where('is_active',1)->get();
        }else{
            
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
                    $basic  = new \Vonage\Client\Credentials\Basic("9d98d065", "DAQklEeTN6hNzgCR");
                    $client = new \Vonage\Client($basic);
                    $response = $client->sms()->send(
                        new \Vonage\SMS\Message\SMS("91".$request->number, BRAND_NAME, 'Your number is block')
                    );
                    
                    $message = $response->current();
                    \Log::info("in");
                    \Log::info($message->getStatus());
                    if ($message->getStatus() == 0) {
                        // echo "The message was sent successfully\n";
                        return response()->json(['message'=>'Number Block Successfully'],200);
                    } else {
                        return response()->json(['message'=>$message->getStatus()],509);
                        echo "The message failed with status: " . $message->getStatus() . "\n";
                    }
                }
               
                    
            
                    
            }
        }else
        {
            return response()->json(['message'=>'you are unauthorized.'],401);

        }
    }
}

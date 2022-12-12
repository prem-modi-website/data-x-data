<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ExcelData;
use App\AddCart;
use App\BillingDetails;
use App\OrderDetails;
use App\Package;
use DB;
use Log;
use Validator;
use Session;
use Auth;

class OrderController extends Controller
{
    //
    public function addToCart(Request $request)
    {
        try{
            if(!auth()->user())
            {
                if(auth()->user()->is_active == 1)
                {

                    return response()->json(['message'=> 'you are unauthorized'],401);
                }else{
                    Auth::logout();
                }

            }
            DB::beginTransaction();
            if($request->has('package_id'))
            {
                $package = Package::where('id',$request->package_id)->where('is_active',1)->first();

            }else
            {

                $excelCount = ExcelData::where('category_id',$request->category_id)->where('is_active',1)->count();
                if($excelCount == 0)
                {
                    return response()->json(['message'=> 'Packages Not available.'],422);
    
                }
                if($request->qty > $excelCount)
                {
                    return response()->json(['message'=> 'Please Limited package Available.'],422);
                }                
                elseif($request->qty < 5000)
                {
                    Log::info("else ");
    
                    $package = Package::where('category_id',$request->category_id)->where('is_active',1)->where('package_amount',500)->first();
                }elseif($request->qty < 10000)
                {
                    Log::info("else 4");
    
                    $package = Package::where('category_id',$request->category_id)->where('is_active',1)->where('package_amount',1000)->first();
                }
                elseif($request->qty < 15000)
                {
                    Log::info("else 3");
    
                    $package = Package::where('category_id',$request->category_id)->where('is_active',1)->where('package_amount',1500)->first();
                   
                }elseif($request->qty < 20000)
                {
                    Log::info("else 3");
    
                    $package = Package::where('category_id',$request->category_id)->where('is_active',1)->where('package_amount',2000)->first();
                   
                }elseif($request->qty < 25000)
                {
                    Log::info("else 5");
    
                    $package = Package::where('category_id',$request->category_id)->where('is_active',1)->where('package_amount',2500)->first();
                
                }elseif($request->qty < 30000)
                {
                    Log::info("else 6");
    
                    $package = Package::where('category_id',$request->category_id)->where('is_active',1)->where('package_amount',3000)->first();
                }
                if(is_null($package))
                {
                    $package = Package::where('category_id',$request->category_id)->where('is_active',1)->first();

                }
            }
            Log::info('package');
            Log::info($package);
            
            $addtoCart =  AddCart::where('user_id',auth()->user()->id)/* ->where('category_id',$request->category_id) *//* ->where('package_id',$package->id) */->where('is_active',1)->first();
            \Log::info('addtoCart');
            \Log::info($addtoCart);
            // $addtoCart =  AddCart::where('user_id',auth()->user()->id)->where('category_id',$request->category_id)->where('package_id',$package->id)->first();
            if(is_null($addtoCart))
            {
                $cart = new AddCart;
                $cart->package_id = $package->id;
                $cart->user_id = auth()->user()->id;
                $cart->qty = $request->qty;
                $cart->category_id = $package->category_id;
                $cart->is_active = 1;
                $executeQuery= $cart->save();
                if(! $executeQuery)
                {
                 DB::rollback();

                    return response()->json(['message' => 'Inernal server error please try again later.'],500);
                }

                
            }else
            {

                $addtoCart->package_id = $package->id;
                $addtoCart->category_id = $package->category_id;
                $addtoCart->qty = $request->qty;
                $executeQuery= $addtoCart->update();
                if(! $executeQuery)
                {
                    DB::rollback();
    
                    return response()->json(['message' => 'Inernal server error please try again later.'],500);
                }
            }
            DB::commit();
            return response()->json(['message'=>'Package qty save successfully.'],200);
            \Log::info($package);
            \Log::info('else');
            return $excelCount;
        } 
        catch(\Exception\Database\QueryException $e)
        {
            Log::info('Query: '.$e->getSql());
            Log::info('Error: Bindings: '.$e->getBindings());
            Log::info('Error: Code: '.$e->getCode());
            Log::info('Error: Message: '.$e->getMessage());
            DB::rollback();
            
            return response()->json(['message' => 'Inernal server error please try again later.'],500);

        }
        catch(\Exception $e)
        {
            Log::info('Error: Code: '.$e->getCode());
            Log::info('Error: Message: '.$e->getMessage());
            DB::rollback();
            return response()->json(['message' => 'Inernal server error please try again later.'],500);

        }
        
    }

    public function cart()
    {
        if(auth()->user()->is_active == 1)
        {

            $products = AddCart::where('is_active',1)->where('user_id',auth()->user()->id)->get();
            $count = 0;
            if($products->isEmpty())
            {
                return view('frontend.cart',compact('products','count'));
            }
            foreach($products as $product)
            {
                $package = Package::where('id',$product->package_id)->first();
                $count += $package->package_amount;
            }
            return view('frontend.cart',compact('products','count'));
        }
        else
        {
           
                Auth::logout();
            
            return redirect()->route('customer-login');
        }
        # code...
    }
    public function getProduct()
    {
        if(!auth()->user())
        {
            return redirect()->route('customer-login');
        }
        if(auth()->user()->is_active == 1)
        {

            $products = AddCart::where('is_active',1)->where('user_id',auth()->user()->id)->get();
            $count = 0;

            // if($products->isEmpty())
            // {
            //     return response()->json(['message' => 'Bad Request'],400);

            // }
            $count = 0;
            foreach($products as $product)
            {
                $package = Package::where('id',$product->package_id)->first();
                $count += $package->package_amount;
            }
            $html = view('frontend.header_cart',compact('products','count'))->render();

            return response()->json(['html'=>$html],200);
        }
        else
        {
            
            Auth::logout();

            return response()->json(['message' => 'You are unauthorized'],401);

        }
        # code...
    }
    public function removeProduct(Request $request)
    {
        if(!auth()->user())
        {
            return response()->json(['message' => 'You are unauthorized'],401);
        }
        if(auth()->user()->is_active == 1)
        {

            $product = AddCart::where('id',$request->id)->where('is_active',1)->where('user_id',auth()->user()->id)->first();
            if(is_null($product))
            {
                return response()->json(['message' => 'Bad Request'],400);

            }
            $product->is_active = 0;
            $executeQuery = $product->update();
            $count = 0;
            $products = AddCart::where('is_active',1)->where('user_id',auth()->user()->id)->get();
            if($products->isEmpty())
            {
                return response()->json(['message' => 'Bad Request'],400);

            }
            foreach($products as $product)
            {
                $package = Package::where('id',$product->package_id)->first();
                $count += $package->package_amount;
            }
            // $html = view('frontend.header_cart',compact('products','count'))->render();

            return response()->json(['count'=>$count],200);
        }
        else
        {
            Auth::logout();

            return response()->json(['message' => 'You are unauthorized'],401);

        }
        # code...
    }

    public function checkout(Type $var = null)
    {
        if(!auth()->user())
        {
            return redirect()->route('customer-login');
        }
        if(auth()->user()->is_active == 1)
        {
            $products = AddCart::where('is_active',1)->where('user_id',auth()->user()->id)->get();
            if($products->isEmpty())
            {
                return redirect()->back();

                return response()->json(['message' => 'Bad Request'],400);

            }
            $count = 0;
            foreach($products as $product)
            {
                $package = Package::where('id',$product->package_id)->first();
                $count += $package->package_amount;
            }
            return view('frontend.checkout',compact('count','products'));
        }
        else
        {
            Auth::logout();

            return redirect()->route('customer-login');
        }
    }

    public function customerOrder(Request $request)
    {
        if(!auth()->user())
        {
            return redirect()->route('customer-login');
        }
        if(!auth()->user()->is_active == 1)
        {
            Auth::logout();
            return redirect()->route('customer-login');
        }
        $rules = [
            "firstname" => 'required',
            "lastname" => 'required',
            "email" => 'required',
            "phone" => 'required',
            "company_name" => 'required',
            "country" => 'required',
            "address1" => 'required',
            "address2" => 'required',
            "state" => 'required',
            "city" => 'required',
            "postalcode" => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors());
        }
        try
        {
            DB::beginTransaction();

            $billing_details = new BillingDetails;
            $billing_details->user_id = auth()->user()->id;
            $billing_details->firstname = $request->firstname;
            $billing_details->lastname = $request->lastname;
            $billing_details->token = \Str::uuid();
            $billing_details->email = $request->email;
            $billing_details->phone = $request->phone;
            $billing_details->company_name = $request->company_name;
            $billing_details->country = $request->country;
            $billing_details->address1 = $request->address1;
            $billing_details->address2 = $request->address2;
            $billing_details->state = $request->state;
            $billing_details->city = $request->city;
            $billing_details->status= 1;
            $billing_details->postalcode = $request->postalcode;
    
            $executeQuery = $billing_details->save();
            if(! $executeQuery)
            {
                DB::rollback();

                return response()->json(['message' => 'Inernal server error please try again later.'],500);
            }
            $addtoCart = AddCart::where('user_id',auth()->user()->id)->where('is_active',1)->first();
            $order = new OrderDetails;
            $order->user_id = auth()->user()->id;
            $order->qty = $addtoCart->qty;
            $order->package_id = $addtoCart->package_id;
            $order->is_active = 1;
            $order->token = \Str::uuid();
            $executeQuery = $order->save();
            if(! $executeQuery)
            {
                DB::rollback();

                return response()->json(['message' => 'Inernal server error please try again later.'],500);
            }
            
            DB::commit();
            return redirect()->route('razorpay');
            Session::flash('success','Data Save Successfully');
            return redirect()->back();
        }
        catch(\Exception\Database\QueryException $e)
        {
            Log::info('Query: '.$e->getSql());
            Log::info('Error: Bindings: '.$e->getBindings());
            Log::info('Error: Code: '.$e->getCode());
            Log::info('Error: Message: '.$e->getMessage());
            DB::rollback();
            
            Session::flash('error','Internal server error.Please try again later');
            return redirect()->back();

        }
        catch(\Exception $e)
        {
            Log::info('Error: Code: '.$e->getCode());
            Log::info('Error: Message: '.$e->getMessage());
            DB::rollback();
            Session::flash('error','Internal server error.Please try again later');
            return redirect()->back();

        }
    }
}

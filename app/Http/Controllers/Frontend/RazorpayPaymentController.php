<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;
use Exception;
use App\AddCart;
use App\PaymentDetails;
use App\Package;

class RazorpayPaymentController extends Controller
{
    public function index()
    {   if(!auth()->user())
        {
            return redirect()->route('customer-login');

        }     
        if(auth()->user()->is_active == 1)
        {

            $addToCart = AddCart::where('user_id',auth()->user()->id)->where('is_active',1)->first();
            $package = Package::where('id',$addToCart->package_id)->where('is_active',1)->first();
    
            return view('frontend.razorpayView',compact('package'));
        }
        else
        {
            return redirect()->route('customer-login');
        }
    }

    public function store(Request $request)
    {
        $input = $request->all();
  
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
  
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
  
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 
            } catch (Exception $e) {
                return  $e->getMessage();
                Session::flash('error',$e->getMessage());
                return redirect()->back();
            }
        }
        $addtoCart = AddCart::where('user_id',auth()->user()->id)->where('is_active',1)->first();

        $addtoCart->is_active = 0;
        $executeQuery = $addtoCart->update();
        if(! $executeQuery)
        {
            Session::flash('error','Inernal server error please try again later.');
           
            return redirect()->back();
        }
        $payment = new PaymentDetails;
        $payment->token = $response->id;
        $payment->payment_method = 'RazorPay';
        $payment->payment_status = 1;
        $payment->user_id = auth()->user()->id;
        $payment->save();
        // Session::flash('success', 'Payment successful');
        return redirect()->route('completeOrder');
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Exports\ExportData;
use App\ExcelData;
use Maatwebsite\Excel\Facades\Excel;
use Session;
use App\OrderDetails;
use Exception;
use App\AddCart;
use App\PaymentDetails;
use App\Package;
use Auth;

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
            Auth::logout();
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
        $orderDetail = OrderDetails::where('package_id',$addtoCart->package_id)->where('user_id',auth()->user()->id)->where('is_active',1)->first();
        
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
        $payment->order_id = $orderDetail->id;
        $payment->user_id = auth()->user()->id;
        $executeQueryPayemnt= $payment->save();
        if(! $executeQueryPayemnt)
        {
            Session::flash('error','Inernal server error please try again later.');
           
            return redirect()->back();
        }

        $orderDetail->is_active = 0;

        $executeQueryorder= $orderDetail->update();
        if(! $executeQueryorder)
        {
            Session::flash('error','Inernal server error please try again later.');
           
            return redirect()->back();
        }

        $data = ExcelData::where('category_id',$addtoCart->category_id)->where('is_active',1)->take($addtoCart->qty)->get(["category_id", "contact_number", "pin_code","sector","city","country"]);
        $time = time().rand();
        Excel::store(new ExportData($data), 'excel/'.$time.'.xlsx','real_public');
        $pdfFilePath = public_path() . "/excel/" . $time.'.xlsx';
        $details = [
            "email" => auth()->user()->email,            
            "document" => $pdfFilePath,
        ];
        \Mail::to(auth()->user()->email)->send(new \App\Mail\OrerDone($details));
        $dataExcel = ExcelData::where('category_id',$addtoCart->category_id)->where('is_active',1)->take($addtoCart->qty)->get();

        foreach($dataExcel as $d)
        {
            $d->is_active = 0;
            $d->update();
        }
        // Session::flash('success', 'Payment successful');
        return redirect()->route('completeOrder');
    }
}

<?php

namespace App\Http\Controllers;
use App\Category;
use App\Package;
use App\Role;
use App\AddCart;
use App\OrderDetails;
use App\PaymentDetails;
use App\BillingDetails;
use App\ExcelData;
use PHPMailer\PHPMailer\PHPMailer;  
use PHPMailer\PHPMailer\Exception;
use Illuminate\Http\Request;
use App\Exports\UsersExport;

class pacakgeController extends Controller
{
    public function packageData(Request $request)
    {
        $rules = [
            'catname'=>'required',
            'package_count'=>'required',
            'package_amount'=>'required',
         ];
         
         $messages = [
            'catname.required' => 'category name is required',
            'package_count.required' => 'package count is required',
            'package_amount.required' => 'package amount is required'
         ];
        
        $validator = \Validator::make($request->all(),$rules, $messages);
        if ($validator->fails()) {
            return response()->json(['sucess' => false,'status' =>'422', 'message' =>$validator->errors()],422);
        }
        else
        {
            
            $category = Category::where('name',$request->catname)->first();
            if ($category)
            {
                $package = new Package();
                $package->category_id = $category->id;
                $package->package_count = $request->package_count;
                $package->package_amount = $request->package_amount;
                $package->is_active =1;
                $execute = $package->save();
                if($execute)
                {
                    return response()->json(['success' => true,'status' =>200, 'message' =>"package save successfully"]);
                }
                else
                {
                    return response()->json(['success' => false,'status' =>500, 'message' =>"Internal server error"]);
                }
            }
            else
            {
                return response()->json(['success' => false,'status' =>404, 'message' =>"Data not found"]);
            }
        }
    }
    
    public function deletePacakgeData(Request $request)
    {
        $packagedata = Package::where('id',$request->id)->where('is_active',1)->first();
        if($packagedata)
        {
            $packagedata->is_active = 0;
            $packagedata->update();
            return response()->json(['success' => true,'status' =>200, 'data' =>'data delete successfully']);
        }
        else
        {
            return response()->json(['success' => false,'status' =>404, 'data' =>'data not found']);
        }
    }
    
    public function getPackageData()
    {
        $packagedata = Package::where('is_active',1)->get(['id','category_id','package_amount','package_count']);
        
        
        if($packagedata)
        {
        $emptydata = [];
        foreach($packagedata as $singledata)
        {
            $singlemaindata = [
                "id" => $singledata->id,
                
                "name" => $singledata->category->name,
                
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
    
    
    public function getSinglePackageData(Request $request)
    {
        $packagedata = Package::where('is_active',1)->where('id',$request->id)->first(['id','category_id','package_amount','package_count']);
        
        if($packagedata)
        {
            
        
        $emptydata = [];
        $singlemaindata = [
            "id" => $packagedata->id,
            
            "name" => $packagedata->category->name,
            
            "package_amount" => $packagedata->package_amount,
            
            "package_count" => $packagedata->package_count
        ];
            array_push($emptydata , $singlemaindata);
        
        
        return response()->json(['success' => true,'status' =>200, 'data' =>$emptydata]);
        }
        else
        {
            
        return response()->json(['success' => false,'status' =>404, 'data' =>"Data not found"]);
        }
    }
    
    
    //update packagedata
    public function updatePackageData(Request $request)
    {
        $rules = [
            'catname'=>'required',
            'package_count'=>'required',
            'package_amount'=>'required'
         ];
         
         $messages = [
             'catname.required' => "catname is required",
            'package_count.required' => 'package count is required',
            'package_amount.required' => 'package amount is required',
         ];
        
        $validator = \Validator::make($request->all(),$rules, $messages);
        if ($validator->fails()) {
            return response()->json(['sucess' => false,'status' =>'422', 'message' =>$validator->errors()],422);
        }
        else
        {
            $exceldata = Package::where('id',$request->id)->where('is_active',1)->first();
            if ($exceldata)
            {
                $category = Category::where('name',$request->catname)->first();
                if($category)
                {
                    $exceldata->category_id = $category->id;
                    $exceldata->package_count = $request->package_count;
                    $exceldata->package_amount = $request->package_amount;
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
    
    public function createBlock(Request $request)
    {
        $blacklist = ExcelData::where('contact_number',$request->contact)->where('is_active',1)->first();
        if($blacklist)
        {
            $blacklist->is_active = 0;
            $execute = $blacklist->update();
            if($execute)
            {
                return response()->json(['success' => true,'status' =>200, 'message' =>"Block list created"]);
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
    
    public function unBlock(Request $request)
    {
        $blacklist = ExcelData::where('contact_number',$request->contact)->where('is_active',0)->first();
        if($blacklist)
        {
            $blacklist->is_active = 1;
            $execute = $blacklist->update();
            if($execute)
            {
                return response()->json(['success' => true,'status' =>200, 'message' =>"contact number unBlocked"]);
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
    
    public function getBlock()
    {
        $exceldata = ExcelData::where('is_active',0)->get(['id','category_id','contact_number']);
        if($exceldata)
        {
            $emptydata = [];
            foreach($exceldata as $singleexceldata)
            {
                $singlemaindata = [
                    "id" => $singleexceldata->id,
                    
                    "name" => $singleexceldata->category->name,
                    
                    "contact_number" => $singleexceldata->contact_number,
                ];
                array_push($emptydata , $singlemaindata);
            }
            return response()->json(['success' => true,'status' =>200, 'data' =>$emptydata]);
        }
        else
        {
            return response()->json(['success' => false,'status' =>404, 'message' =>"Data Not Found"]);
        }
    }
    
    public function addCart(Request $request)
    {
      if(auth()->user())
      {
          if(auth()->user()->role->name == "User")
          {
              $category = Category::where('id',$request->category_id)->first();
              if(empty($category))
              {
                  return response()->json(['success' => false,'status' =>404, 'data' => "Category not found"]);  
              }
             
             $price = $request->qty;
             if($price < 5000)
             {
                 $price = 500;
             }
             elseif($price < 10000)
             {
                 $price = 1000;
             }
             elseif($price < 15000)
             {
                 $price = 1500;
             }
             elseif($price < 20000)
             {
                 $price = 2000;
             }
             elseif($price < 25000)
             {
                 $price = 2500;
             }
             elseif($price < 30000)
             {
                 $price = 3000;
             }
             
             $category = Package::where('category_id',$request->category_id)->where('package_amount',$price)->first();
             
             $addcartdata = AddCart::where('user_id',auth()->user()->id)->where('category_id',$request->category_id)->first();
             if(empty($addcartdata))
             {
                 $addcart = new AddCart();
                 $addcart->user_id = auth()->user()->id;
                 $addcart->qty = $request->qty;
                 $addcart->package_id = $category->id;
                 $addcart->category_id = $request->category_id;
                 $addcart->is_active = 1;
                 $execute = $addcart->save();
             }
             else
             {
                 $addcartdata->package_id = $category->id;
                 $addcartdata->qty = $request->qty;
                 $execute = $addcartdata->update(); 
             }
             
             if($execute)
             {
                return response()->json(['success' => true,'status' =>200, 'data' => "Cart item add successfully"]);
             }
             else
             {
                return response()->json(['success' => false,'status' =>500, 'data' => "Internal server error"]);  
             }
          }
          else
          {
              return response()->json(['success' => false,'status' =>401, 'message' =>"Unothorized user"]);
          }
      }
      else
      {
            return response()->json(['success' => false,'status' =>401, 'message' =>"Unothorized user"]);
      }
    }
    
    public function cartItem(Request $request)
    {
        if(auth()->user())
        {
          if(auth()->user()->role->name == "User")
          {
              $addcart = AddCart::where('user_id',auth()->user()->id)->where('is_active',1)->get();
              if(!$addcart->isEmpty())
              {
                  $data = [];
                  $count = 0 ;
                  foreach($addcart as $singleadd)
                  {
                      $count = $count + $singleadd->package->package_amount;
                      $singlemaindata = [
                             "id"=>$singleadd->id,
                             "package_count"=>$singleadd->qty,
                             "package_amount"=>$singleadd->package->package_amount,
                             "category_name"=>$singleadd->package->category->name,
                          ];
                          array_push($data,$singlemaindata);
                  }
                  $datamaindata = [
                            "data" => $data,
                            "subtotal" =>$count,
                            "total"=>$count
                      ]; 
                return response()->json(['success' => true,'status' =>200, 'data' =>$datamaindata]);  
              }
              else
              {
                  return response()->json(['success' => false,'status' =>404, 'data' =>[]]);  
              }
          }
          else
          {
                return response()->json(['success' => false,'status' =>401, 'message' =>"Unothorized user"]);
          }
        }
        else
        {
            return response()->json(['success' => false,'status' =>401, 'message' =>"Unothorized user"]);
        }
    }

    public function deletecartItem(Request $request)
    {
        if(auth()->user())
        {
          if(auth()->user()->role->name == "User")
          {
              $addcart = AddCart::where('user_id',auth()->user()->id)->where('is_active',1)->where('id',$request->id)->first();
              if($addcart)
              {
                  $addcart->is_active = 0;
                  $execute = $addcart->update();
                  if($execute)
                  {
                      return response()->json(['success' => true,'status' =>200, 'message' =>"cart item delete successfully"]);
                  }
                  else
                  {
                      return response()->json(['success' => false,'status' =>500, 'message' =>"Internal server error"]);
                  }
              }
              else
              {
                  return response()->json(['success' => false,'status' =>404, 'message' =>"data not found"]);  
              }
          }
          else
          {
                return response()->json(['success' => false,'status' =>401, 'message' =>"Unothorized user"]);
          }
        }
        else
        {
            return response()->json(['success' => false,'status' =>401, 'message' =>"Unothorized user"]);
        }
    }
    
    
    public function orderDetails(Request $request)
    {
      if(auth()->user())
      {
          if(auth()->user()->role->name == "User")
          {
             if($request->flag == "category")
             {
                 $token = rand();
                 foreach($request->orderdetails as $singledetails)
                 {
                     $addcart = new OrderDetails();
                     $addcart->user_id = auth()->user()->id;
                     $addcart->qty = $singledetails['qty'];
                     
                     $price = $singledetails['qty'];
                     if($price < 5000)
                     {
                         $price = 500;
                     }
                     elseif($price < 10000)
                     {
                         $price = 1000;
                     }
                     elseif($price < 15000)
                     {
                         $price = 1500;
                     }
                     elseif($price < 20000)
                     {
                         $price = 2000;
                     }
                     elseif($price < 25000)
                     {
                         $price = 2500;
                     }
                     elseif($price < 30000)
                     {
                         $price = 3000;
                     }
                     
                     $category = Package::where('category_id',$singledetails['id'])->where('package_amount',$price)->first();
                     $addcart->package_id = $category->id;
                     $addcart->token = $token;

                     $addcart->is_active = 1;
                     
                     $execute = $addcart->save();
                     
                 }
                 if($execute)
                 {
                    return response()->json(['success' => true,'status' =>200, 'data' => $token]);
                 }
                 else
                 {
                    return response()->json(['success' => false,'status' =>500, 'data' => "Internal server error"]);  
                 }
             }
             else
             {
                 $token = rand();
                 foreach($request->orderdetails as $singledetails)
                 {
                     $addcart = new OrderDetails();
                     $addcart->user_id = auth()->user()->id;
                     $addcart->qty = $singledetails['qty'];
                    
                     $addcart->package_id = $singledetails['id'];
                     
                     $addcart->is_active = 1;
                     $addcart->token = $token;
                     
                     $execute = $addcart->save();
                     
                 }
                 if($execute)
                 {
                    return response()->json(['success' => true,'status' =>200, 'data' => "Cart item add successfully"]);
                 }
                 else
                 {
                    return response()->json(['success' => false,'status' =>500, 'data' => "Internal server error"]);  
                 }
             }
          }
          else
          {
              return response()->json(['success' => false,'status' =>401, 'message' =>"Unothorized user"]);
          }
      }
      else
      {
            return response()->json(['success' => false,'status' =>401, 'message' =>"Unothorized user"]);
      }
    }
    
    public function billingDetails(Request $request)
    {
        
        if(auth()->user())
        {
          if(auth()->user()->role->name == "User")
          {
            $billing  = BillingDetails::where('token',$request['token'])->first();
            if(!empty($billing))
            {
                $billing->firstname = $request['firstName'];
                $billing->lastname = $request['lastName'];
                $billing->email = $request['email'];
                $billing->user_id = auth()->user()->id;
                $billing->phone = $request['phoneNumber'];
                $billing->company_name = $request['companyName'];
                $billing->country = $request['county'];
                $billing->address1 = $request['address1'];
                $billing->address2 = $request['address2'];
                $billing->city = $request['city'];
                $billing->state = $request['state'];
                $billing->postalcode = $request['postalCode'];
                $execute = $billing->update();
                
                if($execute)
                {
                    return response()->json(['success' => true,'status' =>200, 'data' => $request['token']]);
                }
                else
                {
                    return response()->json(['success' => false,'status' =>500, 'data' => "Internal server error"]);  
                }
            }
            else
            {
                $billing = new BillingDetails();
                $billing->user_id = auth()->user()->id;
                $billing->token = $request['token'];
                $billing->firstname = $request['firstName'];
                $billing->lastname = $request['lastName'];
                $billing->email = $request['email'];
                $billing->phone = $request['phoneNumber'];
                $billing->company_name = $request['companyName'];
                $billing->country = $request['county'];
                $billing->address1 = $request['address1'];
                $billing->address2 = $request['address2'];
                $billing->city = $request['city'];
                $billing->state = $request['state'];
                $billing->postalcode = $request['postalCode'];
                $billing->status = 1;
                $execute = $billing->save();
                
                if($execute)
                {
                    return response()->json(['success' => true,'status' =>200, 'data' => $request['token']]);
                }
                else
                {
                    return response()->json(['success' => false,'status' =>500, 'data' => "Internal server error"]);  
                }
            }
          }
          else
          {
               return response()->json(['success' => false,'status' =>401, 'message' =>"Unothorized user"]);
          }
        }
        else
        {
            return response()->json(['success' => false,'status' =>401, 'message' =>"Unothorized user"]);
        }
    }
    
    public function paymentDetails(Request $request)
    {
        if(auth()->user())
        {
            if(auth()->user()->role->name == "User")
            {
                $payment = PaymentDetails::where('token',$request['token'])->first();
                if(empty($payment))
                {
                    $payment = new PaymentDetails();
                    $payment->token = $request['token'];
                    $payment->payment_method = "yes";
                    $payment->payment_status = $request['status'];
                    $payment->user_id = auth()->user()->id;
                    $execute = $payment->save();
                    if($execute)
                    {
                        $payment = PaymentDetails::where('token',$request['token'])->where('payment_status',1)->first();
                        
                        $emptydetails = [];
            
                        $billing  = BillingDetails::where('token',$payment['token'])->first();
                    
                        $orderdata  = OrderDetails::where('token',$payment['token'])->first();
                        if(!empty($orderdata))
                        {
                            $orderdata  = OrderDetails::where('user_id',$orderdata->user_id)->where('package_id',$orderdata->package_id)->get();
                            if(count($orderdata) > 1)
                            {
                                $countofqty = [];
                                
                                $countdata = 0;
                                foreach($orderdata as $singlemaindata)
                                {
                                    if($singlemaindata['token'] != $payment['token'])
                                    {
                                        $countdata = $countdata + (int)$singlemaindata['qty'];
                                    }
                                }
                                $orderdata  = OrderDetails::where('token',$payment['token'])->first();
                                $orderdataoffset = $countdata;
                            }
                            else
                            {
                                 $orderdata  = OrderDetails::where('token',$payment['token'])->first();
                                 $orderdataoffset = 0;
                            }
                        }
                                        
                            $orderempty = [];
                                        
                            $order = Package::where('id',$orderdata['package_id'])->first();
                            
                            
                            $category = Category::where('id',$order->category_id)->first();
                        $orderdatamain =
                            [
                                "name"=>$category->name,
                                "package_amount"=>$order->package_amount,
                                "package_count"=>$orderdata->qty
                            ];
                          
                            $exceldata = ExcelData::where('category_id',$category->id)->skip($orderdataoffset)->limit($orderdata->qty)->get(['contact_number','pin_code','sector','state','city','country']);
                        
                            $filepath = 'uploadexcel/'.$request['token'].'/'.$category->name;
                            
                            if (!(\Storage::disk('local')->exists($filepath)))
                            {
                            
                              \Storage::makeDirectory($filepath);
                                                        
                            }
                            $filename = rand();
                            $filenamedata = $category->name.".xlsx";
                            
                            \Excel::store(new UsersExport($exceldata), $filepath.'/'.$filenamedata);
                        
                        $filepath = 'uploadexcel/'.$request['token'].'/'.$category->name.'/'.$category->name.'.xlsx';
                        
                        $path = \Storage::disk('local')->path($filepath);
                        
                         $mail = new PHPMailer;
                    //Server settings
                        $mail->IsSMTP();
                        $mail->Host       = 'smtp.gmail.com';
                        $mail->SMTPAuth = true; //Set the SMTP server to send through
                        $mail->Username   = 'prem.technotery@gmail.com';         //SMTP username
                        $mail->Password   = 'deljrqzqmtlojnfk';
                        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
                        $mail->Port       = 587;
                        $mail->SMTPOptions = array(
                        'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                        ));                  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                    
                        $mail->isHTML(true);  // Set email format to HTML
                        $mail->Subject = "Welcome , DATA X DATA";
                        $mail->FromName = "Welcome , DATA X DATA";       
                        
                        // Sender info  
                        $mail->setFrom("prem.technotery@gmail.com", 'Sender'); 
                        // Add a recipient  
                        $mail->addAddress("premmodi277@gmail.com" , 'Reciever'); 
                        // Email body content  
                        $mailContent = "  
                            <p>Welcome</p>";  
                        $mail->Body = $mailContent;  
                         
                        $mail->AddAttachment($path);
                        
                        // Send email  
                        if(!$mail->send()){  
                        return response()->json(['success' => false,'status' =>500, 'message' => "order is created and excel not send in email" ]);
                        }else{
                        return response()->json(['success' => true,'status' =>200, 'message' => "order is created and excel send in email"]);
                        }
                    }
                    else
                    {
                        return response()->json(['success' => false,'status' =>500, 'data' => "Internal server error"]);  
                    }
                }
                else
                {
                    $payment->payment_method = "yes";
                    $payment->payment_status = $request['status'];
                    $execute = $payment->save();
                    if($execute)
                    {
                        $payment = PaymentDetails::where('token',$request['token'])->where('payment_status',1)->first();
                        
                        $emptydetails = [];
            
                        $billing  = BillingDetails::where('token',$payment['token'])->first();
                    
                        $orderdata  = OrderDetails::where('token',$payment['token'])->first();
                        if(!empty($orderdata))
                        {
                            $orderdata  = OrderDetails::where('user_id',$orderdata->user_id)->where('package_id',$orderdata->package_id)->get();
                            if(count($orderdata) > 1)
                            {
                                $countofqty = [];
                                
                                $countdata = 0;
                                foreach($orderdata as $singlemaindata)
                                {
                                    if($singlemaindata['token'] != $payment['token'])
                                    {
                                        $countdata = $countdata + (int)$singlemaindata['qty'];
                                    }
                                }
                                $orderdata  = OrderDetails::where('token',$payment['token'])->first();
                                $orderdataoffset = $countdata;
                            }
                            else
                            {
                                 $orderdata  = OrderDetails::where('token',$payment['token'])->first();
                                 $orderdataoffset = 0;
                            }
                        }
                        
                        $orderempty = [];
                                        
                        $order = Package::where('id',$orderdata['package_id'])->first();
                        $category = Category::where('id',$order->category_id)->first();
                        $orderdatamain =
                            [
                                "name"=>$category->name,
                                "package_amount"=>$order->package_amount,
                                "package_count"=>$orderdata->qty
                            ];
                            
                            $exceldata = ExcelData::where('category_id',$category->id)->skip($orderdataoffset)->limit($orderdata->qty)->get(['contact_number','pin_code','sector','state','city','country']);
                        
                            $filepath = 'uploadexcel/'.$request['token'].'/'.$category->name;
                            
                            if (!(\Storage::disk('local')->exists($filepath)))
                            {
                            
                              \Storage::makeDirectory($filepath);
                                                        
                            }
                            $filename = rand();
                            $filenamedata = $category->name.".xlsx";
                            
                            \Excel::store(new UsersExport($exceldata), $filepath.'/'.$filenamedata);
                        
                        $filepath = 'uploadexcel/'.$request['token'].'/'.$category->name.'/'.$category->name.'.xlsx';
                        
                        $path = \Storage::disk('local')->path($filepath);
                        
                         $mail = new PHPMailer;
                    //Server settings
                        $mail->IsSMTP();
                        $mail->Host       = 'smtp.gmail.com';
                        $mail->SMTPAuth = true; //Set the SMTP server to send through
                        $mail->Username   = 'prem.technotery@gmail.com';         //SMTP username
                        $mail->Password   = 'deljrqzqmtlojnfk';
                        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
                        $mail->Port       = 587;
                        $mail->SMTPOptions = array(
                        'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                        ));                  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                    
                        $mail->isHTML(true);  // Set email format to HTML
                        $mail->Subject = "Welcome , DATA X DATA";
                        $mail->FromName = "Welcome , DATA X DATA";       
                        
                        // Sender info  
                        $mail->setFrom("prem.technotery@gmail.com", 'Sender'); 
                        // Add a recipient  
                        $mail->addAddress("premmodi277@gmail.com" , 'Reciever'); 
                        // Email body content  
                        $mailContent = "  
                            <p>Welcome</p>";  
                        $mail->Body = $mailContent;  
                        $mail->AddAttachment($path);
                        
                        // Send email  
                        if(!$mail->send()){  
                        return response()->json(['success' => false,'status' =>500, 'message' => "order is created and excel not send in email" ]);
                        }else{
                        return response()->json(['success' => true,'status' =>200, 'message' => "order is created and excel send in email"]);
                        }
                    }
                    else
                    {
                        return response()->json(['success' => false,'status' =>500, 'data' => "Internal server error"]);  
                    }
                }
            }
            else
            {
                return response()->json(['success' => false,'status' =>401, 'message' =>"Unothorized user"]);
            }
        }
        else
        {
            return response()->json(['success' => false,'status' =>401, 'message' =>"Unothorized user"]);
        }
    }
 
    public function getAllOrderDetails()
    {
        if(auth()->user())
        {
            if(auth()->user()->role->name == "User")
            {
                $payment = PaymentDetails::where('payment_status',1)->get();
                $emptydetails = [];
                foreach($payment as $singlepayment)
                {
                    $billing  = BillingDetails::where('token',$singlepayment['token'])->first();
                    
                                        $order  = OrderDetails::where('token',$singlepayment['token'])->get();
                                        $orderempty = [];
                                        foreach($order as $singleorder)
                                        {
                                            $order = Package::where('id',$singleorder['package_id'])->first();
                                            $category = Category::where('id',$order->category_id)->first();
                                            $orderdata =
                                                [
                                                    "name"=>$category->name,
                                                    "package_amount"=>$order->package_amount,
                                                    "package_count"=>$singleorder['qty']
                                                ];
                                            array_push($orderempty,$orderdata);
                                        }
                    
                    $details = [
                        "billing" => $billing,
                        "order" => $orderempty,
                         "status"=>$singlepayment['payment_status']   
                        ];
                    array_push($emptydetails,$details);
                }
                return response()->json(['success' => true,'status' =>401, 'data' =>$emptydetails]);
            }
            else
            {
                return response()->json(['success' => false,'status' =>401, 'message' =>"Unothorized user"]);
            }
        }
        else
        {
            return response()->json(['success' => false,'status' =>401, 'message' =>"Unothorized user"]);
        }
    }
    
}

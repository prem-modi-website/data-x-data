<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Auth;
use Log;
use Validator;
use Session;
use App\User;
use App\PasswordReset;

class LoginController extends Controller
{
    //
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        try {
      
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->where('is_active',1)->first();
       
            if($finduser){
       
                Auth::login($finduser);
      
                return redirect()->route('home');

       
            }else{
                $newUser = new User;
                $newUser->name = $user->name;
                $newUser->email = $user->email;
                $newUser->role_id = 2;
                $newUser->google_id= $user->id;
                $newUser->is_active = 1;
                $newUser->password = encrypt('123456dummy');
                $newUser->save();
      
                Auth::login($newUser);
                return redirect()->route('home');
            }
      
        } catch (Exception $e) {
            Log::info('Query: '.$e->getSql());
            Log::info('Error: Bindings: '.$e->getBindings());
            Log::info('Error: Code: '.$e->getCode());
            Log::info('Error: Message: '.$e->getMessage());
            
            Session::flash('error',"internal server erro please try again later");
            return redirect()->back();
        }
    }


    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleFacebookCallback()
    {
        try {
        
            $user = Socialite::driver('facebook')->user();
         
            $finduser = User::where('facebook_id', $user->id)->where('is_active',1)->first();
        
            if($finduser){
         
                Auth::login($finduser);
        
                return redirect()->route('home');
         
            }else{
                $newUser = new User;
                $newUser->name = $user->name;
                $newUser->email = $user->email;
                $newUser->role_id = 2;
                $newUser->is_active = 1;
                $newUser->facebook_id= $user->id;
                $newUser->password = encrypt('123456dummy');
                $newUser->save();
      
                Auth::login($newUser);
                return redirect()->route('home');
            }
        
        } catch (Exception $e) {
            Log::info('Query: '.$e->getSql());
            Log::info('Error: Bindings: '.$e->getBindings());
            Log::info('Error: Code: '.$e->getCode());
            Log::info('Error: Message: '.$e->getMessage());
            
            Session::flash('error',"internal server erro please try again later");
            return redirect()->back();
        }
    }

    public function customerloginPage()
    {
        return view('frontend.custom_login');
    }
    public function signup(Type $var = null)
    {
        return view('frontend.signup');
    }
    public function signupCustomer(Request $request)
    {
        $rules = [
            "name" => 'required',
            "email" => 'required',
            "password" => 'required',
        ];
        $validation = Validator::make($request->all(),$rules);
        if($validation->fails())
        {
            return redirect()->back()->withErrors($validation->errors());
        }


        try{
            $user = User::where('email',$request->email)->where('is_active',1)->first();
            if($user)
            {
                Session::flash('error',"User Already Exsists");
                return redirect()->back();
            }
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = \Hash::make($request->password);
            $user->role_id = 2;
            $user->is_active = 1;
            $executeQuery = $user->save();
            if(!$executeQuery)
            {
                Session::flash('error',"internal server erro please try again later");
                return redirect()->back();
            }
            Session::flash('success',"Data Save Succesfully.");
            $this->customerlogin($request);
            return redirect()->route('home');
        }
        catch(\Exception\Database\QueryException $e)
        {
            Log::info('Query: '.$e->getSql());
            Log::info('Error: Bindings: '.$e->getBindings());
            Log::info('Error: Code: '.$e->getCode());
            Log::info('Error: Message: '.$e->getMessage());
            
            Session::flash('error',"internal server erro please try again later");
            return redirect()->back();
        }
        catch(\Exception $e)
        {
            Log::info('Error: Code: '.$e->getCode());
            Log::info('Error: Message: '.$e->getMessage());
            
            Session::flash('error',"internal server erro please try again later");
            return redirect()->back();
        }
        
    }
    public function customerlogin(Request $request)
    {
        
        $rules = [
            "email" => 'required',
            "password" => 'required',
        ];
        $validation = Validator::make($request->all(),$rules);
        if($validation->fails())
        {
            return redirect()->back()->withErrors($validation->errors());
        }
        $credential = $request->only('email','password');
        if (Auth::attempt($credential))
        {
             if (auth()->user()->role->name == "Admin")
             {
                 return redirect()->route('dashboard');
             }
             else if(auth()->user()->role->name == "User")
             {
                if(auth()->user()->is_active == 1)
                {

                    return redirect()->route('home');
                }
             }
        }
        else
        {
            return redirect()->route('customer-login');
        }
    }

    public function customerLogout()
    {
        Auth::logout();
        Session::flush();
        return redirect('customer-login'); 
    }

    public function forgotPasswordPage()
    {
        return view('frontend.forgot');
    }
    public function forgotPass(Request $request)
    {
        $rules = [
            'email' => 'required|email'
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validation->errors());
        }
        $token = \Str::uuid();
        $details = [
            'url' => route('changePasswordcus',$token),
        ];
        $passwordReset = new PasswordReset;
        $passwordReset->email = $request->email;
        $passwordReset->token = $token;
        $passwordReset->save();
        \Mail::to($request->email)->send(new \App\Mail\MyTestMail($details));
       
        // dd("Email is Sent.");
        Session::flash('success',"Please check your email `{$request->email}`");
        return redirect()->route('home');
    }
    public function changePassword($token)
    {
        $user = PasswordReset::where('token',$token)->first();
        if(! $user)
        {
            Session::flash('error',"This data not found.Please try again.");
            return redirect()->back();
        }
        return view('frontend.emails.forgotPassword',compact('user'));
       

    }
    public function changePasswordCustomer(Request $request)
    {
        $rules = [
            'new_password'=> 'required',
            'confirm_password'=> 'required|same:new_password',
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors());
        }
        try
        {
            $user = PasswordReset::where('token',$request->token)->first();
    
            $user = User::where('email',$user->email)->first();
            $user->password = \Hash::make($request->confirm_password);
            $user->update();
            Session::flash('success',"Password Changed Successfully.");
            return redirect()->route('customer-login');

        }
        catch (Exception $e) {
            Log::info('Query: '.$e->getSql());
            Log::info('Error: Bindings: '.$e->getBindings());
            Log::info('Error: Code: '.$e->getCode());
            Log::info('Error: Message: '.$e->getMessage());
            
            Session::flash('error',"internal server erro please try again later");
            return redirect()->back();
        }
       

    }
    public function contactMail(Request $request)
    {
        $rules = [
            'first_name'=> 'required',
            'last_name'=> 'required',
            'email'=> 'required',
            'phone'=> 'required',
            'message'=> 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors());
        }
        try
        {
            $details = [
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "email" => $request->email,
                "phone" => $request->phone,
                "message" => $request->message,
            ];
            \Mail::to('mansi.bhanarkar@gmail.com')->send(new \App\Mail\SendContact($details));

            Session::flash('success',"Contact info successfully send.");
            return redirect()->back();

        }
        catch (Exception $e) {
            Log::info('Query: '.$e->getSql());
            Log::info('Error: Bindings: '.$e->getBindings());
            Log::info('Error: Code: '.$e->getCode());
            Log::info('Error: Message: '.$e->getMessage());
            
            Session::flash('error',"internal server erro please try again later");
            return redirect()->back();
        }
       

    }
}

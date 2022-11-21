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
                 return redirect()->route('home');
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
}

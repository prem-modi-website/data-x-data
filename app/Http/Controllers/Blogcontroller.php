<?php

namespace App\Http\Controllers;
use Excel;
use App\Exports\UsersExport;
use App\Repostiory\Main;
use App\Mail\TestEmail;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Vallidator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class Blogcontroller extends Controller
{
    public function index(Request $request)
    {
        if(isset($request->vin))
        {
            $data = \DB::table('customerinformation')->where('vin',$request->vin)->get();
            return view('Excel',compact('data'));
        }
        else {
            $data = \DB::table('customerinformation')->get();
            return view('Excel',compact('data'));
        }
    }

    public function excel(Request $request,$id)
    {
        return Excel::download(new UsersExport($id),'vins.xlsx');
    }

    public function mail()
    {
        $data = ['message' => 'This is a test!'];

       \Mail::to('premmodi277@gmail.com')->send(new TestEmail($data));
    }

    public function datamain(Main $main)
    {
        $main->data();
    }

    public function registration(Request $request)
    {
        $rules = [
            'name'=>'required',
            'email' => 'required|unique:users',
            'password' => 'required',
         ];
         
         $messages = [
            'name.required' => 'name is required',
            'email.required' => 'email is required',
            'email.unique' => 'email is unique',
            'password.required' => 'password is required',
         ];
        
        $validator = Validator::make($request->all(),$rules, $messages);
        if ($validator->fails()) {
            return response()->json(['sucess' => false,'status' =>'422', 'message' =>$validator->errors()],422);
        }
        else
        {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id = 2;
            $execute = $user->save();
            if($execute)
            {
                return response()->json(["success"=>true,"status"=>200,"message"=>"Data save successfully"]);
            }
            else {
                return response()->json(["status"=>500,"success"=>false,"message"=>"Intenal server error"]);
            }
        }
    }
    public function allUsers(Request $request)
    {
        if(auth()->user())
        {
            $users = User::where('role_id',2)->get(['name','email','id']);
            if($users)
            {
                return response()->json(["success"=>true,"status"=>200,"data"=>$users]);
            }
            else
            {
                return response()->json(["success"=>true,"status"=>200,"data"=>[]]);

            }

        }
        else
        {
            return response()->json(["status"=>401,"success"=>false,"message"=>"Unothorized user"]);
        }
    }
    public function useractivated(Request $request)
    {
        if (auth()->user())
        {
            $user = User::where('email',$request->email)->first();
            if($user)
            {
                $user->is_active = 1;
                $execute = $user->update();
                if($execute)
                {
                    return response()->json(["success"=>true,"status"=>200,"message"=>"user activated successfully"]);
                }
                else
                {
                    return response()->json(["success"=>false,"status"=>500,"message"=>"Internal server error"]);
                }
            }
            else
            {
                return response()->json(["success"=>false,"status"=>404,"message"=>"Data not found"]);

            }

        }
        else
        {
            return response()->json(["status"=>401,"success"=>false,"message"=>"Unothorized user"]);
        }
    }
    public function userdeactivated(Request $request)
    {
        if (auth()->user())
        {
            $user = User::where('email',$request->email)->where('is_active',1)->first();
            if($user)
            {
                $user->is_active = 0;
                $execute = $user->update();
                if($execute)
                {
                    return response()->json(["success"=>true,"status"=>200,"message"=>"user deactivated successfully"]);
                }
                else
                {
                    return response()->json(["success"=>false,"status"=>500,"message"=>"Internal server error"]);
                }
            }
            else
            {
                return response()->json(["success"=>false,"status"=>404,"message"=>"Data not found"]);

            }

        }
        else
        {
            return response()->json(["status"=>401,"success"=>false,"message"=>"Unothorized user"]);
        }
    }
    
    
    //jwt login 
    public function login(Request $request)
    {
        $rules = [
            'email' => 'required',
            'password' => 'required',
         ];
         
         $messages = [
            'email.required' => 'email is required',
            'password.required' => 'password is required',
         ];
        
        $validator = Validator::make($request->all(),$rules, $messages);
        if ($validator->fails()) {
            return response()->json(['sucess' => false,'status' =>'422', 'message' =>$validator->errors()],422);
        }
        else
        {
            if(!$token = auth()->guard('api')->setTTL(1440)->attempt(["email"=>$request->email,"password"=>$request->password]))
            {
                return response()->json(['message'=>'unothorized user','status'=>401,'success'=>false]);
            }
            return $this->responsetoken($token);
        }
    }

    protected function responsetoken($token)
    {
        return response()->json(["success"=>true,"status"=>200,"access_token"=>$token,"token_type"=>"bearer","expirer_in"=>auth()->guard('api')->factory()->getTTL()*60]);
    }

    public function profile()
    {
        return response()->json(auth()->user());
    }
    
    public function logout()
    {
        auth()->guard('api')->logout();
        return response()->json(["message"=>"logout successfully","status"=>200,"success"=>true]);
    }
    
    public function forgot(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        
        if(empty($user))
        {
            return response()->json(["status"=>404,"success"=>false,"message"=>"data not found"]);
        }
        else
        {
            return response()->json(["status"=>200,"success"=>true,"data"=>"Email send successfully"]);
        }
    }
    
    public function forgotdata()
    {
        return view('forgot');   
    }
    public function forgotstore(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        
        if(empty($user))
        {
            dd("sss");
        }
        else
        {
            $token = md5($request->email);
            $user->token = md5($request->email);
            $user->update();
            $data = ['message' => 'This is a test!','token'=>$token];

            $email = \Mail::to($request->email)->send(new TestEmail($data));
            
            return redirect()->route('forgot');
        }
        
    }
    public function renamepassword(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        
        if(empty($user))
        {
            return response()->json(["status"=>404,"success"=>false,"message"=>"data not found"]);
        }
        else
        {
            $token = md5($request->email);
            $user->token = md5($request->email);
            $execute =  $user->update();
            if($execute)
            {
                return response()->json(["status"=>200,"success"=>true,"message"=>$token]);
            }
            else
            {
                return response()->json(["status"=>500,"success"=>false,"message"=>"Internal server error"]);
            }
            //$data = ['message' => 'This is a test!','token'=>$token];

           // $email = \Mail::to($request->email)->send(new TestEmail($data));
            
            
        }
    }
    
    
    public function changepassword()
    {
        return view('changepassword');
    }
    public function changepass(Request $request)
    {
        $user = User::where('token',$request->token)->first();
        if(!empty($user))
        {
            $user->password = Hash::make($request->password);
            $execute = $user->update();
            if($execute)
            {
                return redirect()->route('login');
            }
        }
    }
    public function passwordchange(Request $request)
    {
        $rules = [
            'password' => 'required|same:confirm-password',
            'confirm-password' => 'required',
            'token' => 'required',
         ];
         
         $messages = [
            'password.required' => 'password is required',
            'confirm-password.required' => 'confirm-password is required',
            'token.required' => 'token is required',
         ];
        
        $validator = Validator::make($request->all(),$rules, $messages);
        if ($validator->fails()) {
            return response()->json(['sucess' => false,'status' =>'422', 'message' =>$validator->errors()],422);
        }
        else
        {
            $user = User::where('token',$request->token)->first();
            if(!empty($user))
            {
                $user->password = Hash::make($request->password);
                $execute = $user->update();
                if($execute)
                {
                    return response()->json(["status"=>200,"success"=>true,"message"=>"password change successfully"]);
                }
                else
                {
                    return response()->json(["status"=>500,"success"=>false,"message"=>"Internal server error"]);
                }
            }
            else
            {
                return response()->json(["status"=>404,"success"=>false,"message"=>"data not found"]);
    
            }
        }
    }
    
    public function logindata()
    {
        return view('login');
    }
    public function regstore(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $execute = $user->save();
        if($execute)
        {
            return response()->json(["success"=>true,"message"=>"data save successfully"]);
        }
        else {
            return response()->json(["status"=>false]);
        }
    }
     
    public function regisdata(Request $request)
    {
        $credential = $request->only('email', 'password');
        if (Auth::attempt($credential))
        {
            return response()->json(["success"=>true,"user"=>auth()->user()]);
        }
        else
        {
            return response()->json(["success"=>false]);
        }
    }
    public function dashboard()
    {
        return view('dashboard');
    }
    public function logoutdata()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
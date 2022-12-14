<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Session;
use View;

class LoginController extends Controller
{   
    public function index(){
        return View::make('user.signin');
    }

    public function postSignin(Request $request){
        
        $this->validate($request, [
            'email' => 'email| required',
            'password' => 'required| min:4'
        ]);

        if(auth()->attempt(array('email' => $request->email, 'password' => $request->password))) {

            $user = User::where('email', $request->email)->first();
            // $user = Auth::user();
            $authToken = $user->createToken('auth-token')->plainTextToken;

            if (auth()->user()->role === 'employee') {
                return response()->json(['access_token' => $authToken, "success" => "Employee Login Successfully!","status" => 200 ]);
            } 
            else if (auth()->user()->role === 'admin'){
                return response()->json(['access_token' => $authToken, "success" => "Employee Login Successfully!","status" => 200 ]);
            }  
            else {
                return response()->json(['access_token' => $authToken, "success" => "Customer Login Successfully!","status" => 200]);
            }
        }
        else{
            // return redirect()->route('user.signin')->with('error','Email-Address And Password Are Wrong.');
            return response()->json(["error" => "Email-Address And Password Are Wrong."]);
        }
     }
     
     public function logout(){
        Auth::logout();
        return response()->json(["success" => "User Logout Successfully!"]);
    }
    
}

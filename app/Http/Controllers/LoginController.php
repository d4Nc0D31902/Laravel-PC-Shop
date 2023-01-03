<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use View;
use Validator;

class LoginController extends Controller
{   
    public function index(Request $request){
        if ($request->ajax())
        {
            $id = Auth::user()->customers->customer_id;

            $customer = DB::table('customers')
            ->join('users', 'users.id', '=', 'customers.user_id')
            ->where('customers.customer_id', '=', $id)
            ->first();
            
            return response()->json($customer);
        }

        return View::make('user.signin');
    }

    public function postSignin(Request $request){
        
        $validator = \Validator::make($request->all(), [
            'email' => 'email| required',
            'password' => 'required| min:4'
        ]);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {

            $email = $request->email;

            $user = User::where('email', $email)->first();
            
            $authToken = $user->createToken('auth-token')->plainTextToken;
            
            if (auth()->user()->role === 'employee') {
                return response()->json(['access_token' => $authToken, "success" => "Employee Login Successfully!","status" => 200 ]);
            } 
            else if (auth()->user()->role === 'admin'){
                return response()->json(['access_token' => $authToken, "success" => "Admin Login Successfully!","status" => 200 ]);
            }  
            else {
                return response()->json(['access_token' => $authToken, "success" => "Customer Login Successfully!","status" => 200]);
            }
        }
        else{
            // return redirect()->route('user.signin')->with('error','Email-Address And Password Are Wrong.');
            return response()->json(["errors" => "Email-Address or Password Are Wrong."]);
        }
     }
     
     public function logout(){
        // token delete
        $user = Auth::user();
        $user->tokens()->delete();
        
        // auth logout
        Auth::logout();
        return response()->json(["success" => "User Logout Successfully!"]);
    }
    
}

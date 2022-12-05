<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use View;

class LoginController extends Controller
{   
    public function index(){
        return View::make('login.index');
    }

    public function postSignin(Request $request){
        $this->validate($request, [
            'email' => 'email| required',
            'password' => 'required| min:4'
        ]);

        if(auth()->attempt(array('email' => $request->email, 'password' => $request->password))) {

            if (auth()->user()->role === 'employee') {
                // return redirect()->route('dashboard.index');
                // return redirect()->route('user.employee');
                return response()->json(["success" => "Employee Login Successfully!","status" => 200]);
            } else if (auth()->user()->role === 'admin'){
            //  return redirect()->route('getEmployees');
            return response()->json(["success" => "Admin Login Successfully!","status" => 200]);
            }  
            else {
                // return redirect()->route('shop.index');
                 return response()->json(["success" => "Customer Login Successfully!","status" => 200]);
            }
        }
        else{
            // return redirect()->route('user.signin')->with('error','Email-Address And Password Are Wrong.');
        }
     }
     
     public function logout(){
        Auth::logout();
        // return redirect()->guest('/');
        return redirect()->route('user.signin');
    }
}

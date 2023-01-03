<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\User;
use View;
use Storage;
use File;
use DB;
use Log;
use Validator;
use Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    // public function getCustomer()
    // {
    //     return View::make('customer.index');
    // }

    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $customers = Customer::withTrashed()->with('users')->orderBy('customer_id','DESC')->get();
            return response()->json($customers);
            // return response()->json(['customer'])
        }
    }

    
    // public function getCustomerAll(Request $request)
    // {
    //     // $customers = Customer::orderBy('id','DESC')->get();
    //     // // dd($customers);
    //     // return response()->json($customers);

    //     if ($request->ajax()){
    //         $customers = Customer::orderBy('customer_id','DESC')->get();
    //         return response()->json($customers);
    //         }
    // }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validator = \Validator::make($request->all(), [
            'email' => 'email| required| unique:users',
            'password' => 'required| min:3'
        ]);
        
        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $user = new User([
            'name' => $request->input('fname').' '.$request->lname,
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);
        
        $user->role = 'customer';
        $user->save();

        if($file = $request->hasFile('uploads')) {
        	$customer = new Customer;
        	    
        	$customer->title = $request->title;
        	$customer->fname = $request->fname;
        	$customer->lname = $request->lname;
        	$customer->addressline = $request->addressline;
        	$customer->zipcode = $request->zipcode;
        	$customer->town = $request->town;
        	$customer->phone = $request->phone;
            $files = $request->file('uploads');
        	$customer->imagePath = 'images/'.$files->getClientOriginalName();
        	$customer->save();
            Storage::put('/public/images/'.$files->getClientOriginalName(),file_get_contents($files));
        }
        // Auth::login($user);
        return response()->json(["success" => "Customer created successfully.","customer" => $customer ,"status" => 200]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $customer = Customer::with('users')->find($id);
        // $customer = Customer::with('users')->where('customer_id',$id)->first();
        
        // $customer = DB::table('customers')
        // ->join('users', 'users.id', '=', 'customers.user_id')
        // ->first();
        $id = Auth::user()->customers->customer_id;

        $customer = DB::table('customers')
        ->join('users', 'users.id', '=', 'customers.user_id')
        ->where('customers.customer_id', '=', $id)
        ->first();
        
        return response()->json($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->title = $request->title;
        $customer->fname = $request->fname;
        $customer->lname = $request->lname;
        $customer->addressline = $request->addressline;
        $customer->zipcode = $request->zipcode;
        $customer->town = $request->town;
        $customer->phone = $request->phone;

        if($files = $request->hasFile('uploads')) {
        $files = $request->file('uploads');
        $customer->imagePath = 'images/'.$files->getClientOriginalName();
        $customer->update();
        Storage::put('/public/images/'.$files->getClientOriginalName(),file_get_contents($files));   
        } else {
            $customer->update();
        }

        $user = User::find($customer->user_id);
        $user->name = $request->fname . ' ' . $request->lname;
        if(!empty($request->input('email')) and !empty($request->input('password'))){
            $user->email = $request->email;
            $user->password = bcrypt($request->input('password'));
            $user->update();
        } elseif(!empty($request->input('email'))){
            $user->email = $request->email;
            $user->update();
        } elseif(!empty($request->input('password'))){
            $user->password = bcrypt($request->input('password'));
            $user->update();
        } else{
            $user->update();  
        }

        return response()->json($customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customers = Customer::findOrFail($id);
        $user = User::where('id',$customers->user_id)->delete();
        $customers->delete();

        return response()->json(["success" => "Customer Deactivated Successfully!","status" => 200]);
    }

    public function restore($id) {
        $customer = Customer::withTrashed()->find($id);
        $user = User::where('id',$customer->user_id)->restore();
        $customer->restore(); 

        return response()->json(["success" => "Customer has been Restored!","status" => 200]);
    }
}

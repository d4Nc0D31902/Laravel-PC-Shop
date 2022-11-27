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
            $customers = Customer::with('users')->orderBy('customer_id','DESC')->get();
            return response()->json($customers);
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
        	$customer->user_id = $user->id;
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
        $customer = Customer::with('users')->find($id);
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
        $files = $request->file('uploads');
        $customer->imagePath = 'images/'.$files->getClientOriginalName();
        $customer->update();
        Storage::put('/public/images/'.$files->getClientOriginalName(),file_get_contents($files));   
        // $customer = Customer::find($id);
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
        $customers->delete();
        return response()->json(["success" => "Customer Deleted Successfully!","status" => 200]);
    }
}

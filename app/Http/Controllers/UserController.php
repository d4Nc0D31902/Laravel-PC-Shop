<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Customer;
use Auth;
use View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function getProfile()
    {
        return View::make('profile.customer');
    }

    public function profile(Request $request)
    {   
        if ($request->ajax()){
            if(Auth::check()){
                if(Auth::user()->user === "admin") {

                } elseif(Auth::user()->user === "employee") {
                
                } else {
                    // $customer = Customer::where('user_id',Auth::user()->)->first();
                    $id = Auth::user()->customers->customer_id;

                    $customer = DB::table('customers')
                    ->join('users', 'users.id', '=', 'customers.user_id')
                    ->where('customers.customer_id', '=', $id)
                    ->first();
                    return response()->json($customer);
                    // return response()->json(["success" => "Successfully login!"]);
                }
            }
        }
    }
}

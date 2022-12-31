<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Stock;
use View;
use Storage;
use File;
use DB;
use Log;
use Auth;
use Carbon\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function getProduct()
    // {
    //     return View::make('product.index');
    // }

    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $products = Product::withTrashed()->orderBy('product_id','DESC')->get();

            // $products = Product::search(request('search'))->paginate();
            return response()->json($products);
        }
    }

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
        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->brand = $request->brand;
        $product->type = $request->type;
        $files = $request->file('uploads');
        $product->imagePath = 'images/'.$files->getClientOriginalName();
        $product->save();

        $stock = new Stock;
        $stock->product_id = $product->product_id;
        $stock->quantity = $request->quantity;
        $stock->save();

        Storage::put('/public/images/'.$files->getClientOriginalName(),file_get_contents($files));

        return response()->json(["success" => "Product created successfully.","product" => $product ,"status" => 200]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $product = Product::find($id);

        $product = DB::table('products')
        ->join('stock', 'stock.product_id', '=', 'products.product_id')
        ->where('products.product_id', '=', $id)
        ->first();

        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->brand = $request->brand;
        $product->type = $request->type;
        
        if($files = $request->hasFile('uploads')) {
            $files = $request->file('uploads');
            $product->imagePath = 'images/'.$files->getClientOriginalName();
            $product->update();
            Storage::put('/public/images/'.$files->getClientOriginalName(),file_get_contents($files));   
        } else {
            $product->update();
        }

        $stock = Stock::find($product->product_id);
        $stock->quantity = $request->quantity;
        $stock->update();
        
        return response()->json(["success" => "Product updated successfully!","status" => 200, $product]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Product::findOrFail($id);
        $products->delete();

        $stock = Stock::findOrFail($id);
        $stock->delete();
        return response()->json(["success" => "Product Deleted Successfully!","status" => 200]);
    }

    public function restore($id) {
        $products = Product::withTrashed()->findOrFail($id);
        $products->restore();

        $stock = Stock::withTrashed()->findOrFail($id);
        $stock->restore();
        
        return response()->json(["success" => "Product has been Restored!","status" => 200]);
    }

    public function shop(Request $request)
    {
        if ($request->ajax())
        {
            $products = Product::orderBy('product_id','DESC')->get();

            return response()->json($products);
        }
    }

    public function postCheckout(Request $request)
    {
        $products = json_decode($request->getContent(),true);
        Log::info(print_r($products, true));
        
        try {
            DB::beginTransaction();
            $order = new Order();
            $order->date_placed = Carbon::now();
            // $customer = Customer::find(1);
            $cusid = Auth::user()->customers->customer_id;
            $customer = Customer::find($cusid);
            $customer->orders()->save($order);
            //  dd($cart->products);
            // Log::info(print_r($order->orderinfo_id, true));
            foreach($products as $product) {
               $id = $product['product_id'];
               $order->products()->attach($order->orderinfo_id,['quantity'=> $product['quantity'],'product_id'=>$id]);
            //    Log::info(print_r($order, true));
               $stock = Stock::find($id);
               $stock->quantity = $stock->quantity - $product['quantity'];
               $stock->save();
            }
          }
          
            catch (\Exception $e) {
            DB::rollback();
              return response()->json(array('status' => 'Order Failed','code'=>409,'error'=>$e->getMessage()));
            }
      
            DB::commit();
            return response()->json(array('status' => 'Order Success','code'=>200 , 'order id'=>$order,'stock'=>$order));
    }//end postcheckout
}

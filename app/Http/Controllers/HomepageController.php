<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use View;

class HomepageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            // $products = Product::orderBy('product_id','DESC')->get();

            $products = Product::search(request('search'))->paginate();
            return response()->json($products);
        }
    }
}

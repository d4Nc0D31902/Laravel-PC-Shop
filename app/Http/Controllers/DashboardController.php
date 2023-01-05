<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function titleChart() {
        if (!auth()->user()->tokenCan('worker')){
            abort(403, 'Unauthorized Action!');
        }

        $customer = DB::table('customers')->groupBy('title')->orderBy('total')->pluck(DB::raw('count(title) as total'),'title')->all();
        $labels = (array_keys($customer));
        
        $data= array_values($customer);
        // dd($customer, $data, $labels);
        return response()->json(array('data' => $data, 'labels' => $labels));
    }

    public function salesChart() {
        if (!auth()->user()->tokenCan('worker')){
            abort(403, 'Unauthorized Action!');
        }

        $sales = DB::table('products as i')
                    ->join('orderline as ol', 'i.product_id', '=', 'ol.product_id')
                    ->join('orderinfo as oi', 'ol.orderinfo_id', '=', 'oi.orderinfo_id')
                    ->select(DB::raw('monthname(oi.date_placed) as month, sum(ol.quantity * i.price) as total'))
                    ->groupBy('oi.date_placed')
                    ->pluck('total','month')
                    ->all();
        // dd($sales);
        $labels = (array_keys($sales));
        
        $data= array_values($sales);
        // dd($sales, $data, $labels);
        return response()->json(array('data' => $data, 'labels' => $labels));
    }

    public function productsChart() {
        if (!auth()->user()->tokenCan('worker')){
            abort(403, 'Unauthorized Action!');
        }

        $products = DB::table('products as i')
                    ->join('orderline as ol', 'i.product_id', '=', 'ol.product_id')
                    ->select(DB::raw('i.name as products, sum(ol.quantity) as total'))
                    ->groupBy('i.name')
                    ->pluck('total','products')
                    ->all();
                    
        // dd($products);
        $labels = (array_keys($products));
        
        $data= array_values($products);
        // dd($sales, $data, $labels);
        return response()->json(array('data' => $data, 'labels' => $labels));
    }

    public function datesChart() {
        if (!auth()->user()->tokenCan('worker')){
            abort(403, 'Unauthorized Action!');
        }
        
        $dates = DB::table('products as i')
                    ->join('orderline as ol', 'i.product_id', '=', 'ol.product_id')
                    ->join('orderinfo as oi', 'ol.orderinfo_id', '=', 'oi.orderinfo_id')
                    ->select(DB::raw('date(oi.date_placed) as month, sum(ol.quantity) as total'))
                    ->groupBy('oi.date_placed')
                    ->pluck('total','month')
                    ->all();
                    
        // dd($sales);
        $labels = (array_keys($dates));
        
        $data= array_values($dates);
        // dd($sales, $data, $labels);
        return response()->json(array('data' => $data, 'labels' => $labels));
    }
}

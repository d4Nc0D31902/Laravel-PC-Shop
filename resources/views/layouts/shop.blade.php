<!doctype html>
 <html lang="en">
 <head>
 <meta charset="UTF-8" name="csrf-token" content="{{ csrf_token() }}" />
 <link href="{{asset('css/shop.css')}}" rel="stylesheet"> 
 <title>Shop</title>
 </head>
 <body>
 <br>
    <div class="container">
    @include('partials.header')
    @yield('body')
    </div>

   @include('layouts.shopheader')

 </body>
 </html>
@extends('layouts.shop')
@section('body')


<h5>Your Shopping Cart</h5>
    <div id="cart-container">
      <div id="cart">
      <i class="fa fa-shopping-cart openCloseCart" style="font-size:20px" aria-hidden="true"></i> 
        <button id="emptyCart" class="button button5">Empty Cart</button>
      </div>
      <span id="productCount"></span>
    </div>
 

  <div id="shoppingCart">
    <div id="cartproductsContainer">
      <h5>Products in your Cart</h3>
      <i class="fa fa-times-circle-o fa-3x openCloseCart" aria-hidden="true"></i>
      <div id="cartProducts">
      	<!-- <button class="removeproduct">Remove product</button> -->
      </div>
      <button class="btn btn-primary" id="checkout">Checkout</button>
      <span id="cartTotal"></span>
  	</div>
  </div>

  <nav>
  	<ul>
  		<!-- <li><a href="#">Shopping Cart</a></li> -->
  	</ul>
  </nav>
  
  <div class="container container-fluid" id="products"> 
  	
  </div>

@endsection
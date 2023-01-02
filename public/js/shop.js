
var productCount = 0;
var priceTotal = 0;
var quantity = 0;
var clone = "";

$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "/api/shop",
        dataType: 'json',
        success: function (data) {
            console.log(data);
            $.each(data, function (key, value) {
                id = value.product_id;

                // var product = "<div class='product'><div class='productDetails'><div class='productImage'><img src="+"/storage/" + value.imagePath + " width='200px', height='200px'/></div><div class='productText'><p class='price-container'>Price: Php <span class='price'>" + value.price + "</span></p><p>" + value.description + "</p></div><input type='number' class='qty' name='quantity' min='1' max='5'><p class='productId'>" + value.product_id + "</p>      </div><button type='button' class='btn btn-primary add' >Add to cart</button></div>";

                var product = "<div class='col'><div class='productDetails'><div class='card'><div class='productImage'><img src="+"/storage/" + value.imagePath + " width='200px', height='200px'/></div><div class='productText'><strong>"+ value.name +"</strong><p class='price-container'><strong>Price:</strong> ₱<span class='price'>" + value.price + "</span></p><p><strong>Description: </strong>" + value.description + "</p></div><p><strong>Quantity: </strong><input type='number' class='qty' name='quantity' min='1' max='5'></p><p class='productId' hidden>" + value.product_id + "</p></div></div><button type='button' class='btn btn-primary add' >Add to cart</button></div>";

                // var product = "<div><div class='col'><div class='productDetails'><div class='card'><div class='productImage'><img src="+"/storage/" + value.imagePath + " class='card-img-top' alt='Hollywood Sign on The Hill'/></div><div class='card-body'><h5 class='card-title'>" + value.name +"</h5><p class='price-container'><strong>Price:</strong> $<span class='price'>" + value.price + "</span></p></p><p class='card-text'>Descriptiop: " + value.description + "</p><p>Quantity: <input type='number' class='qty' name='quantity' min='1' max='5'></p></div></div><p class='productId'>" + value.product_id + "</p><button type='button' class='btn btn-primary add' >Add to cart</button></div></div>";
                $("#products").append(product);             // <img src="/storage/' + JsonResultRow.imagePath + '" width="100px" height="100px">';
            });

        },
        error: function () {
            console.log('AJAX load did not work');
            alert("error");
        }
    });

    $("#products").on('click', '.add', function () {
        productCount ++;
        $('#productCount').text(productCount).css('display', 'block');
        clone =  $(this).siblings().clone().appendTo('#cartProducts')
                   .append('<button class="removeproduct">Remove product</button>');
        var price = parseInt($(this).siblings().find('.price').text()); 
        priceTotal += price;
        $('#cartTotal').text("Total: ₱ " + priceTotal);
        });
    
    
        $('#shoppingCart').on('click', '.removeproduct', function(){
            $(this).parent().remove();  
            productCount --;
            $('#productCount').text(productCount);
      
            // Remove Cost of Deleted product from Total Price
            var price = parseInt($(this).siblings().find('.price').text());
            priceTotal -= price;
            $('#cartTotal').text("Total: ₱" + priceTotal);
      
            if (productCount == 0) {
              $('#productCount').css('display', 'none');
            }
          });

          $('#emptyCart').click(function() {
            productCount = 0;
            priceTotal = 0;
      
            $('#productCount').css('display', 'none');
            $('#cartProducts').text('');
            $('#cartTotal').text("Total: ₱" + priceTotal);
          }); 


          $('#checkout').click(function () {
            productCount = 0;
            priceTotal = 0;
            let products = new Array();
            
            $("#cartProducts").find(".productDetails").each(function (i, element) {
                console.log(element);
                let productid = 0;
                let qty = 0;

                qty = parseInt($(element).find($(".qty")).val());
                productid = parseInt($(element).find($(".productId")).html());

                products.push(
                    {
                        "product_id": productid,
                        "quantity": qty
                    }
                );
    
            });

            console.log(JSON.stringify(products));
            var data = JSON.stringify(products);
    
            $.ajax({
                type: "POST",
                url: "/api/product/checkout",
                data: data,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                dataType: "json",
                processData: false,
                contentType: 'application/json; charset=utf-8',
                success: function (data) {
                    if(data.error){
                        console.log(data);
                        
                        $('#shoppingCart').hide();

                        bootbox.alert(data.error);

                        setTimeout(function(){
                            window.location.href = "/signin";
                         }, 1000);

                    } else{
                        console.log(data);

                        $('#shoppingCart').hide();

                        let dialog = bootbox.dialog({
                            title: 'Order Status',
                            message: '<p><i class="fas fa-spin fa-spinner"></i> Please wait your order is processing.</p>'
                        });

                        dialog.init(function() {
                            setTimeout(function() {
                                dialog.find('.bootbox-body').html(data.status);
                            }, 3000);
                        });
                    }
                },
                error: function (_error) {
                    alert(data.status);
                }
            });
            $('#productCount').css('display', 'none');
            $('#cartProducts').text('');
            $('#cartTotal').text("Total: $" + priceTotal);
    
            // console.log(clone.find(".productDetails"));
    
        });

        $('.openCloseCart').click(function(){
            $('#shoppingCart').toggle();
        });
})

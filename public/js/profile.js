$(document).ready(function(){

    $("#profileBtnClick").on('click', function(e) {
        e.preventDefault();

        $.ajax({
            type: "GET",
            url: "/api/profile",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function(data){
                   console.log(data);
                   $("#cccustomer_id").val(data.customer_id);
                   $("#cctitle").val(data.title);
                   $("#ccname").val(data.lname);
                   $("#ccfname").val(data.fname);
                   $("#ccaddressline").val(data.addressline);
                   $("#cctown").val(data.town);
                   $("#cczipcode").val(data.zipcode);
                   $("#ccphone").val(data.phone);
                   $("#ccemail").val(data.email);
                },
                
                error: function(){
                    console.log('AJAX load did not work');
                    alert("error");
                }
            });
        });

})// end of document
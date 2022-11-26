// $(document).ready(function () {

//     $("#customerbtn").on("click", function (e) {
//         e.preventDefault();
//         $("#items").hide("slow");-
//         $("#customers").show();
//     });

//     $.ajax({
//         type: "GET",
//         url: "/api/customer/all",
//         dataType: "json",
//         success: function (data) {
//             console.log(data);
//             $.each(data, function (key, value) {
//                 console.log(value);
//                 var id = value.customer_id;
//                 var tr = $("<tr>");
//                 tr.append($("<td>").html(value.customer_id));
//                 tr.append($("<td>").html(value.title));
//                 tr.append($("<td>").html(value.fname));
//                 tr.append($("<td>").html(value.lname));
//                 tr.append($("<td>").html(value.addressline));
//                 tr.append($("<td>").html(value.town));
//                 tr.append($("<td>").html(value.zipcode));
//                 tr.append($("<td>").html(value.phone));
//                 tr.append($("<td>").html(data.imagePath));
//                 tr.append("<td align='center'><a href='#' data-bs-toggle='modal' data-bs-target='#editModal' id='editbtn' data-id="+ id + "><i class='fa-solid fa-user-pen' aria-hidden='true' style='font-size:24px' ></a></i></td>");
//                 tr.append("<td align='center'><a href='#' class='deletebtn' data-id=" + id +"><i  class='fa-sharp fa-solid fa-trash' style='font-size:24px; color:red'></a></i></td>");
//                 tr.append("<td align='center'><a href="+'/customer/'+ id +'/restore'+"><i class='fa-solid fa-trash-can-arrow-up' aria-hidden='true' style='font-size:24px; color:green' ></a></i></td>");
                
//                 $("#cbody").append(tr);
//             });
//         },
//         error: function () {
//             console.log("AJAX load did not work");
//             alert("error");
//         },
//     });// end of get customer

//     $("#myFormSubmit").on("click", function (e) {
//         e.preventDefault();
//         var data = $("#cform").serialize();
//         console.log(data);
//         $.ajax({
//             type: "POST",
//             url: "/api/customer",
//             data: data,
//             headers: {
//                 "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//             },
//             dataType: "json",
//             success: function (data) {
//                 console.log(data);
//                 // $("myModal").modal("hide");
//                 $("#myModal").each(function () {
//                     $(this).modal("hide");
//                 });
//                 var tr = $("<tr>");
//                 tr.append($("<td>").html(data.id));
//                 tr.append($("<td>").html(data.title));
//                 tr.append($("<td>").html(data.fname));
//                 tr.append($("<td>").html(data.lname));
//                 tr.append($("<td>").html(data.addressline));
//                 tr.append($("<td>").html(data.town));
//                 tr.append($("<td>").html(data.zipcode));
//                 tr.append($("<td>").html(data.phone));
//                 tr.append($("<td>").html(data.imagePath));
//                 tr.append("<td align='center'><a href='#' data-bs-toggle='modal' data-bs-target='#editModal' id='editbtn' data-id="+ data.id + "><i class='fa-solid fa-user-pen' aria-hidden='true' style='font-size:24px' ></a></i></td>");
//                 tr.append("<td align='center'><a href='#'  class='deletebtn' data-id=" + data.id +"><i  class='fa-sharp fa-solid fa-trash' style='font-size:24px; color:red' ></a></i></td>");
//                 tr.append("<td align='center'><a href="+'/customer/'+id+'/restore'+"><i class='fa-solid fa-trash-can-arrow-up' aria-hidden='true' style='font-size:24px; color:green' ></a></i></td>");
//                 $("#cbody").prepend(tr);
//             },
//             error: function (error) {
//                 console.log(error);
//             },
//         });
//     }); //end of submit

$(document).ready(function () {
    $('#ctable').DataTable({
        ajax:{
            url:"/api/customer",
            dataSrc: ""
        },
        dom:'Bfrtip',
        buttons:[
            'pdf',
            'excel',
            {
                text:'Add New Customer',
                className: 'btn btn-primary',
                action: function(e, dt, node, config){
                    $("#cform").trigger("reset");
                    $('#customerModal').modal('show');
                }
            }
        ],
        columns:[
            {data: 'customer_id'},
            {data: 'title'},
            {data: 'lname'},
            {data: 'fname'},
            {data: 'addressline'},
            {data: 'town'},
            {data: 'zipcode'},
            {data: 'phone'},
            // {data: 'users.email'},
            {data: null,
                render: function (data,type,JsonResultRow,row) {
                    return '<img src="/storage/' + JsonResultRow.imagePath + '" width="100px" height="100px">';
                },
            },
            {data: null,
                render: function (data, type, row) {
                    return "<a href='#' class='editBtn id='editbtn' data-id=" +
                        data.customer_id + "><i class='fa-solid fa-pen-to-square' aria-hidden='true' style='font-size:30px' ></i></a>";
                },
            },
            {data: null,
                render: function (data, type, row) {
                    return "<a href='#' class='deletebtn' data-id=" + data.customer_id + "><i class='fa-sharp fa-solid fa-trash' style='font-size:30px; color:red'></a></i>";
                },
            },
        ]
        
    })//end datatables

// }); //end of document


$("#customerSubmit").on("click", function (e) {
    e.preventDefault();
    // var data = $("#iform").serialize();
    var data = $('#cform')[0];
    console.log(data);
    let formData = new FormData(data);

    console.log(formData);
    for (var pair of formData.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
    }

    $.ajax({
        type: "POST",
        url: "/api/customer",
        data: formData,
        contentType: false,
        processData: false,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        dataType:"json", 


        
        success:function(response){
            console.log(data);
            $("#customerModal").modal("hide");

            var $ctable = $('#ctable').DataTable();
            $ctable.row.add(data.customer).draw(false); 
            // if (response == 'success') {
               
            // } else if (response == 'errors') {
            //     jQuery.each(data.errors, function(key, value){
            //         jQuery('.alert-danger').show();
            //         jQuery('.alert-danger').append('<p>'+value+'</p>');
            //     });
            // }
        },

        error:function (error){
            console.log(error);
        }
    })
});


$("#ctable tbody").on("click", "a.editBtn", function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#editCustomerModal').modal('show');


    $.ajax({
        type: "GET",
        url: "api/customer/" + id + "/edit",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function(data){
               console.log(data);
               $("#cccustomer_id").val(data.customer_id);
               $("#cctitle").val(data.title);
               $("#ccfname").val(data.fname);
               $("#cclname").val(data.lname);
               $("#ccaddressline").val(data.addressline);
               $("#cctown").val(data.town);
               $("#cczipcode").val(data.zipcode);
               $("#ccphone").val(data.phone);
            //    $("#ccemail").val(data.email);
            },
            error: function(){
                console.log('AJAX load did not work');
                alert("error");
            }
        });
    });//end edit fetch
    
    $("#updatebtnCustomer").on('click', function(e) {
        e.preventDefault();
        var id = $('#cccustomer_id').val();
        //var data = $("#updateItemform").serialize();
        console.log(data);

        var table =$('#ctable').DataTable();
        var cRow = $("tr td:contains(" + id + ")").closest('tr');
        var data =$("#cusform").serialize();

        $.ajax({
            type: "PUT",
            url: "api/customer/"+ id,
            // url: `api/customer/${id}`,
            data: data,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: "json",
            success: function(data) {
                console.log(data);
                $('#editCustomerModal').modal("hide");
                table.row(cRow).data(data).invalidate().draw(false);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });//end update


    $("#ctable tbody").on("click", "a.deletebtn", function (e) {
        var table = $('#ctable').DataTable();
        var id = $(this).data('id');
        var $row = $(this).closest('tr');
        console.log(id);

        e.preventDefault();
        bootbox.confirm({
            message: "Do you want to delete this customer?",
            buttons: {
                confirm: {
                    label: "Yes",
                    className: "btn-success",
                },
                cancel: {
                    label: "No",
                    className: "btn-danger",
                },
            },
            callback: function (result) {
                if (result)
                    $.ajax({
                        type: "DELETE",
                        url: "/api/customer/" + id,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            
                            $row.fadeOut(4000, function(){
                                table.row($row).remove().draw(false)
                            });

                            bootbox.alert(data.success)
                        },

                        error: function (error) {
                            console.log(error);
                        },
                    });
            },
        });
    });//DELETE

}); // end of document

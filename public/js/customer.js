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
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataSrc: ""
        },
        dom:'Bfrtip',
        buttons:[
            'pdf',
            'excel',
            // {
            //     text:'Add New Customer',
            //     className: 'btn btn-primary',
            //     action: function(e, dt, node, config){
            //         $("#cform").trigger("reset");
            //         $('#customerModal').modal('show');
            //     }
            // }
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
            // {data: null,
            //     render: function (data, type, row) {
            //         return "<a href='#' class='editBtn id='editbtn' data-id=" +
            //             data.customer_id + "><i class='fa-solid fa-pen-to-square' aria-hidden='true' style='font-size:30px' ></i></a>";
            //     },
            // },
            {data: null,
                render: function (data, type, row) {
                    if(data.deleted_at)
                    return "<span class='badge rounded-pill bg-secondary'>Deactivated</span>";
                    else
                    return "<span class='badge rounded-pill bg-success'>Active</span>";
                }, orderable: false, searchable: false
            },
            {data: null,
                render: function (data, type, row) {
                    if(data.deleted_at)
                    return "<a href='#' class='restorebtn' data-id=" + data.customer_id + "><i class='fa-solid fa-rotate-right' style='font-size:30px; color:primary'></a></i>";
                    else 
                    return "<a href='#' class='deletebtn' data-id=" + data.customer_id + "><i class='fa-sharp fa-solid fa-trash' style='font-size:30px; color:red'></a></i>";
                },  orderable: false, searchable: false
            },
        ]
        
    })//end datatables

// }); //end of document


$("#customerCreateBtn").on("click", function (e) {
    $('#customerModal').modal('show');
});  

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
        accepts: {
            json: 'application/json'
        },
        success:function(data){
            
            if (data.errors) {
                // jQuery.each(data.errors, function(key, value){
                // jQuery('.alert-danger').show();
                // jQuery('.alert-danger').append('<p>'+value+'</p>');
                // });
                bootbox.alert({
                    message: data.errors,
                    className: 'rubberBand animated'});
            } else {
                console.log(data);
                $("#customerModal").modal("hide");
                
                var $ctable = $('#ctable').DataTable();
                $ctable.row.add(data.customer).draw(false); 
                sessionStorage.setItem('token',data.token);
            }
        },

        error:function (error){
            console.log(error);
        }
    })
});

$("#editCustomerBtn").on("click", function (e) {
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
               $("#cclname").val(data.lname);
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
    });//end edit fetch
    
    $("#updatebtnCustomer").on('click', function(e) {
        e.preventDefault();
        // var id = $('#cccustomer_id').val();
        // //var data = $("#updateItemform").serialize();
        // console.log(data);

        // var table =$('#ctable').DataTable();
        // var cRow = $("tr td:contains(" + id + ")").closest('tr');
        // var data =$("#cusform").serialize();

        var id = $('#cccustomer_id').val();
        var data = $('#cusform')[0];
        var formData = new FormData(data);
        var table = $('#ctable').DataTable();
        console.log(data);

        $.ajax({
            type: "POST",
            url: "api/customer/update/"+ id,
            data: formData,
            contentType: false,
            processData: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: "json",
            success: function(data) {
                console.log(data);
                $('#editCustomerModal').modal("hide");
                // table.row(cRow).data(data).invalidate().draw(false);
                window.location.reload();
            },
            error: function(error) {
                console.log(error);
            }
        });
    });//end update

    // $("#updatebtnCustomer").on('click', function(e) {
    //     e.preventDefault();
    //     var id = $('#cccustomer_id').val();
    //     var data = $('#cusform')[0];
       
    //     var formData = new FormData(data);
    //     //var data = $("#updateItemform").serialize();

    //     var table =$('#ctable').DataTable();
    //     console.log(data);
    //     // var cRow = $("tr td:contains(" + id + ")").closest('tr');
    //     // var data =$("#cusform").serialize();

    //     $.ajax({
    //         type: "POST",
    //         url: "api/customer/"+ id,
    //         data: formData,
    //         contentType: false,
    //         processData: false,
    //         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    //         dataType: "json",
    //         success: function(data) {
    //             console.log(data);
    //             $('#editCustomerModal').modal("hide");
    //             // table.row(cRow).data(data).invalidate().draw(false);
    //             window.location.reload();
    //         },
    //         error: function(error) {
    //             console.log(error);
    //         }
    //     });
    // });//end update


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
                            
                            // $row.fadeOut(4000, function(){
                            //     table.row($row).remove().draw(false)
                            // });
                            window.location.reload();

                            bootbox.alert(data.success)
                        },

                        error: function (error) {
                            console.log(error);
                        },
                    });
            },
        });
    });//DELETE

    $("#ctable tbody").on("click", "a.restorebtn", function (e) {
        var table = $('#ctable').DataTable();
        var id = $(this).data('id');
        var $row = $(this).closest('tr');
        // var cRow = $("tr td:contains(" + id + ")").closest('tr');
        console.log(id);

        e.preventDefault();
        bootbox.confirm({
            message: "Do you want to restore this customer?",
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
                        type: "GET",
                        url: "/api/customer/restore/" + id,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            
                            // $row.fadeOut(4000, function(){
                            //     table.row($row).remove().draw(false)
                            // });
                            window.location.reload();
                            // table.row(cRow).data(data).invalidate().draw(false);
                            bootbox.alert(data.success)
                        },

                        error: function (error) {
                            console.log(error);
                        },
                    });
            },
        });
    });

}); // end of document

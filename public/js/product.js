$(document).ready(function () {
    $('#ptable').DataTable({
        ajax:{
            url:"/api/product",
            dataSrc: ""
        },
        dom:'Bfrtip',
        buttons:[
            'pdf',
            'excel',
            {
                text:'Add New Product',
                className: 'btn btn-primary',
                action: function(e, dt, node, config){
                    $("#pform").trigger("reset");
                    $('#productModal').modal('show');
                }
            }
        ],
        columns:[
            {data: 'product_id'},
            {data: 'name'},
            {data: 'description'},
            {data: 'type'},
            {data: 'brand'},
            {data: 'price'},
            {data: null,
                render: function (data,type,JsonResultRow,row) {
                    return '<img src="/storage/' + JsonResultRow.imagePath + '" width="100px" height="100px">';
                }, orderable: false, searchable: false
            },
            {data: null,
                render: function (data, type, row) {
                    if(data.deleted_at)
                    return "<span class='badge rounded-pill bg-secondary'>Not Available</span>";
                    else
                    return "<span class='badge rounded-pill bg-success'>Available</span>";
                }, orderable: false, searchable: false
            },
            {data: null,
                render: function (data, type, row) {
                    if(data.deleted_at)
                    return "<i class='fa-solid fa-pen-to-square' aria-hidden='true' style='font-size:30px; color:gray'></i>";
                    else
                    return "<a href='#' class='editBtn id='editbtn' data-id=" + data.product_id + "><i class='fa-solid fa-pen-to-square' aria-hidden='true' style='font-size:30px' ></i></a>";
                },
            },
            {data: null,
                render: function (data, type, row) {
                    if(data.deleted_at)
                    return "<a href='#' class='restorebtn' data-id=" + data.product_id + "><i class='fa-solid fa-rotate-right' style='font-size:30px; color:primary'></a></i>";
                    else 
                    return "<a href='#' class='deletebtn' data-id=" + data.product_id + "><i class='fa-sharp fa-solid fa-trash' style='font-size:30px; color:red'></a></i>";
                },  orderable: false, searchable: false
            },
            // {data: null,
            //     render: function (data, type, row) {
            //         return "<a href='#' class='deletebtn' data-id=" + data.product_id + "><i class='fa-sharp fa-solid fa-trash' style='font-size:30px; color:red'></a></i>";
            //     },  orderable: false, searchable: false
            // },
            // {data: null,
            //     render: function (data, type, row) {
            //         return "<a href='#' class='restorebtn' data-id=" + data.product_id + "><i class='fa-solid fa-rotate-right' style='font-size:30px; color:red'></a></i>";
            //     },  orderable: false, searchable: false
            // },
        ]
        
    })//end datatables

    
$("#productSubmit").on("click", function (e) {
    e.preventDefault();
    // var data = $("#iform").serialize();
    var data = $('#pform')[0];
    console.log(data);
    let formData = new FormData(data);

    console.log(formData);
    for (var pair of formData.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
    }

    $.ajax({
        type: "POST",
        url: "/api/product",
        data: formData,
        contentType: false,
        processData: false,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        dataType:"json", 

        success:function(data){
               console.log(data);
               $("#productModal").modal("hide");

               var $ptable = $('#ptable').DataTable();
               $ptable.row.add(data.product).draw(false); 

        },
        error:function (error){
            console.log(error);
        }
    })
});

$("#ptable tbody").on("click", "a.editBtn", function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#editProductModal').modal('show');
    
    $.ajax({
        type: "GET",
        url: "api/product/" + id + "/edit",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function(data){
               console.log(data);
               $("#testing").val(data.name);
               $("#ppproduct_id").val(data.product_id);
               $("#ppname").val(data.name);
               $("#ppdescription").val(data.description);
               $("#pptype").val(data.type);
               $("#ppbrand").val(data.brand);
               $("#ppprice").val(data.price);
               $("#ppquantity").val(data.quantity);
            //    $("#ppimagePath").val(data.imagePath);
               //    .html(`<img src="storage/images/${data.uploads}" width="100" class="img-fluid img-thumbnail">`);
            },
            error: function(){
                console.log('AJAX load did not work');
                alert("error");
            }
        });
    });//end edit fetch

    $("#updatebtnProduct").on('click', function(e) {
        e.preventDefault();
        var id = $('#ppproduct_id').val();
        var data = $('#proform')[0];
        var formData = new FormData(data);
        var table = $('#ptable').DataTable();
        console.log(data);

        $.ajax({    
            type: "POST",
            url: "api/product/update/"+ id,
            data: formData,
            contentType: false,
            processData: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: "json",
            success: function(data) {
                console.log(data);
                $('#editProductModal').modal("hide");
                window.location.reload();
                // table.row(cRow).data(data).invalidate().draw(false);
                bootbox.alert(data.success)
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

        
    $("#ptable tbody").on("click", "a.deletebtn", function (e) {
        var table = $('#ptable').DataTable();
        var id = $(this).data('id');
        var $row = $(this).closest('tr');
        console.log(id);

        e.preventDefault();
        bootbox.confirm({
            message: "Do you want to delete this product?",
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
                        url: "/api/product/" + id,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            // $row.fadeOut(4000, function(){
                            //     table.row($row).reload()
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

    $("#ptable tbody").on("click", "a.restorebtn", function (e) {
        var table = $('#ptable').DataTable();
        var id = $(this).data('id');
        var $row = $(this).closest('tr');
        console.log(id);

        e.preventDefault();
        bootbox.confirm({
            message: "Do you want to restore this product?",
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
                        url: "/api/product/restore/" + id,
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
    });//RESTORE
});
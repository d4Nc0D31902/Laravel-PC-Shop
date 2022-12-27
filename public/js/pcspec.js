$(document).ready(function () {
    $('#pctable').DataTable({
        ajax:{
            url:"/api/pcspec",
            dataSrc: ""
        },
        dom:'Bfrtip',
        buttons:[
            'pdf',
            'excel',
            {
                text:'Add New PC-Spec',
                className: 'btn btn-primary',
                action: function(e, dt, node, config){
                    $("#pcform").trigger("reset");
                    $('#pcCreateModal').modal('show');
                }
            }
        ],
        columns:[
            {data: 'pc_id'},
            {data: 'customer_id'},
            {data: 'cpu'},
            {data: 'motherboard'},
            {data: 'gpu'},
            {data: 'ram'},
            {data: 'hdd'},
            {data: 'sdd'},
            {data: 'psu'},
            {data: 'pc_case'},
            {data: null,
                render: function (data,type,JsonResultRow,row) {
                    return '<img src="/storage/' + JsonResultRow.imagePath + '" width="100px" height="100px">';
                }, orderable: false, searchable: false
            },
            {data: null,
                render: function (data, type, row) {
                    return "<a href='#' class='editBtn id='editbtn' data-id=" +
                        data.customer_id + "><i class='fa-solid fa-pen-to-square' aria-hidden='true' style='font-size:30px' ></i></a>";
                }, orderable: false, searchable: false
            },
            {data: null,
                render: function (data, type, row) {
                    return "<a href='#' class='deletebtn' data-id=" + data.customer_id + "><i class='fa-sharp fa-solid fa-trash' style='font-size:30px; color:red'></a></i>";
                }, orderable: false, searchable: false
            },
            {data: null,
                render: function (data, type, row) {
                    return "<a href='#' class='restorebtn' data-id=" + data.customer_id + "><i class='fa-solid fa-rotate-right' style='font-size:30px; color:red'></a></i>";
                },  orderable: false, searchable: false
            },
        ]
        
    })//end datatables

    $("#pcspecSubmit").on("click", function (e) {
        e.preventDefault();
        // var data = $("#iform").serialize();
        var data = $('#pcform')[0];
        console.log(data);
        let formData = new FormData(data);
    
        console.log(formData);
        for (var pair of formData.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
        }
    
        $.ajax({
            type: "POST",
            url: "/api/pcspec",
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
                    bootbox.alert({
                        message: data.errors,
                        className: 'rubberBand animated'});
                } else {
                    console.log(data);
                    $("#pcCreateModal").modal("hide");
                    
                    var $pctable = $('#pctable').DataTable();
                    $pctable.row.add(data.pcspecs).draw(false); 

                    bootbox.alert({
                        message: data.success,
                        className: 'rubberBand animated'});
                }
            },
            error:function (error){
                console.log(error);
            }
        })
    });


    $("#pctable tbody").on("click", "a.deletebtn", function (e) {
        var table = $('#pctable').DataTable();
        var id = $(this).data('id');
        var $row = $(this).closest('tr');
        console.log(id);

        e.preventDefault();
        bootbox.confirm({
            message: "Do you want to delete this pc-spec?",
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
                        url: "/api/pcspec/" + id,
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

    $("#pcCreateBtn").on("click", function (e) {
        $('#pcCreateModal').modal('show');
    });  
    
});
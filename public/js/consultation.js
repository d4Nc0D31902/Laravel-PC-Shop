$(document).ready(function () {
    $('#contable').DataTable({
        ajax:{
            url:"/api/consultation",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataSrc: ""
        },
        dom:'Bfrtip',
        buttons:[
            'pdf',
            'excel',
            {
                text:'Add New Consultation',
                className: 'btn btn-primary',
                action: function(e, dt, node, config){
                    $("#conform").trigger("reset");
                    $('#consultationModal').modal('show');
                }
            }
        ],
        columns:[
            {data: 'id'},
            {data: 'pc_id'},
            {data: 'employee_id'},
            {data: 'comment'},
            {data: 'price'},
            {data: 'created_at'},
            // {data: null,
            //     render: function (data, type, row) {
            //         if(data.deleted_at)
            //         return "<a href='#' class='restorebtn' data-id=" + data.customer_id + "><i class='fa-solid fa-rotate-right' style='font-size:30px; color:primary'></a></i>";
            //         else 
            //         return "<a href='#' class='deletebtn' data-id=" + data.customer_id + "><i class='fa-sharp fa-solid fa-trash' style='font-size:30px; color:red'></a></i>";
            //     },  orderable: false, searchable: false
            // },
        ]
        
    })//end datatables

    $("#consultationSubmit").on("click", function (e) {
        e.preventDefault();
        var data = $('#conform')[0];
        console.log(data);
        let formData = new FormData(data);
    
        console.log(formData);
        for (var pair of formData.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
        }
    
        $.ajax({
            type: "POST",
            url: "/api/consultation",
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
                    $("#consultationModal").modal("hide");
                    
                    var $contable = $('#contable').DataTable();
                    $contable.row.add(data.consultation).draw(false); 
                }
            },
    
            error:function (error){
                console.log(error);
            }
        })
    });
}); //end of document
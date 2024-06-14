// $("#loginbtn").on("click", function (e) {
//     e.preventDefault();
//     $("#loginModal").show();
// });
$(document).ready(function () {
    $("#loginbtnSubmit").on("click", function (e) {
        e.preventDefault();

        var data = $("#loginForm")[0];
        var formData = new FormData(data);
        console.log(data);

        $.ajax({
            type: "POST",
            url: "api/signin",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            accepts: {
                json: "application/json",
            },
            success: function (data) {
                console.log(data);
                // table.row(cRow).data(data).invalidate().draw(false);

                if (data.errors) {
                    bootbox.alert({
                        message: data.errors,
                        className: "rubberBand animated",
                    });
                    // setTimeout(function(){
                    //     window.location.href = "/profile";
                    //  }, 1000);
                    // window.location.href = "/profile";
                    // window.location.reload();
                } else {
                    bootbox.alert({
                        message: data.success,
                        className: "rubberBand animated",
                    });

                    setTimeout(function () {
                        window.location.href = "/profile";
                    }, 1000);

                    // sessionStorage.setItem('token',data.token);
                }
            },
            error: function (error) {
                console.log(error);
                bootbox.alert(error);
            },
        });
    }); //login

    $("#logoutbtnSubmit").on("click", function (e) {
        e.preventDefault();

        var data = $("#loginForm")[0];
        var formData = new FormData(data);
        console.log(data);

        $.ajax({
            type: "GET",
            url: "api/logout",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                // table.row(cRow).data(data).invalidate().draw(false);
                bootbox.alert(data.success);
                setTimeout(function () {
                    window.location.href = "/signin";
                }, 1000);
            },
            error: function (error) {
                console.log(error);
            },
        });
    }); //end update
});

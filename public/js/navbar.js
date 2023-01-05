$(document).ready(function () {
    $('#employee-crud').hide();
    $('#customer-crud').hide();

    $("#btnCustomer").on('click', function(e) {
        e.preventDefault();
        $('#employee-crud').hide();
        $('#customer-crud').show();
    });

    $("#btnEmployee").on('click', function(e) {
        e.preventDefault();
        $('#employee-crud').show();
        $('#customer-crud').hide();
    });
});
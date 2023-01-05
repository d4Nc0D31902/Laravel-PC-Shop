$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "/api/dashboard/title-chart",
        dataType: "json",
        success: function (data) {
            console.log(data);
            var myBarChart = "<div class='product'>";
            var ctx = document.getElementById("titleChart");
            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Number of Active Customers',
                        data: data.data,
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(255, 99, 132, 0.2)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255,99,132,1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                      y: {
                        beginAtZero: true
                      }
                    }
                  },
            });
            
        },
        error: function (error) {
            console.log(error);
        }
    });

    $.ajax({
        type: "GET",
        url: "/api/dashboard/sales-chart",
        dataType: "json",
        success: function (data) {
            console.log(data);
            var ctx = document.getElementById("salesChart");
            var myBarChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Monthly sales',
                        data: data.data,
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(255, 99, 132, 0.2)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255,99,132,1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                      y: {
                        beginAtZero: true
                      }
                    }
                  },
            });
            
        },
        error: function (error) {
            console.log(error);
        }
    });

    $.ajax({
        type: "GET",
        url: "/api/dashboard/products-chart",
        dataType: "json",
        success: function (data) {
            console.log(data);
            var ctx = document.getElementById("productsChart");
            // var ctx = "<div class='product'>";
            var myBarChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Numbers of Products Sold',
                        data: data.data,
                        backgroundColor: () => {
                             //generates random colours and puts them in string
                             var size = {
                                'width':400,
                                'height':300};
                             var colors = [];
                            for (var i = 0; i < data.data.length; i++) {
                              var letters = '0123456789ABCDEF'.split('');
                              var color = '#';
                              for (var x = 0; x < 6; x++) {
                                color += letters[Math.floor(Math.random() * 16)];
                              }
                              colors.push(color);
                            }

                           

                            return colors;
                          },

                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255,99,132,1)'
                        ],
                        borderWidth: 1,
                        responsive: true,
                        // hoverBackgroundColor: colors,
                    }]
                },
                
            });
            
        },
        error: function (error) {
            console.log(error);
        }
    });

    $.ajax({
        type: "GET",
        url: "/api/dashboard/dates-chart",
        dataType: "json",
        success: function (data) {
            console.log(data);
            var ctx = document.getElementById("datesChart");
            var myBarChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Orders-Quantity Date',
                        data: data.data,
                        
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(255, 99, 132, 0.2)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255,99,132,1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                      y: {
                        beginAtZero: true
                      }
                    }
                  },
            });
            
        },
        error: function (error) {
            console.log(error);
        }
    });
});
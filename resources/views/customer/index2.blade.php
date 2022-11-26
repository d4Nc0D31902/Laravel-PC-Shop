<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"
        integrity="sha512-RdSPYh1WA6BF0RhpisYJVYkOyTzK4HwofJ3Q7ivt/jkpW6Vc8AurL1R+4AUcvn9IwEKAPm/fk7qFZW3OuiUDeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="/js/customer.js"></script>
</head>

<body>

    <div class="container">
        <button type="button" class="btn btn-info btn-lg" data-bs-toggle="modal" data-bs-target="#myModal">ADD <span
                class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>

        {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
            Launch demo modal
        </button> --}}

        <div class="table-responsive">
            <table id="ctable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Customer I.D</th>
                        <th>Title</th>
                        <th>Last name</th>
                        <th>First name</th>
                        <th>Address</th>
                        <th>Zipcode</th>
                        <th>Town</th>
                        <th>Phone</th>
                        <th>Image</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th>Restore</th>
                    </tr>
                </thead>
                <tbody id="cbody">
                </tbody>
            </table>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create new customer</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="cform" action="#" enctype="multipart/form-data">

                        {{-- <div class="form-group">
                            <label for="title" class="control-label">Title</label>
                            <input type="text" class="form-control" id="titulo" name="title">
                        </div> --}}

                        <div class="row">
                            <div class="col">
                                <label for="lname" class="control-label">Title</label>
                                <input type="text" class="form-control" placeholder="Mr." aria-label="Title" id="title" name="title">
                            </div>
                            <div class="col">
                                <label for="lname" class="control-label">First name</label>
                                <input type="text" class="form-control" placeholder="Juan" aria-label="First name" id="fname" name="fname">
                            </div>
                            <div class="col">
                                <label for="lname" class="control-label">Last name</label>
                                <input type="text" class="form-control" placeholder="Dela Cruz" aria-label="Last name" id="lname" name="lname">
                            </div>  
                        </div>

                        <div class="row mt-2">
                            <div class="col">
                                <label for="lname" class="control-label">Addressline</label>
                                <input type="text" class="form-control" placeholder="Lot 24A Block 52 New Lower..." aria-label="Addressline" id="addressline" name="addressline">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col">
                                <label for="lname" class="control-label">Town</label>
                                <input type="text" class="form-control" placeholder="Taguig City..." aria-label="Town" id="town" name="town">
                            </div>
                            <div class="col">
                                <label for="lname" class="control-label">Zipcode</label>
                                <input type="text" class="form-control" placeholder="1918" aria-label="Zipcode" id="zipcode" name="zipcode">
                            </div>
                            <div class="col">
                                <label for="lname" class="control-label">Phone</label>
                                <input type="text" class="form-control" placeholder="092187162..." aria-label="Phone" id="phone" name="phone">
                            </div>  
                        </div>

                        <div class="row mt-2">
                            <div class="col">
                                <label for="inputEmail4" class="control-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="example123@email.com">
                            </div>
                            <div class="col">
                                <label for="inputPassword4" class="control-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col">
                                <label for="lname" class="control-label">Profile Picture</label>
                                <div class="input-group">
                                    <input type="file" class="form-control" id="imagePath" name="imagePath">
                                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                  </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    <button id="myFormSubmit" type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    </div> <script src="/js/customer.js"></script>
</body>

</html>


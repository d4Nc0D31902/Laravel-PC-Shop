@extends('layouts.base')
@section('body')

<div id="employee-crud">
<h1 class="display-6 fw-bold">Employee CRUD</h1>
<div class="alert alert-success" style="display:none"></div>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="container-fluid py-4 bg-light rounded-3 shadow-sm">
    <div class="container">
        <div class="table-responsive">
            <table id="emtable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Employee I.D</th>
                        <th>Title</th>
                        <th>Last name</th>
                        <th>First name</th>
                        <th>Address</th>
                        <th>Zipcode</th>
                        <th>Town</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="embody">
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- start of create --}}
<div class="modal fade" id="employeeModal" role="dialog" style="display:none">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="alert alert-danger" style="display:none"></div>
            <div class="modal-body">
                <form id="emform" method="post" action="#" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col">
                            <label for="elname" class="control-label">Title</label>
                            <input type="text" class="form-control" placeholder="Mr." aria-label="Title" id="etitle" name="title">
                        </div>
                        <div class="col">
                            <label for="elname" class="control-label">First name</label>
                            <input type="text" class="form-control" placeholder="Juan" aria-label="First name" id="efname" name="fname">
                        </div>
                        <div class="col">
                            <label for="elname" class="control-label">Last name</label>
                            <input type="text" class="form-control" placeholder="Dela Cruz" aria-label="Last name" id="elname" name="lname">
                        </div>  
                    </div>

                    <div class="row mt-2">
                        <div class="col">
                            <label for="eaddressline" class="control-label">Addressline</label>
                            <input type="text" class="form-control" placeholder="Lot 24A Block 52 New Lower..." aria-label="Addressline" id="eaddressline" name="addressline">
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col">
                            <label for="etown" class="control-label">Town</label>
                            <input type="text" class="form-control" placeholder="Taguig City..." aria-label="Town" id="etown" name="town">
                        </div>
                        <div class="col">
                            <label for="ezipcode" class="control-label">Zipcode</label>
                            <input type="text" class="form-control" placeholder="1918" aria-label="Zipcode" id="ezipcode" name="zipcode">
                        </div>
                        <div class="col">
                            <label for="ephone" class="control-label">Phone</label>
                            <input type="text" class="form-control" placeholder="092187162..." aria-label="Phone" id="ephone" name="phone">
                        </div>  
                    </div>

                    <div class="row mt-2">
                        <div class="col">
                            <label for="eemail" class="control-label">Email</label>
                            <input type="email" class="form-control" id="eemail" name="email" placeholder="example123@email.com">
                        </div>
                        <div class="col">
                            <label for="epassword" class="control-label">Password</label>
                            <input type="password" class="form-control" id="epassword" name="password">
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col">
                            <label for="imagePath" class="control-label">Profile Picture</label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="imagePath" name="uploads">
                                <label class="input-group-text" for="inputGroupFile02">Upload</label>
                              </div>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal"><i class="fa-sharp fa-solid fa-circle-xmark"></i> Close</button>
                <button id="employeeSubmit" type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save</button>
            </div>
        </div>
    </div>
</div>
{{-- end of create --}}

{{-- start of edit --}}
<div class="modal fade" id="adminModal" role="dialog" style="display:none">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="adform" method="POST" action="#" enctype="multipart/form-data">
                    <label for="eeemployee_id" class="control-label">Employee ID</label>
                    <input type="text" class="form-control" id="eeemployee_id" name="employee_id" readonly>
                    <div class="row mt-2">
                        <div class="col">
                        <label class="control-label">Selec a role:</label>
                        <select class="form-select" aria-label="Default select example" id="eerole" name="role">
                            <option value="employee">Employee</option>
                            <option value="admin">Admin</option>
                        </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal"><i class="fa-sharp fa-solid fa-circle-xmark"></i> Close</button>
                <button id="updatebtnAdmin" type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Update</button>
            </div>
        
        </div>
    </div>
    </div>
    </form>
    {{-- end of edit --}}

    <br>
</div>
@endsection
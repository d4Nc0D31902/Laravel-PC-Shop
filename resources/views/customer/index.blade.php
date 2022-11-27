@extends('layouts.base')
@section('body')
<div class="container">
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

{{-- start of create --}}
<div class="modal fade" id="customerModal" role="dialog" style="display:none">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="alert alert-danger" style="display:none"></div>
            <div class="modal-body">
                <form id="cform" method="post" action="#" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col">
                            <label for="clname" class="control-label">Title</label>
                            <input type="text" class="form-control" placeholder="Mr." aria-label="Title" id="ctitle" name="title">
                        </div>
                        <div class="col">
                            <label for="clname" class="control-label">First name</label>
                            <input type="text" class="form-control" placeholder="Juan" aria-label="First name" id="cfname" name="fname">
                        </div>
                        <div class="col">
                            <label for="clname" class="control-label">Last name</label>
                            <input type="text" class="form-control" placeholder="Dela Cruz" aria-label="Last name" id="clname" name="lname">
                        </div>  
                    </div>

                    <div class="row mt-2">
                        <div class="col">
                            <label for="caddressline" class="control-label">Addressline</label>
                            <input type="text" class="form-control" placeholder="Lot 24A Block 52 New Lower..." aria-label="Addressline" id="caddressline" name="addressline">
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col">
                            <label for="ctown" class="control-label">Town</label>
                            <input type="text" class="form-control" placeholder="Taguig City..." aria-label="Town" id="ctown" name="town">
                        </div>
                        <div class="col">
                            <label for="czipcode" class="control-label">Zipcode</label>
                            <input type="text" class="form-control" placeholder="1918" aria-label="Zipcode" id="czipcode" name="zipcode">
                        </div>
                        <div class="col">
                            <label for="cphone" class="control-label">Phone</label>
                            <input type="text" class="form-control" placeholder="092187162..." aria-label="Phone" id="cphone" name="phone">
                        </div>  
                    </div>

                    <div class="row mt-2">
                        <div class="col">
                            <label for="cemail" class="control-label">Email</label>
                            <input type="email" class="form-control" id="cemail" name="email" placeholder="example123@email.com">
                        </div>
                        <div class="col">
                            <label for="cpassword" class="control-label">Password</label>
                            <input type="password" class="form-control" id="cpassword" name="password">
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
                <button id="customerSubmit" type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save</button>
            </div>
        </div>
    </div>
</div>
{{-- end of create --}}

{{-- start of edit --}}
<div class="modal fade" id="editCustomerModal" role="dialog" style="display:none">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="cusform" method="POST" action="#" enctype="multipart/form-data">
                    {{-- <input type="hidden"> --}}
                    <label for="cccustomer_id" class="control-label">Customer ID</label>
                    <input type="text" class="form-control" id="cccustomer_id" name="customer_id" readonly>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="cclname" class="control-label">Title</label>
                            <input type="text" class="form-control" placeholder="Mr." id="cctitle" name="title">
                        </div>
                        <div class="col">
                            <label for="cclname" class="control-label">First name</label>
                            <input type="text" class="form-control" placeholder="Juan" id="ccfname" name="fname">
                        </div>
                        <div class="col">
                            <label for="cclname" class="control-label">Last name</label>
                            <input type="text" class="form-control" placeholder="Dela Cruz" id="cclname" name="lname">
                        </div>  
                    </div>

                    <div class="row mt-2">
                        <div class="col">
                            <label for="ccaddressline" class="control-label">Addressline</label>
                            <input type="text" class="form-control" placeholder="Lot 24A Block 52 New Lower..." id="ccaddressline" name="addressline">
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col">
                            <label for="cctown" class="control-label">Town</label>
                            <input type="text" class="form-control" placeholder="Taguig City..." aria-label="Town" id="cctown" name="town">
                        </div>
                        <div class="col">
                            <label for="cczipcode" class="control-label">Zipcode</label>
                            <input type="text" class="form-control" placeholder="1918" aria-label="Zipcode" id="cczipcode" name="zipcode">
                        </div>
                        <div class="col">
                            <label for="ccphone" class="control-label">Phone</label>
                            <input type="text" class="form-control" placeholder="092187162..." aria-label="Phone" id="ccphone" name="phone">
                        </div>  
                    </div>

                    {{-- <div class="row mt-2">
                        <div class="col">
                            <label for="ccemail" class="control-label">Email</label>
                            <input type="email" class="form-control" id="ccemail" name="email" placeholder="example123@email.com">
                        </div>
                        <div class="col">
                            <label for="ccpassword" class="control-label">Password</label>
                            <input type="password" class="form-control" id="ccpassword" name="password">
                        </div>
                    </div> --}}

                    <div class="row mt-2">
                        <div class="col">
                            <label for="ccimagePath" class="control-label">Profile Picture</label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="ccimagePath" name="uploads">
                                <label class="input-group-text" for="inputGroupFile02">Upload</label>
                              </div>
                        </div>
                    </div>
    
                    
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal"><i class="fa-sharp fa-solid fa-circle-xmark"></i> Close</button>
                <button id="updatebtnCustomer" type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Update</button>
            </div>
        
        </div>
    </div>
    </div>
    </form>
    {{-- end of edit --}}

@endsection
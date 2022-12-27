@extends('layouts.base')
@section('body')

<h1 class="display-6 fw-bold">Pc-Spec CRUD</h1>
<div class="container-fluid py-4 bg-light rounded-3 shadow-sm">
    <div class="container">
        <div class="table-responsive">
            <table id="pctable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Pc-spec I.D</th>
                        <th>Customer I.D</th>
                        <th>Cpu</th>
                        <th>Motherboard</th>
                        <th>Gpu</th>
                        <th>Ram</th>
                        <th>Hdd</th>
                        <th>Sdd</th>
                        <th>Psu</th>
                        <th>PC Case</th>
                        <th>Image</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th>Restore</th>
                    </tr>
                </thead>
                <tbody id="pcbody">
                </tbody>
            </table>
        </div>
    </div>
</div>

<br>

{{-- start of create --}}
<div class="modal fade" id="pcCreateModal" role="dialog" style="display:none">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New PC Spec</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="alert alert-danger" style="display:none"></div>
            <div class="modal-body">
                <form id="pcform" method="post" action="#" enctype="multipart/form-data">
                    <meta name="csrf-token" content="{{ csrf_token() }}" />
                    {{-- <div class="row">
                        <div class="col">
                            <label for="caddressline" class="control-label">Owner Name/Id</label>
                            <input type="text" class="form-control" placeholder="Juan Dela Cruz 1..." aria-label="Addressline" id="caddressline" name="addressline">
                        </div>
                    </div> --}}
                    
                    <div class="col-md-4 mb-3">
                        <label for="customer_id">Owner Name</label>
                        <select class="form-control" id="customer_id" name="customer_id" required="">
                            @foreach($customers as $id => $customer)
                            <option value="{{ $id }}"><a> {{$customer}} </a></option>
                            @endforeach
                        </select>
                    </div>
                      
                    {{-- <div class="col-md-4 mb-3">
                    <label for="customer_id">Owner Name</label>
                    <select class="form-control" id="customer_id" name="customer_id" required="">
                        @foreach($customers as $id => $customer)
                        <option value="{{$id}}"><a> {{$customer}} </a></option>
                        @endforeach
                    </select>
                    </div> --}}

                    <div class="row mt-2">
                        <div class="col">
                            <label for="pccpu" class="control-label">Processor (CPU)</label>
                            <input type="text" class="form-control" placeholder="Intel i3-10100f..." id="pccpu" name="cpu">
                        </div>
                        <div class="col">
                            <label for="pcmotherboard" class="control-label">Motherboard</label>
                            <input type="text" class="form-control" placeholder="MSI Z790 Edge... " id="pcmotherboard" name="motherboard">
                        </div>
                        <div class="col">
                            <label for="pcgpu" class="control-label">Graphic Card (GPU)</label>
                            <input type="text" class="form-control" placeholder="GTX 1060ti..." id="pcgpu" name="gpu">
                        </div>  
                    </div>

                    <div class="row mt-2">
                        <div class="col">
                            <label for="pcram" class="control-label">Ram</label>
                            <input type="text" class="form-control" placeholder="Kingston 16gb 2666mhz..." id="pcram" name="ram">
                        </div>
                        <div class="col">
                            <label for="pchdd" class="control-label">HDD</label>
                            <input type="text" class="form-control" placeholder="Seagate 2TB Skyhawk..." id="pchdd" name="hdd">
                        </div>
                        <div class="col">
                            <label for="pcsdd" class="control-label">SDD</label>
                            <input type="text" class="form-control" placeholder="Gigabyte 2TB..." id="pcsdd" name="sdd">
                        </div>  
                    </div>

                    <div class="row mt-2">
                        <div class="col">
                            <label for="pcpsu" class="control-label">Powersupply (PSU)</label>
                            <input type="text" class="form-control" id="pcpsu" name="psu" placeholder="Corsair CV Series CV550 - 80 Plus Bronze...">
                        </div>
                        <div class="col">
                            <label for="pcpc_case" class="control-label">PC Case</label>
                            <input type="text" class="form-control" placeholder="Asus TUF Gaming GT501 White Edition..." id="pcpc_case" name="pc_case">
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col">
                            <label for="imagePath" class="control-label">PC Picture</label>
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
                <button id="pcspecSubmit" type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save</button>
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
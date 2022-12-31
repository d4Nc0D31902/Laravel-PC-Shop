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
                <form id="pcform" method="POST" action="#" enctype="multipart/form-data">
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
<div class="modal fade" id="editPcModal" role="dialog" style="display:none">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Customer PC</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editpcform" method="POST" action="#" enctype="multipart/form-data">
                    <input type="text" class="form-control" id="ppc_id" name="pc_id" type="hidden">

                    <div class="row">
                        <div class="col">
                            <label for="name" class="control-label">Owner of PC</label>
                            <input type="text" class="form-control" id="name" name="name" readonly>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col">
                            <label for="pccpu" class="control-label">Processor (CPU)</label>
                            <input type="text" class="form-control" placeholder="Intel i3-10100f..." id="pcpu" name="cpu">
                        </div>
                        <div class="col">
                            <label for="pcmotherboard" class="control-label">Motherboard</label>
                            <input type="text" class="form-control" placeholder="MSI Z790 Edge... " id="pmotherboard" name="motherboard">
                        </div>
                        <div class="col">
                            <label for="pcgpu" class="control-label">Graphic Card (GPU)</label>
                            <input type="text" class="form-control" placeholder="GTX 1060ti..." id="pgpu" name="gpu">
                        </div>  
                    </div>

                    <div class="row mt-2">
                        <div class="col">
                            <label for="pcram" class="control-label">Ram</label>
                            <input type="text" class="form-control" placeholder="Kingston 16gb 2666mhz..." id="pram" name="ram">
                        </div>
                        <div class="col">
                            <label for="pchdd" class="control-label">HDD</label>
                            <input type="text" class="form-control" placeholder="Seagate 2TB Skyhawk..." id="phdd" name="hdd">
                        </div>
                        <div class="col">
                            <label for="pcsdd" class="control-label">SDD</label>
                            <input type="text" class="form-control" placeholder="Gigabyte 2TB..." id="psdd" name="sdd">
                        </div>  
                    </div>

                    <div class="row mt-2">
                        <div class="col">
                            <label for="pcpsu" class="control-label">Powersupply (PSU)</label>
                            <input type="text" class="form-control" id="ppsu" name="psu" placeholder="Corsair CV Series CV550 - 80 Plus Bronze...">
                        </div>
                        <div class="col">
                            <label for="pcpc_case" class="control-label">PC Case</label>
                            <input type="text" class="form-control" placeholder="Asus TUF Gaming GT501 White Edition..." id="pcase" name="pc_case">
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
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal"><i class="fa-sharp fa-solid fa-circle-xmark"></i> Close</button>
                <button id="updateBtnPc" type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Update</button>
            </div>
        
        </div>
    </div>
    </div>
    </form>
    {{-- end of edit --}}

@endsection
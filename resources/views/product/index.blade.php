@extends('layouts.base')
@section('body')

<div class="container">
    <div class="table-responsive">
        <table id="ptable" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Product I.D</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Brand</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Restore</th>
                </tr>
            </thead>
            <tbody id="pbody">
            </tbody>
        </table>
    </div>
</div>

{{-- start of create --}}
<div class="modal fade" id="productModal" role="dialog" style="display:none">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <meta name="csrf-token" content="{{ csrf_token() }}" />
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="pform" method="POST" action="#" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col">
                            <label for="pname" class="control-label">Name</label>
                            <input type="text" class="form-control" placeholder="Ex. GTX 1030" id="pname" name="name">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="pdescription" class="control-label">Description</label>
                            <input type="text" class="form-control" placeholder="Insert Information here..." id="pdescription" name="description">
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col">
                            <label for="pprice" class="control-label">Price</label>
                            <input type="text" class="form-control" placeholder="Ex. $100" id="pprice" name="price">
                        </div>
                        <div class="col">
                            <label for="pbrand" class="control-label">Brand</label>
                            <input type="text" class="form-control" placeholder="Ex. Nvidia" id="pbrand" name="brand">
                        </div>
                        <div class="col">
                            <label for="ptype" class="control-label">Type</label>
                            <input type="text" class="form-control" placeholder="Ex. GPU" id="ptype" name="type">
                        </div>  
                    </div>

                    <div class="row mt-2">
                        <div class="col">
                            <label for="imagePath" class="control-label">Product Picture</label>
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
                <button id="productSubmit" type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save</button>
            </div>
        </div>
    </div>
</div>
{{-- end of create --}}

{{-- start of edit --}}
<div class="modal fade" id="editProductModal" role="dialog" style="display:none">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="proform" method="POST" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" id="ppproduct_id" name="product_id">
                    <div class="form-group">
                        <label for="ppname" class="control-label"> Name</label>
                        <input type="text" class="form-control" id="ppname" name="name">
                    </div>
                    <div class="form-group">
                        <label for="ppdescription" class="control-label"> Description</label>
                        <input type="text" class="form-control" id="ppdescription" name="description">
                    </div>
                    
                    <div class="form-group">
                        <label for="ppprice" class="control-label"><i class="fa-solid fa-money-bill"></i> Price</label>
                        <input type="text" class="form-control" id="ppprice" name="price">
                    </div>
                    
                    <div class="form-group">
                        <label for="ppbrand" class="control-label"><i class="fa-solid fa-money-bill"></i> Brand</label>
                        <input type="text" class="form-control " id="ppbrand" name="brand" >
                    </div>
                
                    <div class="form-group">
                        <label for="pptype" class="control-label"><i class="fa-regular fa-note-sticky"></i> Type</label>
                        <input type="text" class="form-control " id="pptype" name="type" >
                    </div>
                
                    {{-- <div class="form-group"> 
                        <label for="eeimagePath" class="control-label"><i class="fa-regular fa-image"></i>  Image</label>
                        <input type="file" class="form-control" id="eeimagePath" name="imagePath" >
                    </div> --}}
                    
                    <div class="form-group">
                        <label for="ppimagePath" class="control-label"><i class="fa-regular fa-image"></i>  Image</label>
                        <input type="file" class="form-control" id="ppimagePath" name="uploads" >
                    </div>
    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal"><i class="fa-sharp fa-solid fa-circle-xmark"></i> Close</button>
                <button id="updatebtnProduct" type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Update</button>
            </div>
        
        </div>
    </div>
    </div>
    </form>
    {{-- end of edit --}}

@endsection
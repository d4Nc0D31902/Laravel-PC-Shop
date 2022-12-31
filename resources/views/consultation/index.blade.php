@extends('layouts.base')
@section('body')

<h1 class="display-6 fw-bold">Consultation</h1>
<div class="container-fluid py-4 bg-light rounded-3 shadow-sm">
    <div class="container">
        <div class="table-responsive">
            <table id="contable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Consultation I.D</th>
                        <th>PC I.D</th>
                        <th>Employee I.D</th>
                        <th>Comment</th>
                        <th>Price</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody id="conbody">
                </tbody>
            </table>
        </div>
    </div>
</div>

<br>

{{-- start of create --}}
<div class="modal fade" id="consultationModal" role="dialog" style="display:none">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Consultation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="alert alert-danger" style="display:none"></div>
            <div class="modal-body">
                <form id="conform" method="post" action="#" enctype="multipart/form-data">
                    <meta name="csrf-token" content="{{ csrf_token() }}" />
                    <div class="row">
                        <div class="col">
                            <label for="pc_id">PC I.D</label>
                            <select class="form-control" id="pc_id" name="pc_id">
                                <option>Select PC ID:</option>
                                @foreach($pcspecs as $id => $pcspec)
                                <option value="{{ $pcspec }}"><a> {{ $pcspec }} </a></option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="conemployee" class="control-label">Employee</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->employees->fname}} {{ Auth::user()->employees->lname}}" readonly>
                        </div>
                        <div class="col">
                            <label for="conprice" class="control-label">Price</label>
                            <input type="text" class="form-control" id="conprice" name="price">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="concomment">Comment</label>
                            <textarea class="form-control" placeholder="Insert comment here..." id="concomment" name="comment" rows="3"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal"><i class="fa-sharp fa-solid fa-circle-xmark"></i> Close</button>
                <button id="consultationSubmit" type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save</button>
            </div>
        </div>
    </div>
</div>
{{-- end of create --}}

@endsection
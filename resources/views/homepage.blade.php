@extends('layouts.base')
@section('body')

<div id="customer-crud">
    @include('customer.index')
</div>

<div id="employee-crud">
    @include('employee.index')
</div>

@endsection
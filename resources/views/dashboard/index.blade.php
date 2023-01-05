@extends('layouts.base')
@section('body')

<link href="{{asset('css/dashboard.css')}}" rel="stylesheet"> 


<h1 class="display-6 fw-bold"><i class="fa-solid fa-chart-pie"></i> Dashboard</h1>
<br>

<div class="row row-cols-1 row-cols-md-2 g-4">
    <div class="bg-light rounded-3 p-2 mb-2">
    <div class="col">
      <div class="card shadow-sm text-center">
        <div class="chart-container">
            <canvas id="salesChart"></canvas>
            <div class="card-body">
                <h5 class="card-title">Monthly Sales</h5>
                {{-- <p class="card-text">
                  This is a longer card with supporting text below as a natural lead-in to
                  additional content. This content is a little bit longer.
                </p> --}}
              </div>
        </div>
      </div>
    </div>
    </div>
    <div class="bg-light rounded-3 p-2 mb-2">
    <div class="col">
      <div class="card shadow-sm text-center">
        <div class="chart-container">
            <canvas id="titleChart"></canvas>
            <div class="card-body">
                <h5 class="card-title">Total of active customer by title</h5>
              </div>
        </div>
      </div>
    </div>
    </div>
    <div class="bg-light rounded-3 p-2 mb-2">
    <div class="col">
      <div class="card shadow-sm text-center">
        <div class="chart-container">
                <canvas id="productsChart"></canvas>
            <div class="card-body">
                <h5 class="card-title">Products Sold</h5>
              </div>
        </div>
      </div>
    </div>
    </div>
    <div class="bg-light rounded-3 p-2 mb-2">
      <div class="col">
        <div class="card shadow-sm text-center">
          <div class="chart-container">
                  <canvas id="datesChart" aria-label="Hello ARIA World"><p>Hello Fallback World</p></canvas>
              <div class="card-body">
                  <h5 class="card-title">Order quantity sold by date</h5>
                </div>
          </div>
        </div>
      </div>
      </div>
  </div>
  <br>
@endsection
@extends('layouts.base')
@section('body')

@if(Auth::check())
  <p>You are now Login</p>
@else
  <p>Please login your account</p>
@endif

<section class="vh-100">
    <div class="container py-5 h-20">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card shadow-lg" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="https://images.unsplash.com/photo-1625805866449-3589fe3f71a3?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80"
                  alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">
  
                  <form id="loginForm" action="" method="POST">
                    <div class="d-flex align-items-center mb-3 pb-1">
                      <i class="fa fa-american-sign-language-interpreting fa-2x me-3" style="color: #8800ff;"></i>
                      <span class="h1 fw-bold mb-0">M.W Computer Shop</span>
                    </div>
  
                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>
  
                    <div class="form-outline mb-4">
                      <input type="email" id="email" name="email" class="form-control form-control-lg" />
                      <label class="form-label" for="form2Example17">Email address</label>
                    </div>
  
                    <div class="form-outline mb-4">
                      <input type="password" id="password" name="password" class="form-control form-control-lg" />
                      <label class="form-label" for="form2Example27">Password</label>
                    </div>
  
                    <div class="pt-1 mb-4">
                      <button class="btn btn-dark btn-lg btn-block" type="submit" id="loginbtnSubmit">Login</button>
                    </div>
  
                    <a class="small text-muted" href="#!">Want to apply a job? <a class="small" href="#!"
                        style="color: #393f81;">Apply here</a></a>
                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="#!"
                        style="color: #393f81;">Register here</a></p>
                    <a href="#!" class="small text-muted">Terms of use.</a>
                    <a href="#!" class="small text-muted">Privacy policy</a>
                  </form>
  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
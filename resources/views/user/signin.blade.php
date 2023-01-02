@extends('layouts.base')
@section('body')

{{-- @if(Auth::check())
  <p>You are now Logged in</p>
@else
  <p>Please login your account</p>
@endif --}}


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
                  <meta name="csrf-token" content="{{ csrf_token() }}" />
                  <form id="loginForm" action="" method="POST">
                    <div class="d-flex align-items-center mb-3 pb-1">
                      <i class="fa fa-american-sign-language-interpreting fa-2x me-3" style="color: #8800ff;"></i>
                      <span class="h1 fw-bold mb-0">M.W Computer Shop</span>
                    </div>
                    
                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>
                    <div class="alert alert-danger" role="alert" style="display:none"></div>
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
                        style="color: #393f81;" id="createEmployeeBtn">Apply here</a></a>
                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="#!"
                        style="color: #393f81;" id="customerCreateBtn">Register here</a></p>
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


{{-- start of create --}}
<div class="modal fade" id="customerModal" role="dialog" style="display:none">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Create Account for Customer</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="alert alert-danger" style="display:none"></div>
          <div class="modal-body">
              <form id="cform" method="post" action="#" enctype="multipart/form-data">
                  <meta name="csrf-token" content="{{ csrf_token() }}" />
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

{{-- Create Employee --}}
<div class="modal fade" id="employeeModal" role="dialog" style="display:none">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Create account for Job</h5>
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
{{-- Employee end --}}
@endsection
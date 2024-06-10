@extends('layouts.base')
@section('body')

@if(Auth::user()->role === "customer")
  <section style="background-color: rgb(255, 255, 255);">
    <div class="container">
    <div class="row">
      <div class="col">
      <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
        <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">User</a></li>
        <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol>
      </nav>
      </div>
    </div>
    <div class="container-fluid py-4 bg-light rounded-3 shadow-sm">
    <div class="row">
      <div class="col-lg-4">
      <div class="card mb-4">
        <div class="card-body text-center">
        <img src="{{ asset('/storage/' . Auth::user()->customers->imagePath) }}" alt="avatar"
          class="rounded-circle img-fluid" style="width: 150px;">
        <h5 class="my-3" id="cpname">{{ Auth::user()->customers->title }} {{ Auth::user()->name }}</h5>
        <p class="text-muted mb-1">User#{{ Auth::user()->id }} ({{ Auth::user()->role }} {{ Auth::user()->customers->customer_id }})</p>
        <p class="text-muted mb-4">{{ Auth::user()->customers->addressline }}</p>
        <div class="d-flex justify-content-center mb-2">
          <button type="button" class="btn btn-primary" id="pcCreateBtn">Add PC-Spec</button>
          <button type="button" class="btn btn-outline-primary ms-1" data-id="{{ Auth::user()->customers->customer_id }}" id="editCustomerBtn">Edit Profile</button>
        </div>
        </div>
      </div>

      <div class="card mb-4 mb-lg-0">
        <div class="card-body p-0">
        <ul class="list-group list-group-flush rounded-3">
          <li class="list-group-item d-flex justify-content-between align-items-center p-3">
          <i class="fas fa-globe fa-lg text-warning"></i>
          <p class="mb-0">https://mdbootstrap.com</p>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center p-3">
          <i class="fab fa-github fa-lg" style="color: #333333;"></i>
          <p class="mb-0">mdbootstrap</p>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center p-3">
          <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
          <p class="mb-0">@mdbootstrap</p>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center p-3">
          <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
          <p class="mb-0">mdbootstrap</p>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center p-3">
          <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
          <p class="mb-0">mdbootstrap</p>
          </li>
        </ul>
        </div>
      </div>
      </div>

      <div class="col-lg-8">
      <div class="card mb-4">
        <div class="card-body">
        <div class="row">
          <div class="col-sm-3">
          <p class="mb-0">Full Name</p>
          </div>
          <div class="col-sm-9">
          <p class="text-muted mb-0"> {{ Auth::user()->name }}</p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
          <p class="mb-0">Email</p>
          </div>
          <div class="col-sm-9">
          <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
          <p class="mb-0">Phone</p>
          </div>
          <div class="col-sm-9">
          <p class="text-muted mb-0">{{ Auth::user()->customers->phone }}</p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
          <p class="mb-0">Addressline</p>
          </div>
          <div class="col-sm-9">
          <p class="text-muted mb-0">{{ Auth::user()->customers->addressline }}</p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
          <p class="mb-0">Town</p>
          </div>
          <div class="col-sm-9">
          <p class="text-muted mb-0">{{ Auth::user()->customers->town }}</p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <p class="mb-0">Zipcode</p>
          </div>
          <div class="col-sm-9">
            <p class="text-muted mb-0">{{ Auth::user()->customers->zipcode }}</p>
          </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md">
        <div class="card mb-4 mb-md-0">
          <div class="card-body">
          <p class="mb-4"><span class="text-primary font-italic me-1">Transaction</span> History
          </p>
          <p class="mb-1" style="font-size: .77rem;">Web Design</p>
          <div class="progress rounded" style="height: 5px;">
            <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
            aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
          <div class="progress rounded" style="height: 5px;">
            <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
            aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
          <div class="progress rounded" style="height: 5px;">
            <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
            aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
          <div class="progress rounded" style="height: 5px;">
            <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
            aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
          <div class="progress rounded mb-2" style="height: 5px;">
            <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
            aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          </div>
        </div>
        </div>
        {{-- <div class="col-md-6">
        <div class="card mb-4 mb-md-0">
          <div class="card-body">
          <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
          </p>
          <p class="mb-1" style="font-size: .77rem;">Web Design</p>
          <div class="progress rounded" style="height: 5px;">
            <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
            aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
          <div class="progress rounded" style="height: 5px;">
            <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
            aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
          <div class="progress rounded" style="height: 5px;">
            <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
            aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
          <div class="progress rounded" style="height: 5px;">
            <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
            aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
          <div class="progress rounded mb-2" style="height: 5px;">
            <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
            aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          </div>
        </div>
        </div> --}}
      </div>
      </div>
    </div>
    </div>
  </section>

  {{-- start of edit --}}
  <div class="modal fade" id="editCustomerModal" role="dialog" style="display:none">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="cusform" method="POST" action="#" enctype="multipart/form-data">
            <meta name="csrf-token" content="{{ csrf_token() }}" />
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

            <div class="row mt-2">
              <div class="col">
                <label for="ccemail" class="control-label">Email</label>
                <input type="email" class="form-control" id="ccemail" name="email" placeholder="example123@email.com">
              </div>
              <div class="col">
                <label for="ccpassword" class="control-label">Password</label>
                <input type="password" class="form-control" id="ccpassword" name="password">
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

    {{-- start of create --}}
    <div class="modal fade" id="pcCreateModal" role="dialog" style="display:none">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create new PC-Spec</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="alert alert-danger" style="display:none"></div>
          <div class="modal-body">
            <form id="pcform" method="post" action="#" enctype="multipart/form-data">
              <meta name="csrf-token" content="{{ csrf_token() }}" />

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

@else
    <section style="background-color: rgb(255, 255, 255);">
      <div class="container">
        <div class="row">
        <div class="col">
          <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
          </ol>
          </nav>
        </div>
        </div>

        <div class="row">
        <div class="col-lg-4">
          <div class="card mb-4">
          <div class="card-body text-center">
            <img src="{{ asset('/storage/' . Auth::user()->employees->imagePath) }}" alt="avatar"
            class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3" id="cpname">{{ Auth::user()->employees->title }} {{ Auth::user()->name }}</h5>
            <p class="text-muted mb-1">User#{{ Auth::user()->id }} ({{ Auth::user()->role }})</p>
            <p class="text-muted mb-4">{{ Auth::user()->employees->addressline }}</p>
            <div class="d-flex justify-content-center mb-2">
            {{-- <button type="button" class="btn btn-primary">Add PC-Spec</button> --}}
            <button type="button" class="btn btn-outline-primary ms-1" data-id="{{ Auth::user()->employees->employee_id }}" id="editEmployeeBtn">Edit Profile</button>
            </div>
          </div>
          </div>

          <div class="card mb-4 mb-lg-0">
          <div class="card-body p-0">
            <ul class="list-group list-group-flush rounded-3">
            {{-- <li class="list-group-item d-flex justify-content-between align-items-center p-3">
              <i class="fas fa-globe fa-lg text-warning"></i>
              <p class="mb-0">https://mdbootstrap.com</p>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
              <i class="fab fa-github fa-lg" style="color: #333333;"></i>
              <p class="mb-0">mdbootstrap</p>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
              <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
              <p class="mb-0">@mdbootstrap</p>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
              <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
              <p class="mb-0">mdbootstrap</p>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
              <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
              <p class="mb-0">mdbootstrap</p>
            </li> --}}
            </ul>
          </div>
          </div>
        </div>

        <div class="col-lg-8">
          <div class="card mb-4">
          <div class="card-body">
            <div class="row">
            <div class="col-sm-3">
              <p class="mb-0">Full Name</p>
            </div>
            <div class="col-sm-9">
              <p class="text-muted mb-0"> {{ Auth::user()->name }}</p>
            </div>
            </div>
            <hr>
            <div class="row">
            <div class="col-sm-3">
              <p class="mb-0">Email</p>
            </div>
            <div class="col-sm-9">
              <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
            </div>
            </div>
            <hr>
            <div class="row">
            <div class="col-sm-3">
              <p class="mb-0">Phone</p>
            </div>
            <div class="col-sm-9">
              <p class="text-muted mb-0">{{ Auth::user()->employees->phone }}</p>
            </div>
            </div>
            <hr>
            <div class="row">
            <div class="col-sm-3">
              <p class="mb-0">Address</p>
            </div>
            <div class="col-sm-9">
              <p class="text-muted mb-0">{{ Auth::user()->employees->addressline }}</p>
            </div>
            </div>
            <hr>
            <div class="row">
            <div class="col-sm-3">
              <p class="mb-0">Town</p>
            </div>
            <div class="col-sm-9">
              <p class="text-muted mb-0">{{ Auth::user()->employees->town }}</p>
            </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
              <p class="mb-0">Zipcode</p>
              </div>
              <div class="col-sm-9">
              <p class="text-muted mb-0">{{ Auth::user()->employees->zipcode }}</p>
              </div>
            </div>
          </div>
          </div>
          <div class="row">
          <div class="col-md-6">
            <div class="card mb-4 mb-md-0">
            <div class="card-body">
            </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card mb-4 mb-md-0">
            <div class="card-body">
            </div>
            </div>
          </div>
          </div>
        </div>
        </div>
      </div>
      </section>

    <div class="modal fade" id="editEmployeeModal" role="dialog" style="display:none">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Account</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="empform" method="POST" action="#" enctype="multipart/form-data">
            {{ csrf_field() }}
            <label for="eeemployee_id" class="control-label">Employee ID</label>
            <input type="text" class="form-control" id="eeemployee_id" name="employee_id" readonly>
            <div class="row mt-2">
              <div class="col">
                <label for="eetitle" class="control-label">Title</label>
                <input type="text" class="form-control" placeholder="Mr." id="eetitle" name="title">
              </div>
              <div class="col">
                <label for="eelname" class="control-label">First name</label>
                <input type="text" class="form-control" placeholder="Juan" id="eefname" name="fname">
              </div>
              <div class="col">
                <label for="eelname" class="control-label">Last name</label>
                <input type="text" class="form-control" placeholder="Dela Cruz" id="eelname" name="lname">
              </div>  
            </div>

            <div class="row mt-2">
              <div class="col">
                <label for="eeaddressline" class="control-label">Addressline</label>
                <input type="text" class="form-control" placeholder="Lot 24A Block 52 New Lower..." id="eeaddressline" name="addressline">
              </div>
            </div>

            <div class="row mt-2">
              <div class="col">
                <label for="eetown" class="control-label">Town</label>
                <input type="text" class="form-control" placeholder="Taguig City..." aria-label="Town" id="eetown" name="town">
              </div>
              <div class="col">
                <label for="eezipcode" class="control-label">Zipcode</label>
                <input type="text" class="form-control" placeholder="1918" aria-label="Zipcode" id="eezipcode" name="zipcode">
              </div>
              <div class="col">
                <label for="eephone" class="control-label">Phone</label>
                <input type="text" class="form-control" placeholder="092187162..." aria-label="Phone" id="eephone" name="phone">
              </div>  
            </div>

            <div class="row mt-2">
              <div class="col">
                <label for="eeemail" class="control-label">Email</label>
                <input type="email" class="form-control" id="eeemail" name="email" placeholder="example123@email.com">
              </div>
              <div class="col">
                <label for="eepassword" class="control-label">Password</label>
                <input type="password" class="form-control" id="eepassword" name="password">
              </div>
            </div>

            <div class="row mt-2">
              <div class="col">
                <label for="eeimagePath" class="control-label">Profile Picture</label>
                <div class="input-group">
                  <input type="file" class="form-control" id="eeimagePath" name="uploads">
                  <label class="input-group-text" for="inputGroupFile02">Upload</label>
                  </div>
              </div>
            </div>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-bs-dismiss="modal"><i class="fa-sharp fa-solid fa-circle-xmark"></i> Close</button>
          <button id="updatebtnEmployee" type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Update</button>
        </div>

      </div>
    </div>
    </div>
    </div>
    </form>

@endif

@endsection

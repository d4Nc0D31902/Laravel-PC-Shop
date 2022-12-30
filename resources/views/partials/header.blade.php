<nav class="navbar navbar-expand-lg shadow navbar-light bg-light rounded" aria-label="Eleventh navbar example">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">PC Shop</a>
      <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse collapse" id="navbarsExample09" style="">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          
        @if(Auth::check() && Auth::user()->role === "employee" or Auth::check() && Auth::user()->role === "admin")
            <li class="nav-item">
              <a class="nav-link" href="http://localhost:8000/customer">Customer</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost:8000/employee">Employee</a>
            </li>
  
            <li class="nav-item">
              <a class="nav-link" href="http://localhost:8000/pcspec">PcSpec</a>
            </li>
    
            {{-- <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</a>
              <ul class="dropdown-menu" aria-labelledby="dropdown09">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li> --}}
            <li class="nav-item">
              <a class="nav-link" href="consultation">Consultation</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/product') }}">Products</a>
            </li>
        @else
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="shop">Shop</a>
          </li>
        @endif

      </ul>
      @if(Auth::check()) 
      <div>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-bs-toggle="dropdown" aria-expanded="false">
              {{-- <img src="{{ asset('/storage/' . Auth::user()->customers->imagePath) }}" alt="avatar"
              class="rounded-circle img-fluid" style="width: 20px;">   --}}
              {{ Auth::user()->name }}</a>
              <ul class="dropdown-menu" aria-labelledby="dropdown09">
                <li><a class="dropdown-item" href="{{ url('/profile') }}">My Account</a></li>
            {{-- <a class="nav-link" href=""><img class="img-circle" src="{{ asset(Auth::user()->employees->imagePath) }}">Profile</a> --}}
              </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login.logout') }}" id="logoutbtnSubmit">Logout</a>
          </li>
        </ul>
      </div>
      @else 
       <div>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.signin') }}">Login</a>
              </li>
          </ul>
       </div>
       @endif
      </div>
    </div>
  </nav>

  <br>
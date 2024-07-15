   <!-- main header area  -->
   <style>
       .navbar .form-container {
           margin-left: auto;
       }
       .form-inline .form-control {
           display: inline-block;
           width: auto;
           vertical-align: middle;
       }
       .form-inline .btn {
           display: inline-block;
           vertical-align: middle;
       }

       .form-container {
           display: flex;
           align-items: center;
       }

       .form-inline {
           display: flex;
           width: 100%;
       }

       .form-inline .form-control {
           flex: 1;
           margin-right: 10px;
       }

       .form-inline .btn {
           white-space: nowrap;
       }

   </style>

   <header class="andfood-header">


    <!-- navbar  -->
    <div class="andfood-navbar">
      <nav class="navbar navbar-expand-lg py-0">
        <div class="container">
          <a class="navbar-brand pb-0" href="{{url('/')}}"
            >Sports Store</a>
            <div class="form-container ms-1">
                <form class="form-inline" action="{{route('home')}}" method="get">
                    <input class="form-control" name="search" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
          <div class="nav-responsive">

            <button
              class="navbar-toggler"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
            <i class="fas fa-bars"></i>
            </button>
          </div>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-lg-0">
              <li class="nav-item">
                <a
                  class="nav-link active"
                  aria-current="page"
                  href="{{url('/')}}"
                  >Home</a
                >

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Category
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="background: #fff3cd">
                        @foreach(getCategory() as $category)
                            <a class="dropdown-item" href="{{route('admin.category.details',['id'=>$category->id])}}">{{$category->name}}</a>
                        @endforeach

                    </div>
                </li>

              <li class="nav-item">
                <a
                  class="nav-link active"
                  aria-current="page"
                  href="{{url('/about')}}"
                  >About</a
                >
              </li>




              <li class="nav-item">
                <a class="nav-link" href="{{url('/contact')}}">Contact </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{url('/payment')}}">Payment </a>
              </li>

                @if(\Illuminate\Support\Facades\Auth::user())
                    <li class=" nav-item">
                        <a class="nav-link" href="{{route('logout-user')}}">LogOut </a>
                    </li>
                @else
                    <li class=" nav-item mt-2 pe-1">
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            SignIn
                        </button>
                    </li>
                    <li class=" nav-item mt-2">
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                            SignUp
                        </button>
                    </li>


                @endif


            </ul>

          </div>
        </div>
      </nav>
    </div>

       <!-- Modal -->
       <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLabel">Log In</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <div class="modal-body">

                       <form method="post" action="{{route('login-user')}}">
                           @csrf
                           <div class="mb-3">
                               <label for="exampleInputEmail1" class="form-label">Email address</label>
                               <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                           </div>
                           <div class="mb-3">
                               <label for="exampleInputPassword1" class="form-label">Password</label>
                               <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                           </div>

                           <button type="submit" class="btn btn-primary">Submit</button>
                       </form>

                   </div>
               </div>
           </div>
       </div>

       <!-- Modal -->
       <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLabel">Register</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <div class="modal-body">
                       <form method="post" action="{{route('register-user')}}">
                           @csrf
                           <div class="mb-3">
                               <label for="exampleInputEmail1" class="form-label">Name</label>
                               <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                           </div>
                           <div class="mb-3">
                               <label for="exampleInputEmail1" class="form-label">Email address</label>
                               <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                           </div>
                           <div class="mb-3">
                               <label for="exampleInputPassword1" class="form-label">Password</label>
                               <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                           </div>

                           <div class="mb-3">
                               <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                               <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1">
                           </div>

                           <button type="submit" class="btn btn-primary">Submit</button>
                       </form>
                   </div>

               </div>
           </div>
       </div>


  </header>

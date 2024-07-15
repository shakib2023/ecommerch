@extends('layouts.app')
@section('title') {{'Login'}} @endsection

@section('content')
<section class="vh-100 bg-image my-5 ">
  <div class="mask d-flex align-items-center gradient-custom-3">
    <div class="container ">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Login</h2>

              <form>

                <div class="form-outline mb-4">
                  <label>Your Email</label>
                  <input type="email" id="admin_email_login" placeholder="Emal" class="form-control form-control-lg" />
                </div>

                <div class="form-outline mb-4">
                  <label>Password</label>
                  <input type="password" id="admin_password_login"  class="form-control form-control-lg" />
                </div>


                <div class="d-flex justify-content-center">
                  <button type="button" id="adminLogin"
                    class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Login</button>
                </div>

                <p class="text-center text-muted mt-5 mb-0">Have no account! go to Registration <a href="{{url('reg')}}"
                    class="fw-bold text-body"><u>Registration here</u></a></p>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

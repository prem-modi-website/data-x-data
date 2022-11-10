@extends('master')
@section('content')
  <section>
        <div class="login_page container-fluid">
            <div class="color-overlay"></div>
            <div class="row align-items-center justify-content-center h-100">
                <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                    <div class="login_bg_color">
                        <div class="form-image text-center">
                            <img src="assets/img/logo.png" alt="Data-X-Data logo" />
                        </div>
                        <div class="form_top_content">
                            <h5>Welcome Back,</h5>
                            <p>Login to your Account</p>
                        </div>
                        <form method="post" action="{{route('auth')}}" name="update_form" id="update_form" enctype="multipart/form-data">
                          @csrf   
                            <div class="form-group first">
                                <label for="username">Username</label>
                                <input type="email" class="form-control" placeholder="Email Address" name="email" id="email" />
                            </div>
                            <div class="form-group last mb-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" placeholder="Your Password" name="password" id="password" />
                            </div>
                            <input type="submit" value="Log In" class="mt-4 login-button btn btn-block btn-primary login" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
  </section>
@endsection
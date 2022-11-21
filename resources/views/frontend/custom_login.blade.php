@extends('frontend.partial.master')
@section('breadcumb')
<!--hero section start-->
    <section class="page-title position-relative overflow-hidden shape-1 right">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="bg-white p-md-5 p-3 d-inline-block">
                        <h1 class="font-w-3 mb-4"><span class="text-primary font-w-5">Log</span>in</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="las la-home me-1"></i>Home</a>
                                </li>
                                <!-- <li class="breadcrumb-item">Pages</li>
                                    <li class="breadcrumb-item">Utilities</li> -->
                                <li class="breadcrumb-item active" aria-current="page">Login</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <canvas id="canvas-1"></canvas>
    </section>
<!--hero section end-->
@endsection
@section('content')
    <!--login start-->
        <section>
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-6 col-12">
                        <img class="img-fluid" src="{{asset('frontend/assets/images/login-img.png')}}" alt="">
                    </div>
                    <div class="col-lg-5 col-12 mt-5 mt-lg-0">
                        <div class="mb-5">
                            <h6
                                class="font-w-5 mb-3 position-relative py-1 px-3 text-primary rounded subtitle-effect box-shadow d-inline-block">
                                <span>Login</span>
                            </h6>
                            <h2 class="mb-0"><span class="font-w-5">Login your</span> account</h2>
                        </div>
                        
                        <form action="{{route('customerlogin')}}" method="post" id="myForm">
                            {{ csrf_field() }}
                            <div class="mb-3">
                                <input  type="text" name="email" class="form-control" placeholder="User email" >
                            </div>
                            @if($errors->has('email'))
                                        <div class="error">{{ $errors->first('email') }}</div>
                            @endif
                            <div class="mb-3">
                                <input  type="password" name="password" class="form-control" placeholder="Password"
                                    >
                            </div>
                            @if($errors->has('password'))
                                <div class="error">{{ $errors->first('password') }}</div>
                            @endif
                            <div class="mt-4 mb-5">
                                <div class="remember-checkbox d-flex align-items-center justify-content-end">
                                    <a class="btn-link" href="{{route('forgotPasswordPage')}}">Forgot Password?</a>
                                </div>
                            </div>
                            
                            <button type="button" class="btn btn-primary loginBtn">Login Now</button>
                        </form>

                        <div class="d-flex align-items-center mt-4"> <span class="text-muted me-1">Don't have an account?</span>
                            <a href="{{route('signup')}}">Sign Up</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!--login end-->
@section('script')
    <script>
            $(document).on('click','.loginBtn',function(){
                console.log("login");
                $('#myForm').submit();
            });
        </script>
@endsection
@endsection
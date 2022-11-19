@extends('frontend.partial.master')
@section('css')
<style>
    .error{
        color: red;
    }
</style>
@endsection
@section('breadcumb')
<!--hero section start-->
<section class="page-title position-relative overflow-hidden shape-1 right">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="bg-white p-md-5 p-3 d-inline-block">
                                <h1 class="font-w-3 mb-4"><span class="text-primary font-w-5">Sign</span> Up</h1>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="las la-home me-1"></i>Home</a>
                                        </li>
                                        <!-- <li class="breadcrumb-item">Pages</li>
                                            <li class="breadcrumb-item">Utilities</li> -->
                                        <li class="breadcrumb-item active" aria-current="page">Sign Up</li>
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
    <!--sign up start-->
                <section class="register">
                    <div class="container">
                        <div class="row justify-content-center text-center">
                            <div class="col-lg-8 col-md-12">
                                <div class="mb-5">
                                    <h6
                                        class="font-w-5 mb-3 position-relative py-1 px-3 text-primary rounded subtitle-effect box-shadow d-inline-block">
                                        <span>Signup</span>
                                    </h6>
                                    <h2 class="mb-0"><span class="font-w-5">Simple And</span> Easy To Sign Up</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-md-10 col-sm-12 ms-auto me-auto">
                                <div class="register-form text-center">
                                    <form id="contact-form1" method="post" action="{{route('sing-up')}}">
                                        {{ csrf_field() }}

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <input id="form_name" type="text" name="name" class="form-control" placeholder="Enter User Name"
                                                        >
                                                </div>
                                            </div>
                                        </div>
                                        @if($errors->has('name'))
                                        <div class="error">{{ $errors->first('name') }}</div>
                                        @endif
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <input id="form_email" type="email" name="email" class="form-control"
                                                        placeholder="Enter Email Address" >
                                                </div>
                                            </div>
                                        </div>
                                        @if($errors->has('email'))
                                        <div class="error">{{ $errors->first('email') }}</div>
                                        @endif
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <input id="form_password" type="password" name="password" class="form-control"
                                                        placeholder="Enter Your Password" >
                                                </div>
                                            </div>
                                        </div>
                                        @if($errors->has('password'))
                                        <div class="error">{{ $errors->first('password') }}</div>
                                        @endif
                                        <div class="row">
                                            <div class="col"> <button class="btn btn-primary" type="submit">Sign Up</button>
                                                <span class="mt-4 d-block">Have An Account ? <a href="{{route('customer-login')}}"><i>Sign In!</i></a></span>
                                            </div>
                                        </div>
                                        <div class="row mt-5 social_media_icon_button">
                                            <div class="col">
                                                <a href="{{ url('auth/facebook') }}" class="btn btn-dark me-2"> <i class="las la-facebook-f"></i> Sign in with Facebook</a>
                                                <a href="{{ url('auth/google') }}" class="btn btn-white "><i class="las la-google"></i> Sign in With Google</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
    <!--sign up end-->

@endsection
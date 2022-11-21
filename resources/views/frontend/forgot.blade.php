@extends('frontend.partial.master')

@section('breadcumb')
     <!--hero section start-->
     <section class="page-title position-relative overflow-hidden shape-1 right">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="bg-white p-md-5 p-3 d-inline-block">
                                <h1 class="font-w-3 mb-4"><span class="text-primary font-w-5">Forgot</span> Password</h1>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="{{route('home')}}"><i class="las la-home me-1"></i>Home</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Forgot Password</li>
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
<section>
                    <div class="container">
                        <div class="row justify-content-center text-center">
                            <div class="col-lg-5">
                                <div>
                                    <div class="mb-5">
                                        <h2>Forgot your password?</h2>
                                        <p>Enter your email to reset your password.</p>
                                    </div>
                                    <form id="contact-form" method="post" action="{{route('forgotPass')}}">
                                        @csrf
                                        <div class="messages"></div>
                                        <div class="mb-3">
                                            <input id="form_email" type="email" name="email" class="form-control" placeholder="Email" required />
                                        </div>
                                        @if($errors->has('email'))
                                                    <div class="error">{{ $errors->first('email') }}</div>
                                        @endif
                                        <button class="btn btn-primary btn-block" type="submit">Forgot Now</button>
                                    </form>
                                    <div class="d-flex align-items-center mt-4 justify-content-center"> <span class="text-muted me-1">Back to</span>
                                    <a href="{{route('customer-login')}}">Sign In</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
@endsection
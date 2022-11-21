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
                                    <form id="contact-form" method="post" action="{{route('changePasswordCustomer')}}">
                                        @csrf
                                        <input type="hidden" name="token" value="{{$user->token}}">
                                        <div class="mb-3">
                                            <input id="new_password" type="password" value="" name="new_password" class="form-control" placeholder="new_password"  />
                                        </div>
                                        @if($errors->has('new_password'))
                                                    <div class="error">{{ $errors->first('new_password') }}</div>
                                        @endif
                                        <div class="mb-3">
                                            <input id="confirm_password" type="password" name="confirm_password" class="form-control" placeholder="confirm_password"  />
                                        </div>
                                        @if($errors->has('confirm_password'))
                                                    <div class="error">{{ $errors->first('confirm_password') }}</div>
                                        @endif
                                        <button class="btn btn-primary btn-block" type="submit">Submit</button>
                                    </form>
                                    <div class="d-flex align-items-center mt-4 justify-content-center"> <span class="text-muted me-1">Back to</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
@endsection
@extends('frontend.partial.master')

@section('breadcumb')
     <!--hero section start-->
     <section class="page-title position-relative overflow-hidden shape-1 right">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="bg-white p-md-5 p-3 d-inline-block">
                                <h1 class="font-w-3 mb-4"><span class="text-primary font-w-5">Order</span> Processing</h1>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="{{route('home')}}"><i class="las la-home me-1"></i>Home</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Payment</li>
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
            <div class="row">
                <div class="col">
                    <div class="bg-white box-shadow p-3 rounded">
                        <div class="row">
                            <div class="col-lg-8 p-lg-5">
                                <div class="mb-5">
                                    <h2 class="mb-0">Your payment amount<span class="font-w-5">{{$package->package_amount}}.00</span> please click below button </h2>

                                    <form action="{{ route('razorpay.payment.store') }}" method="POST" >
                                    @csrf
                                    <script src="https://checkout.razorpay.com/v1/checkout.js"
                                            data-key="{{ env('RAZORPAY_KEY') }}"
                                            data-amount="{{$package->package_amount}}00"
                                            data-buttontext="Pay {{$package->package_amount}}.00 INR"
                                            data-name="data-x-data"
                                            data-description="Rozerpay"
                                            data-image="{{asset('frontend/assets/images/logo.png')}}"
                                            data-prefill.name="name"
                                            data-prefill.email="email"
                                            data-theme.color="#ff7529">
                                    </script>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
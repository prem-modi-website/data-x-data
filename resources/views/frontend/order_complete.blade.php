@extends('frontend.partial.master')

@section('breadcumb')
     <!--hero section start-->
     <section class="page-title position-relative overflow-hidden shape-1 right">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="bg-white p-md-5 p-3 d-inline-block">
                                <h1 class="font-w-3 mb-4"><span class="text-primary font-w-5">Order</span> Complete</h1>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="{{route('home')}}"><i class="las la-home me-1"></i>Home</a>
                                        </li>
                                        <li class="breadcrumb-item">Shop</li>
                                        <li class="breadcrumb-item active" aria-current="page">Order Complete</li>
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
<section class="text-center pb-11">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="mb-4">Thank you for purchasing, Your order is complete</h3>
                                <a class="btn btn-primary" href="{{route('home')}}">Home</a>
                                <a class="btn btn-primary" href="{{route('home')}}">Continue Shopping</a>
                            </div>
                        </div>
                    </div>
                </section>
@endsection
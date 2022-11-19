@extends('frontend.partial.master')

@section('breadcumb')
     <!--hero section start-->
            <section class="page-title position-relative overflow-hidden shape-1 right">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="bg-white p-md-5 p-3 d-inline-block">
                                <h1 class="font-w-3 mb-4"><span class="text-primary font-w-5">Privacy</span> & Policy</h1>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="{{route('home')}}"><i class="las la-home me-1"></i>Home</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Terms and Conditions</li>
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
        <!--terms start-->

            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <h4 class="text-primary">1. Description of Service</h4>
                            <p class="mb-3">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente, distinctio iste praesentium totam quasi tempore, magnam ipsum cum animi at fuga alias harum quo quibusdam odit eum reprehenderit
                                consectetur suscipit!
                            </p>
                            <h4 class="text-primary mt-5">2. Your Registration Obligations</h4>
                            <p class="mb-3">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio nesciunt officia culpa nostrum maxime vero architecto, corporis placeat repudiandae minima facere animi, pariatur fugit dignissimos qui
                                error est nulla. Doloribus.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio nesciunt officia culpa nostrum maxime vero architecto, corporis placeat repudiandae minima facere animi,
                                pariatur fugit dignissimos qui error est nulla. Doloribus.
                            </p>
                            <h4 class="text-primary mt-5">3. User Account, Password, and Security</h4>
                            <p class="mb-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente, distinctio iste praesentium totam quasi tempore, magnam ipsum cum animi.</p>
                            <h4 class="text-primary mt-5">4. User Conduct</h4>
                            <p class="mb-3">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente, distinctio iste praesentium totam quasi tempore, magnam ipsum cum animi. Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Laudantium vel recusandae ad impedit ipsum, vitae facere expedita! Voluptatem iure dolorem dignissimos nisi magni a dolore, et inventore optio, voluptas, obcaecati.
                            </p>
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-light rounded p-1">
                                    <i class="las la-check"></i>
                                </div>
                                <p class="mb-0 ms-3">Lorem ipsum dolor sit amet, consectetur</p>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-light rounded p-1">
                                    <i class="las la-check"></i>
                                </div>
                                <p class="mb-0 ms-3">Quidem error quae illo excepturi nostrum blanditiis laboriosam</p>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-light rounded p-1">
                                    <i class="las la-check"></i>
                                </div>
                                <p class="mb-0 ms-3">Molestias, eum nihil expedita dolorum odio dolorem</p>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-light rounded p-1">
                                    <i class="las la-check"></i>
                                </div>
                                <p class="mb-0 ms-3">Eum nihil expedita dolorum odio dolorem</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded p-1">
                                    <i class="las la-check"></i>
                                </div>
                                <p class="mb-0 ms-3">Explicabo rem illum magni perferendis</p>
                            </div>
                            <h4 class="text-primary mt-5">5. International Use</h4>
                            <p class="">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente, distinctio iste praesentium totam quasi tempore, magnam ipsum cum animi. Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Laudantium vel recusandae ad impedit ipsum, vitae facere expedita! Voluptatem iure dolorem dignissimos nisi magni a dolore, et inventore optio, voluptas, obcaecati. Lorem ipsum dolor sit amet, consectetur
                                adipisicing elit. Voluptate incidunt aliquam sint, magnam excepturi quas a, id doloremque quasi iusto quo consequuntur dolorum neque optio ipsum, rerum nesciunt illo iure.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

        <!--terms end-->
@endsection
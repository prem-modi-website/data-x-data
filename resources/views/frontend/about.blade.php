@extends('frontend.partial.master')
@section('breadcumb')
<!--hero section start-->
    <section class="page-title position-relative overflow-hidden shape-1 right">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="bg-white p-md-5 p-3 d-inline-block">
                        <h1 class="font-w-3 mb-4"><span class="text-primary font-w-5">About</span> Us</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="las la-home me-1"></i>Home</a>
                                </li>
                                <!-- <li class="breadcrumb-item">Pages</li>
                                    <li class="breadcrumb-item">About Us</li> -->
                                <li class="breadcrumb-item active" aria-current="page">About Us</li>
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
 <!--step start-->
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-12">
                <div class="work-process position-relative rounded bg-white overflow-hidden">
                    <span
                        class="step-num">01</span>
                    <div class="step-icon">
                        <img class="img-fluid" src="{{asset('frontend/assets/images/icon/10.png')}}" alt="">
                    </div>
                    <div class="step-desc">
                        <h5>Lorem, ipsum dolor.</h5>
                        <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, illum.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12 mt-5">
                <div class="work-process position-relative rounded bg-white overflow-hidden">
                    <span
                        class="step-num">02</span>
                    <div class="step-icon">
                        <img class="img-fluid" src="{{asset('frontend/assets/images/icon/11.png')}}" alt="">
                    </div>
                    <div class="step-desc">
                        <h5>Lorem, ipsum dolor.</h5>
                        <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, illum.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12 mt-5 mt-lg-0">
                <div class="work-process position-relative rounded bg-white overflow-hidden">
                    <span
                        class="step-num">03</span>
                    <div class="step-icon">
                        <img class="img-fluid" src="{{asset('frontend/assets/images/icon/12.png')}}" alt="">
                    </div>
                    <div class="step-desc">
                        <h5>Lorem, ipsum dolor.</h5>
                        <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, illum.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--step end-->
<!--who we are start-->
<section class="pt-5">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-12 col-lg-6 mb-6 mb-lg-0">
                <img class="img-fluid topBottom" src="{{asset('frontend/assets/images/about/about-us.png')}}" alt="">
            </div>
            <div class="col-12 col-lg-6">
                <div class="mb-3">
                    <h6
                        class="font-w-5 mb-3 position-relative py-1 px-3 text-primary rounded subtitle-effect box-shadow bg-white d-inline-block">
                        <span>About Us</span>
                    </h6>
                    <h2 class="mb-0"><span class="font-w-5">Boost your Analytics</span> Solutions</h2>
                </div>
                <p class="lead mb-4">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Hic laudantium vel mollitia
                    commodi quos, quam vero tenetur qui asperiores veritatis.
                </p>
                <p class="lead mb-4">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Hic laudantium vel mollitia
                    commodi quos, quam vero tenetur qui asperiores veritatis.
                </p>
                <p class="lead mb-4">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Hic laudantium vel mollitia
                    commodi quos, quam vero tenetur qui asperiores veritatis.
                </p>
            </div>
        </div>
    </div>
</section>
<!--who we are end-->
<!--faq start-->
<section class="bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 order-lg-1">
                <div class="position-relative overflow-hidden">
                    <img class="img-fluid w-100 rounded" src="{{asset('frontend/assets/images/about/faq.png')}}" alt="">
                    <div class="video-btn video-btn-pos"> <a class="play-btn popup-youtube mr-3"
                        href="https://www.youtube.com/watch?v=P_wKDMcr1Tg"><i class="las la-play"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 ps-lg-8 mt-5 mt-lg-0">
                <div class="mb-5">
                    <h6
                        class="font-w-5 mb-3 position-relative py-1 px-3 text-primary rounded subtitle-effect box-shadow bg-white d-inline-block">
                        <span>F.A.Q.</span>
                    </h6>
                    <h2 class="mb-0"><span class="font-w-5">If you have any</span> questions find here.</h2>
                </div>
                <div class="accordion" id="accordion">
                    <div class="accordion-item rounded box-shadow border-0 mb-4">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button border-0 shadow-none mb-0 bg-transparent" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                aria-controls="collapseOne">
                            Lorem ipsum dolor sit, amet consectetur adipisicing.
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse border-0 collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordion">
                            <div class="accordion-body text-muted">Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                Voluptatibus natus non omnis accusamus animi aspernatur blanditiis est error sint consequatur.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item rounded box-shadow border-0 mb-4">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button border-0 shadow-none mb-0 bg-transparent collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                aria-controls="collapseTwo">
                            Lorem ipsum dolor sit, amet consectetur adipisicing.
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse border-0 collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordion">
                            <div class="accordion-body text-muted">Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                Voluptatibus natus non omnis accusamus animi aspernatur blanditiis est error sint consequatur.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item rounded box-shadow border-0">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button border-0 shadow-none mb-0 bg-transparent collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                                aria-controls="collapseThree">
                            Lorem ipsum dolor sit, amet consectetur adipisicing.
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse border-0 collapse" aria-labelledby="headingThree"
                            data-bs-parent="#accordion">
                            <div class="accordion-body text-muted">Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                Voluptatibus natus non omnis accusamus animi aspernatur blanditiis est error sint consequatur.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--faq end-->
<!--counter start-->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-3 col-sm-6">
                <div class="counter d-flex align-items-center style-2">
                    <div class="me-3 flex-shrink-0">
                        <img class="img-fluid" src="{{asset('frontend/assets/images/icon/counter/01.png')}}" alt="">
                    </div>
                    <div class="counter-desc flex-grow-1 text-dark">
                        <span class="count-number h2" data-to="15"
                            data-speed="1000">15</span>
                        <span class="h2">+</span>
                        <h6 class="text-grey mb-0 font-w-5">Projects Executed</h6>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 col-sm-6 mt-5 mt-sm-0">
                <div class="counter d-flex align-items-center style-2">
                    <div class="me-3 flex-shrink-0">
                        <img class="img-fluid" src="{{asset('frontend/assets/images/icon/counter/02.png')}}" alt="">
                    </div>
                    <div class="counter-desc flex-grow-1 text-dark">
                        <span class="count-number h2" data-to="73"
                            data-speed="1000">73</span>
                        <span class="h2">+</span>
                        <h6 class="text-grey mb-0 font-w-5">Data Analytics</h6>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 col-sm-6 mt-5 mt-lg-0">
                <div class="counter d-flex align-items-center style-2">
                    <div class="me-3 flex-shrink-0">
                        <img class="img-fluid" src="{{asset('frontend/assets/images/icon/counter/03.png')}}" alt="">
                    </div>
                    <div class="counter-desc flex-grow-1 text-dark">
                        <span class="count-number h2" data-to="88"
                            data-speed="1000">88</span>
                        <span class="h2">+</span>
                        <h6 class="text-grey mb-0 font-w-5">People Loved</h6>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 col-sm-6 mt-5 mt-lg-0">
                <div class="counter d-flex align-items-center style-2">
                    <div class="me-3 flex-shrink-0">
                        <img class="img-fluid" src="{{asset('frontend/assets/images/icon/counter/04.png')}}" alt="">
                    </div>
                    <div class="counter-desc flex-grow-1 text-dark">
                        <span class="count-number h2" data-to="104"
                            data-speed="1000">104</span>
                        <span class="h2">+</span>
                        <h6 class="text-grey mb-0 font-w-5">Happy Customers</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--counter end-->

@endsection
@section('script')
 <!--== counter -->
 <script src="{{asset('frontend/assets/js/counter.js')}}"></script>
@endsection
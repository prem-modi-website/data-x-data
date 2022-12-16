@extends('frontend.partial.master') @inject('cat', 'App\Category') @section('content')
<!--hero section start-->

<!--<section class="hero-banner z-index-1 overflow-hidden py-5" data-bg-img="{{asset('frontend/assets/images/bg/04.png')}}">-->
<!--    <div class="container">-->
<!--        <div class="row align-items-center">-->
<!--            <div class="col-12 col-lg-6">-->
<!--                <h1 class="mb-4">Lorem, ipsum dolor.<span class="font-w-6 px-2 text-primary text-uppercase my-2 d-inline-block" data-bg-color="rgba(0,73,208,0.05)">Lorem</span></h1>-->
<!--                <p class="lead mb-5 text-grey">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Alias, temporibus. Accusamus ut doloribus optio recusandae architecto nostrum quae? Unde</p>-->

<!--                <div class="subscribe-form text-center bg-white p-3 rounded">-->
<!--                    <form action="{{route('getCategory')}}" method="get">-->
<!--                        <div class="input-group">-->
<!--                            <input type="text" class="form-control" name="search" placeholder="Search by Category Name, State, Country & City" aria-label="Search by Category Name, State, Country & City" />-->
<!--                            <button class="btn btn-dark" type="submit">Search Data</button>-->
<!--                        </div>-->
<!--                    </form>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-12 col-lg-6 mb-5 mb-lg-0 position-relative text-center">-->
<!--                <div class="box_outside">-->
<!--                    <div id="box"></div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->

<section class="hero-banner z-index-1 overflow-hidden py-5" data-bg-img="{{asset('frontend/assets/images/bg/04.png')}}" style="background-image:url({{asset('frontend/assets/images/bg/04.png')}})">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 col-lg-12 text-center">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <h1 class="mb-4">Lorem, ipsum dolor.<span class="font-w-6 px-2 text-primary text-uppercase my-2 d-inline-block" data-bg-color="rgba(0,73,208,0.05)">Lorem</span></h1>
                        <p class="lead mb-5 text-grey">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Alias, temporibus. Accusamus ut doloribus optio recusandae architecto nostrum quae? Unde</p>
                    </div>
                </div>
                <div class="subscribe-form text-center bg-white p-3 rounded">
                    <form action="{{route('getCategory')}}" method="get">
                        <div class="row">
                            <div class="col-lg-2 col-md-4 col-sm-12 custom_input">
                                <div class="input-group">
                                    <!--<input type="text" class="form-control theme_select2" name="search" placeholder="Search by Category Name, State, Country & City" aria-label="Search by Category Name, State, Country & City" />-->
                                    <select class="form-control theme_select2" name="category">
                                        <option value="" selected>Select Category</option>
                                        @if(count($categories))
                                            @foreach($categories as $cat)
                                                <option value="{{$cat->name}}">{{$cat->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-12 custom_input">
                                <div class="input-group">
                                    <!--<input type="text" class="form-control" name="search" placeholder="Search by Category Name, State, Country & City" aria-label="Search by Category Name, State, Country & City" />-->
                                     <select class="form-control theme_select2" name="state">
                                        <option value="" selected>Select State</option>
                                        @if(count($states))
                                            @foreach($states as $st)
                                                <option value="{{$st->state}}">{{$st->state}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-12 custom_input">
                                <div class="input-group">
                                    <!--<input type="text" class="form-control" name="search" placeholder="Search by Category Name, State, Country & City" aria-label="Search by Category Name, State, Country & City" />-->
                                     <select class="form-control theme_select2" name="city">
                                        <option value="" selected>Select City</option>
                                        @if(count($cities))
                                            @foreach($cities as $cit)
                                                <option value="{{$cit->city}}">{{$cit->city}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-12 custom_input">
                                <div class="input-group">
                                    <!--<input type="text" class="form-control" name="search" placeholder="Search by Category Name, State, Country & City" aria-label="Search by Category Name, State, Country & City" />-->
                                     <select class="form-control theme_select2" name="country">
                                        <option value="" selected>Select Country</option>
										@if(count($countries))
                                            @foreach($countries as $co)
                                                <option value="{{$co->country}}">{{$co->country}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-12 custom_input">
                                <div class="input-group">
                                    <!--<input type="text" class="form-control" name="search" placeholder="Search by Category Name, State, Country & City" aria-label="Search by Category Name, State, Country & City" />-->
                                     <select class="form-control theme_select2" name="pincode">
                                        <option value="" selected>Select Pincode</option>
										@if(count($pincodes))
                                            @foreach($pincodes as $pin)
                                                <option value="{{$pin->pin_code}}">{{$pin->pin_code}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-12 custom_input">
                                <div class="input-group">
                                    <button class="btn btn-dark w-100" type="submit">Search Data</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--<div class="col-12 col-lg-6 mb-5 mb-lg-0 position-relative text-center">-->
            <!--    <div class="box_outside">-->
            <!--        <div id="box"></div>-->
            <!--    </div>-->
            <!--</div>-->
        </div>
    </div>
</section>
<!--hero section end-->

<!--services start-->

<section class="overflow-hidden position-relative pb-5 service_carousal">
    <div class="container-fluid px-lg-10">
        <div class="row justify-content-center text-center">
            <div class="col-12 col-lg-8">
                <div class="mb-5">
                    <h6 class="font-w-5 mb-3 position-relative py-1 px-3 text-primary rounded subtitle-effect box-shadow d-inline-block bg-white">
                        <span>Services</span>
                    </h6>
                    <h2 class="mb-0"><span class="font-w-5 d-block">checkout we provide</span> awesome and creative services</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="owl-carousel" data-items="4" data-xxl-items="3" data-xl-items="2" data-lg-items="2" data-md-items="2" data-sm-items="1" data-autoplay="true">
                    @if(count($categories)) @foreach($categories as $category)
                    <div class="item">
                        <div class="featured-item mx-4 text-center overflow-hidden p-5 bg-white rounded mt-5">
                            <div class="featured-icon w-auto h-auto">
                                <img class="img-fluid" src="{{asset('images/').'/'.$category->image}}" alt="" />
                            </div>
                            <div class="featured-desc mt-4">
                                <h5 class="mb-3">{{$category->name}}</h5>
                                <a class="btn-link mt-4" href="{{route('getCategory')}}"><i class="las la-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach @else

                    <div class="item">
                        <div class="featured-item mx-4 text-center overflow-hidden p-5 bg-white rounded">
                            <div class="featured-desc mt-4">
                                <h5 class="mb-3">No data available.</h5>
                            </div>
                        </div>
                    </div>
                    @endif {{--
                    <div class="item">
                        <div class="featured-item mx-4 text-center overflow-hidden p-5 bg-white rounded mt-5">
                            <div class="featured-icon w-auto h-auto">
                                <img class="img-fluid" src="assets/images/category/cloud-service.png" alt="" />
                            </div>
                            <div class="featured-desc mt-4">
                                <h5 class="mb-3">Cloud Services</h5>
                                <a class="btn-link mt-4" href="category.html"><i class="las la-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="featured-item mx-4 text-center overflow-hidden p-5 bg-white rounded">
                            <div class="featured-icon w-auto h-auto">
                                <img class="img-fluid" src="assets/images/category/networking-services.png" alt="" />
                            </div>
                            <div class="featured-desc mt-4">
                                <h5 class="mb-3">Networking</h5>
                                <a class="btn-link mt-4" href="category.html"><i class="las la-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
                    --}}
                </div>
            </div>
        </div>
    </div>
</section>

<!--services end-->

<!--who we are start-->

<section class="bg-dark custom-pt-1 pb-10 z-index-1 shape-sec">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-12 col-lg-6 mb-6 mb-lg-0">
                <img class="img-fluid topBottom" src="{{asset('frontend/assets/images/about/02.png')}}" alt="" />
            </div>
            <div class="col-12 col-lg-6">
                <div class="mb-3">
                    <h6 class="font-w-5 mb-3 position-relative py-1 px-3 text-white rounded subtitle-effect box-shadow bg-primary d-inline-block">
                        <span>About Us</span>
                    </h6>
                    <h2 class="mb-0 text-white"><span class="font-w-5">Boost your Analytics</span> Solutions with Stacht</h2>
                </div>
                <p class="lead mb-4 text-light">We use the latest technologies it voluptatem accusantium doloremque laudantium. This article is intended including.</p>
                <div class="ht-progress-bar mb-3">
                    <h4>Data Consulting</h4>
                    <div class="skillbar" data-percent="74">
                        <p class="skillbar-bar"></p>
                        <span class="skill-bar-percent"></span>
                    </div>
                </div>
                <div class="ht-progress-bar mb-3">
                    <h4>Big Data</h4>
                    <div class="skillbar" data-percent="66">
                        <p class="skillbar-bar"></p>
                        <span class="skill-bar-percent"></span>
                    </div>
                </div>
                <div class="ht-progress-bar">
                    <h4>Predictive Analysis</h4>
                    <div class="skillbar" data-percent="82">
                        <p class="skillbar-bar"></p>
                        <span class="skill-bar-percent"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="curve-shape top-0 overflow-hidden" style="height: 200px;">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none" class="w-100 h-100">
            <path
                fill="#fff"
                fill-opacity="1"
                d="M0,192L24,202.7C48,213,96,235,144,224C192,213,240,171,288,144C336,117,384,107,432,133.3C480,160,528,224,576,218.7C624,213,672,139,720,122.7C768,107,816,149,864,144C912,139,960,85,1008,80C1056,75,1104,117,1152,160C1200,203,1248,245,1296,224C1344,203,1392,117,1416,74.7L1440,32L1440,0L1416,0C1392,0,1344,0,1296,0C1248,0,1200,0,1152,0C1104,0,1056,0,1008,0C960,0,912,0,864,0C816,0,768,0,720,0C672,0,624,0,576,0C528,0,480,0,432,0C384,0,336,0,288,0C240,0,192,0,144,0C96,0,48,0,24,0L0,0Z"
            ></path>
        </svg>
    </div>
</section>

<!--who we are end-->

<!--counter start-->

<section class="pt-0 pb-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-10 col-xl-12">
                <div class="box-shadow p-5 bg-white rounded mt-n7 z-index-1">
                    <div class="row">
                        <div class="col-12 col-lg-3 col-sm-6">
                            <div class="counter d-flex align-items-center style-2">
                                <div class="me-3 flex-shrink-0">
                                    <img class="img-fluid" src="{{asset('frontend/assets/images/icon/counter/01.png')}}" alt="" />
                                </div>
                                <div class="counter-desc flex-grow-1 text-dark">
                                    <span class="count-number h2" data-to="15" data-speed="1000">15</span>
                                    <span class="h2">+</span>
                                    <h6 class="text-grey mb-0 font-w-5">Projects Executed</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3 col-sm-6 mt-5 mt-sm-0">
                            <div class="counter d-flex align-items-center style-2">
                                <div class="me-3 flex-shrink-0">
                                    <img class="img-fluid" src="{{asset('frontend/assets/images/icon/counter/02.png')}}" alt="" />
                                </div>
                                <div class="counter-desc flex-grow-1 text-dark">
                                    <span class="count-number h2" data-to="73" data-speed="1000">73</span>
                                    <span class="h2">+</span>
                                    <h6 class="text-grey mb-0 font-w-5">Data Analytics</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3 col-sm-6 mt-5 mt-lg-0">
                            <div class="counter d-flex align-items-center style-2">
                                <div class="me-3 flex-shrink-0">
                                    <img class="img-fluid" src="{{asset('frontend/assets/images/icon/counter/03.png')}}" alt="" />
                                </div>
                                <div class="counter-desc flex-grow-1 text-dark">
                                    <span class="count-number h2" data-to="88" data-speed="1000">88</span>
                                    <span class="h2">+</span>
                                    <h6 class="text-grey mb-0 font-w-5">People Loved</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3 col-sm-6 mt-5 mt-lg-0">
                            <div class="counter d-flex align-items-center style-2">
                                <div class="me-3 flex-shrink-0">
                                    <img class="img-fluid" src="{{asset('frontend/assets/images/icon/counter/04.png')}}" alt="" />
                                </div>
                                <div class="counter-desc flex-grow-1 text-dark">
                                    <span class="count-number h2" data-to="104" data-speed="1000">104</span>
                                    <span class="h2">+</span>
                                    <h6 class="text-grey mb-0 font-w-5">Happy Customers</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--counter end-->

<!--tab start-->

<section>
    <div class="container z-index-1">
        <div class="row">
            <div class="col">
                <div class="tab bg-white box-shadow">
                    <!-- Tab panes -->
                    <div class="tab-content px-5 py-8" id="nav-tabContent">
                        <div role="tabpanel" class="tab-pane fade show active" id="tab1-1">
                            <div class="row align-items-center">
                                <div class="col-lg-6 col-md-12">
                                    <img class="img-fluid" src="{{asset('frontend/assets/images/tab/01.jpg')}}" alt="" />
                                </div>
                                <div class="col-lg-6 col-md-12 mt-5 mt-lg-0">
                                    <h4 class="mb-4">Powerful & Awesome Marketing</h4>
                                    <p class="mb-4">We use the latest technologies it voluptatem accusantium doloremque laudantium. This article is intended to help</p>
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="me-2">
                                            <span class="list-dot"><i class="las la-check-circle"></i></span>
                                        </div>
                                        <div>
                                            <p class="mb-0">Import Data For Real-Time</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="me-2">
                                            <span class="list-dot"><i class="las la-check-circle"></i></span>
                                        </div>
                                        <div>
                                            <p class="mb-0">Operating Modern Design</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">
                                            <span class="list-dot"><i class="las la-check-circle"></i></span>
                                        </div>
                                        <div>
                                            <p class="mb-0">Provide Realtime Data Solutions</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab1-2">
                            <div class="row align-items-center">
                                <div class="col-lg-6 col-md-12">
                                    <img class="img-fluid" src="{{asset('frontend/assets/images/tab/02.jpg')}}" alt="" />
                                </div>
                                <div class="col-lg-6 col-md-12 mt-5 mt-lg-0">
                                    <h4 class="mb-4">Powerful & Awesome Marketing</h4>
                                    <p class="mb-4">We use the latest technologies it voluptatem accusantium doloremque laudantium. This article is intended to help</p>
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="me-2">
                                            <span class="list-dot"><i class="las la-check-circle"></i></span>
                                        </div>
                                        <div>
                                            <p class="mb-0">Import Data For Real-Time</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="me-2">
                                            <span class="list-dot"><i class="las la-check-circle"></i></span>
                                        </div>
                                        <div>
                                            <p class="mb-0">Operating Modern Design</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">
                                            <span class="list-dot"><i class="las la-check-circle"></i></span>
                                        </div>
                                        <div>
                                            <p class="mb-0">Provide Realtime Data Solutions</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab1-3">
                            <div class="row align-items-center">
                                <div class="col-lg-6 col-md-12">
                                    <img class="img-fluid" src="{{asset('frontend/assets/images/tab/03.jpg')}}" alt="" />
                                </div>
                                <div class="col-lg-6 col-md-12 mt-5 mt-lg-0">
                                    <h4 class="mb-4">Powerful & Awesome Marketing</h4>
                                    <p class="mb-4">We use the latest technologies it voluptatem accusantium doloremque laudantium. This article is intended to help</p>
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="me-2">
                                            <span class="list-dot"><i class="las la-check-circle"></i></span>
                                        </div>
                                        <div>
                                            <p class="mb-0">Import Data For Real-Time</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="me-2">
                                            <span class="list-dot"><i class="las la-check-circle"></i></span>
                                        </div>
                                        <div>
                                            <p class="mb-0">Operating Modern Design</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">
                                            <span class="list-dot"><i class="las la-check-circle"></i></span>
                                        </div>
                                        <div>
                                            <p class="mb-0">Provide Realtime Data Solutions</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab1-4">
                            <div class="row align-items-center">
                                <div class="col-lg-6 col-md-12">
                                    <img class="img-fluid" src="{{asset('frontend/assets/images/tab/02.jpg')}}" alt="" />
                                </div>
                                <div class="col-lg-6 col-md-12 mt-5 mt-lg-0">
                                    <h4 class="mb-4">Powerful & Awesome Marketing</h4>
                                    <p class="mb-4">We use the latest technologies it voluptatem accusantium doloremque laudantium. This article is intended to help</p>
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="me-2">
                                            <span class="list-dot"><i class="las la-check-circle"></i></span>
                                        </div>
                                        <div>
                                            <p class="mb-0">Import Data For Real-Time</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="me-2">
                                            <span class="list-dot"><i class="las la-check-circle"></i></span>
                                        </div>
                                        <div>
                                            <p class="mb-0">Operating Modern Design</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">
                                            <span class="list-dot"><i class="las la-check-circle"></i></span>
                                        </div>
                                        <div>
                                            <p class="mb-0">Provide Realtime Data Solutions</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Nav tabs -->
                    <nav>
                        <div class="nav nav-tabs border-0 text-center box-shadow" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-tab1" data-bs-toggle="tab" href="#tab1-1" role="tab" aria-selected="true">
                                <div class="tab-icon">
                                    <img class="img-fluid" src="{{asset('frontend/assets/images/tab/icon/01.png')}}" alt="" />
                                </div>
                                <h5>Management</h5>
                            </a>
                            <a class="nav-item nav-link" id="nav-tab2" data-bs-toggle="tab" href="#tab1-2" role="tab" aria-selected="false">
                                <div class="tab-icon">
                                    <img class="img-fluid" src="{{asset('frontend/assets/images/tab/icon/02.png')}}" alt="" />
                                </div>
                                <h5>Marketing</h5>
                            </a>
                            <a class="nav-item nav-link" id="nav-tab3" data-bs-toggle="tab" href="#tab1-3" role="tab" aria-selected="false">
                                <div class="tab-icon">
                                    <img class="img-fluid" src="{{asset('frontend/assets/images/tab/icon/03.png')}}" alt="" />
                                </div>
                                <h5>Analysis</h5>
                            </a>
                            <a class="nav-item nav-link" id="nav-tab4" data-bs-toggle="tab" href="#tab1-4" role="tab" aria-selected="false">
                                <div class="tab-icon">
                                    <img class="img-fluid" src="{{asset('frontend/assets/images/tab/icon/04.png')}}" alt="" />
                                </div>
                                <h5>Strategy</h5>
                            </a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<!--tab end-->

<!--price table start-->

<!-- <section class="shape-1 right position-relative"> -->
<section>
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8 col-md-10 col-12">
                <div class="mb-6">
                    <h6 class="font-w-5 mb-3 position-relative py-1 px-3 text-primary rounded subtitle-effect box-shadow d-inline-block bg-white">
                        <span>Pricing</span>
                    </h6>
                    <h2 class="mb-0"><span class="font-w-5">Choose the best</span> deal we offer</h2>
                </div>
            </div>
        </div>
        <div class="owl-carousel row" data-nav="true" data-items="3" data-xxl-items="3" data-xl-items="2" data-lg-items="2" data-md-items="2" data-sm-items="1" data-autoplay="true" data-dots="false">
            @if(count($packages)) @foreach($packages as $package)
            <div class="package_items col-lg-11">
                <div class="price-table rounded bg-white box-shadow">
                    <!-- <div class="price-title ps-5">{{--$package->category->name--}}</div> -->
                    <div class="price-value my-3 ps-3 d-flex justify-content-between align-items-center">
                        <h2 class="mb-0 me-3 text-primary"><i class="las la-rupee-sign"></i>{{$package->package_amount}}/-</h2>
                    </div>
                    <div class="price-list ps-5">
                        <ul class="list-unstyled">
                            <li class="mb-3">{{$package->package_count }} Data Count</li>
                            <li class="mb-3">90% - 95% Accuracy</li>
                            <li class="mb-3">More then 25+ Categorys</li>
                            <li class="mb-3">Instant Data Delivery</li>
                            <li class="mb-3">Whatsapp Active status on request</li>
                        </ul>
                    </div>
                    <a class="btn btn-dark mt-5 ms-5 purchasePackage" data-qty="{{$cat::excelCount($package->category_id)}}" id="{{$package->id}}"> <span>Buy Now</span> </a>
                </div>
            </div>
            @endforeach @else
            <p>No data available.</p>
            @endif
        </div>
    </div>
</section>

<!--price table end-->

<!--Comming Soon start-->

<section class="">
    <div class="container">
        <div class="row">
            <div class="col">
                <div
                    class="bg-primary box-shadow py-4 px-4 px-lg-8 py-lg-8 text-center rounded z-index-1"
                    data-bg-img="{{asset('frontend/assets/images/bg/04-1.png')}}"
                    style="background-image:url({{asset('frontend/assets/images/bg/04-1.png')}})"
                >
                    <div class="row justify-content-center">
                        <div class="col-xxl-9 col-xl-10 col-lg-12">
                            <div class="mb-5">
                                <h6 class="font-w-5 mb-3 position-relative py-1 px-3 text-primary bg-white rounded subtitle-effect box-shadow d-inline-block">
                                    <span>Latest Update</span>
                                </h6>
                                <h2 class="mb-0 text-white">
                                    <span class="font-w-5">Comming Soon</span><br />
                                    Different Industrial Email Address
                                </h2>
                            </div>
                            <a class="btn btn-dark mt-0 ms-5" href="#"> <span>Contact us Now</span> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Comming Soon end-->

<!--blog start-->

<section class="position-relative shape-both overflow-hidden">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8 col-md-10 col-12">
                <div class="mb-6">
                    <h6 class="font-w-5 mb-3 position-relative py-1 px-3 text-primary rounded subtitle-effect box-shadow d-inline-block bg-white">
                        <span>Blogs</span>
                    </h6>
                    <h2 class="mb-0"><span class="font-w-5">Our blog</span> Latest feed</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4 mb-5 mb-lg-0">
                <!-- Blog Card -->
                <div class="card post-card rounded border-0">
                    <img class="rounded img-fluid" src="{{asset('frontend/assets/images/blog/01.jpg')}}" alt="Image" />
                    <div class="card-body p-4">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="#" class="text-grey"><i class="lar la-user-circle me-1"></i> Admin</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="text-grey"><i class="las la-eye me-1"></i> 05 Jan, 2022</a>
                            </li>
                        </ul>
                        <h2 class="h4 my-3">Grow your business insights with inspiring news</h2>
                        <a class="post-btn float-end" href="blog-single.html"><i class="las la-long-arrow-alt-right"></i></a>
                    </div>
                </div>
                <!-- End Blog Card -->
            </div>
            <div class="col-md-6 col-lg-4 mb-5 mb-lg-0">
                <!-- Blog Card -->
                <div class="card post-card rounded border-0">
                    <img class="rounded img-fluid" src="{{asset('frontend/assets/images/blog/02.jpg')}}" alt="Image" />
                    <div class="card-body p-4">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="#" class="text-grey"><i class="lar la-user-circle me-1"></i> Admin</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="text-grey"><i class="las la-eye me-1"></i> 05 Jan, 2022</a>
                            </li>
                        </ul>
                        <h2 class="h4 my-3">Stacht is a big milestone for your business success</h2>
                        <a class="post-btn float-end" href="blog-single.html"><i class="las la-long-arrow-alt-right"></i></a>
                    </div>
                </div>
                <!-- End Blog Card -->
            </div>
            <div class="col-md-6 col-lg-4">
                <!-- Blog Card -->
                <div class="card post-card rounded border-0">
                    <img class="rounded img-fluid" src="{{asset('frontend/assets/images/blog/03.jpg')}}" alt="Image" />
                    <div class="card-body p-4">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="#" class="text-grey"><i class="lar la-user-circle me-1"></i> Admin</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="text-grey"><i class="las la-eye me-1"></i> 05 Jan, 2022</a>
                            </li>
                        </ul>
                        <h2 class="h4 my-3">New ideas for a lowest cost Design Service better</h2>
                        <a class="post-btn float-end" href="blog-single.html"><i class="las la-long-arrow-alt-right"></i></a>
                    </div>
                </div>
                <!-- End Blog Card -->
            </div>
        </div>
    </div>
</section>

<!--blog end-->
@endsection @section('script')
<script>
    $(document).on("click", ".purchasePackage", function () {
        var getId = $(this).attr("id");
        var getQty = $(this).attr("data-qty");
        $.ajax({
            url: "{{ route('addToCart') }}",
            data: { package_id: getId, qty: getQty },
            type: "GET",
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function (result) {
                console.log("===== " + result.message + " =====");
                $(".purchaseQty_" + getId).val("");
                window.location.href = "{{ route('checkout') }}";

                getProduct();
            },
            error: function (error) {
                if (error.status == 401) {
                    Swal.fire({
                        title: "You will need to login first",
                        showCancelButton: true,
                        confirmButtonColor: "rgb(69 133 141)",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, login it!",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('customer-login') }}";
                        }
                    });
                } else {
                    Swal.fire({
                        title: error.responseJSON.message,
                        showCancelButton: true,
                        confirmButtonColor: "rgb(69 133 141)",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ok",
                    });
                }
            },
        });
    });
</script>
@endsection

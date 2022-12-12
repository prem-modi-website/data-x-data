<!-- preloader start -->
<div id="ht-preloader">
    <div class="clear-loader d-flex align-items-center justify-content-center">
        <div class="loader"><span>Data-X-Data</span></div>
    </div>
</div>
<!-- preloader end -->
<!--header start-->
<header id="site-header" class="header">
    <div id="header-wrap">
        <div class="container">
            <div class="row">
                <div class="col">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand logo mb-0" href="/">
                            <img class="img-fluid" src="{{asset('frontend/assets/images/logo.png')}}" alt="" />
                        </a>
                        <div class="navbar_main_reverse">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav mx-auto">
                                    <!-- Home -->
                                    <li class="nav-item"><a class="nav-link" href="{{route('home')}}">Home</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{route('about')}}">About Us</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{route('packages')}}">Packages</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{route('getCategory')}}">Category</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{route('contact')}}">Contact Us</a></li>
                                </ul>
                            </div>
                            <div class="right-nav align-items-center d-flex justify-content-end">
                                
                                <div class="cart">
                                    <a href="#" id="header-cart-btn" data-bs-toggle="modal" data-bs-target="#cartModal">
                                        <span class="bg-white rounded px-2 py-1 shadow-sm" data-cart-items="">
                                            <i class="las la-shopping-cart headCart"></i>
                                        </span>
                                    </a>
                                </div>
                                @if(auth()->user())
                                    @if(auth()->user()->is_active == 1)

                                    <a class="btn btn-white ms-md-4 d-xl-inline-block d-none login-button" href="{{route('customerLogout')}}">Logout</a>
                                    @else
                                    <a class="btn btn-white ms-md-4 d-xl-inline-block d-none login-button" href="{{route('customer-login')}}">Login</a>
                                    @endif
                                @else
                                <a class="btn btn-white ms-md-4 d-xl-inline-block d-none login-button" href="{{route('customer-login')}}">Login</a>
                                @endif
                                <!-- <a href="#" class="ht-nav-toggle ms-md-4 ms-3"><span></span></a> -->
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<div id="search">
    <button type="button" class="close"><i class="las la-times"></i></button>
    <form>
        <input type="search" value="" placeholder="Search by Category Name, State, Country & City" />
        <button type="button" class="btn btn-primary">Search</button>
    </form>
</div>
<!--header end-->

<!-- Cart Modal -->
<div class="modal fade cart-modal" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Your Cart</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="headerCart">
              
            </div>
        </div>
    </div>
</div>

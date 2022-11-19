<footer class="bg-dark custom-pt-05 pb-4 position-relative">
                <div class="primary-footer z-index-1">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-6 col-xl-4">
                                <a class="footer-logo" href="index.html">
                                <img class="img-fluid" src="{{asset('frontend/assets/images/footer-logo.png')}}" alt="">
                                </a>
                                <p class="my-4 text-rgba">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolorem natus
                                    voluptate similique laudantium rem. Nam rerum mollitia commodi magni voluptates.
                                </p>
                                <ul class="media-icon list-unstyled font-w-5 mb-3">
                                    <li><i class="las la-envelope-open-text"></i> <a
                                        href="mailto:info@dataxdata.com">info@dataxdata.com</a>
                                    </li>
                                </ul>
                                <div class="social-icons social-colored footer-social">
                                    <ul class="list-inline">
                                        <li><a href="#"><i class="lab la-facebook-f"></i></a>
                                        </li>
                                        <li><a href="#"><i class="lab la-twitter"></i></a>
                                        </li>
                                        <li><a href="#"><i class="lab la-instagram"></i></a>
                                        </li>
                                        <li><a href="#"><i class="lab la-linkedin-in"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-3 col-xl-2 mt-6 mt-lg-0 footer-list">
                                <h5 class="mb-4 text-white">Quick Link</h5>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-3"><a class="list-group-item-action" href="{{route('about')}}">About Us</a></li>
                                    <li class="mb-3"><a class="list-group-item-action" href="{{route('contact')}}">Contact Us</a></li>
                                    <li class="mb-3"><a class="list-group-item-action" href="{{route('customer-login')}}">Login</a></li>
                                    <li class="mb-3"><a class="list-group-item-action" href="{{route('signup')}}">SignUp</a></li>
                                    <li class="mb-3"><a class="list-group-item-action" href="{{route('termAndCondition')}}">Terms and Conditions</a></li>
                                    <li class="mb-3"><a class="list-group-item-action" href="{{route('privacyPolicy')}}">Privacy and Policy</a></li>
                                </ul>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-3 col-xl-2 mt-6 mt-lg-0 footer-list">
                                <h5 class="mb-4 text-white">Our Category</h5>
                                <ul class="list-unstyled mb-0">
                                    @if(count($cat::getCategory()))
                                        @foreach($cat::getCategory() as $c)
                                        <li class="mb-3"><a class="list-group-item-action" href="{{route('getCategory')}}">{{$c->name}}</a></li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            <div class="col-12 col-lg-6 col-xl-4 mt-6 mt-xl-0">
                                <h5 class="mb-1 text-white">Add to BlackList</h5>
                                <div class="subscribe-form blacklist-form text-center p-3 rounded">
                                    <form id="mc-form">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Enter your Black List Mobile Number"
                                                aria-label="Enter your Black List Mobile Number" required="">
                                            <button class="btn btn-dark">Add to BlackList</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="secondary-footer mt-5 border-top border-dark pt-4">
                    <div class="container">
                        <div class="row text-center">
                            <div class="col text-white">Copyright ©2022 All rights reserved | Data X Data
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

             <!--back-to-top start-->
        <div class="scroll-top">
            <a class="smoothscroll" href="#top"><img class="img-fluid" src="{{asset('frontend/assets/images/top-arrow.png')}}" alt="" /></a>
        </div>
        <!--back-to-top end-->
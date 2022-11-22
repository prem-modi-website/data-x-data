@extends('frontend.partial.master')

@section('breadcumb')
     <!--hero section start-->
        <section class="page-title position-relative overflow-hidden shape-1 right">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="bg-white p-md-5 p-3 d-inline-block">
                            <h1 class="font-w-3 mb-4"><span class="text-primary font-w-5">Contact</span> Us</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="las la-home me-1"></i>Home</a>
                                    </li>
                                    <!-- <li class="breadcrumb-item">Pages</li>
                                        <li li class="breadcrumb-item">Contact Us</li> -->
                                    <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
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
 <!--contact form start-->
                <section>
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="bg-white box-shadow p-3 rounded">
                                    <div class="row">
                                        <div class="col-lg-8 p-lg-5">
                                            <div class="mb-5">
                                                <h6 class="font-w-5 mb-3 position-relative py-1 px-3 text-primary rounded subtitle-effect box-shadow d-inline-block">
                                                    <span>Contact Us</span>
                                                </h6>
                                                <h2 class="mb-0"><span class="font-w-5">Describe your project and</span> leave us your contact info</h2>
                                            </div>
                                            <form id="contact-form2" class="row" method="post" action="{{route('contactMail')}}">
                                                @csrf
                                                <div class="messages"></div>
                                                <div class="col-md-6 mb-3">
                                                    <input id="form_name" type="text" name="first_name" class="form-control" placeholder="First Name" required>
                                                </div>
                                                @if($errors->has('first_name'))
                                                    <div class="error">{{ $errors->first('first_name') }}</div>
                                                @endif
                                                <div class="col-md-6 mb-3">
                                                    <input id="form_name1" type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                                                </div>
                                                @if($errors->has('last_name'))
                                                    <div class="error">{{ $errors->first('last_name') }}</div>
                                                @endif
                                                <div class="col-md-6 mb-3">
                                                    <input id="form_email" type="email" name="email" class="form-control" placeholder="Email" required>
                                                </div>
                                                @if($errors->has('email'))
                                                    <div class="error">{{ $errors->first('email') }}</div>
                                                @endif
                                                <div class="col-md-6 mb-3">
                                                    <input id="form_phone" type="tel" name="phone" class="form-control" placeholder="Phone" required>
                                                </div>
                                                @if($errors->has('phone'))
                                                    <div class="error">{{ $errors->first('phone') }}</div>
                                                @endif
                                                <div class="col-md-12">
                                                    <textarea id="form_message" name="message" class="form-control h-auto" placeholder="Message" rows="4" required></textarea>
                                                </div>
                                                @if($errors->has('message'))
                                                    <div class="error">{{ $errors->first('message') }}</div>
                                                @endif
                                                <div class="col mt-5">
                                                    <button class="btn btn-primary" type="submit">Send Messages</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-lg-4 mt-5 mt-lg-0">
                                            <div class="bg-primary rounded py-5 px-md-5 p-3 h-100" data-bg-img="{{asset('frontend/assets/images/bg/wave.png')}}">
                                                <div class="mb-4">
                                                    <h3 class="font-w-3 mb-2 text-white"><span class="font-w-5">Contact</span> information</h3>
                                                    <p class="lead text-light">We love to hear from you. Our friendly team is always here to chat</p>
                                                </div>
                                                <div>
                                                    <div class="d-flex align-items-center contact-media mb-4">
                                                        <div class="me-3"> <i class="las la-envelope-open-text"></i>
                                                        </div>
                                                        <div>
                                                            <h5 class="mb-2 text-white">Email address</h5>
                                                            <a href="mailto:info@dataxdata.com"> info@dataxdata.com</a>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center contact-media">
                                                        <div class="me-3"> <i class="las la-phone-volume"></i>
                                                        </div>
                                                        <div>
                                                            <h5 class="mb-2 text-white">Phone number</h5>
                                                            <a href="tel:+912345678900">+91-234-567-8900</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="social-icons footer-social mt-5">
                                                    <ul class="list-inline">
                                                        <li><a href="#"><i class="lab la-facebook-f"></i></a>
                                                        </li>
                                                        <li><a href="#"><i class="lab la-twitter"></i></a>
                                                        </li>
                                                        <li><a href="#"><i class="lab la-instagram"></i></a>
                                                        </li>
                                                        <li><a href="#"><i class="lab la-dribbble"></i></a>
                                                        </li>
                                                        <li><a href="#"><i class="lab la-linkedin-in"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--contact form end-->
                <!--map start-->
                <section class="overflow-hidden pt-0 pb-0">
                    <div class="container-fluid p-0">
                        <div class="row">
                            <div class="col">
                                <div class="map">
                                    <iframe class="w-100 h-100 border-0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3672.011417828054!2d72.50539891496786!3d23.02335298495256!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e8458e3ef2625%3A0x43b9c64d265062f9!2sHSP%20Media%20Network%20%7C%20HSPSMS%20%7C%20HSP%20SMS!5e0!3m2!1sen!2sin!4v1662786125719!5m2!1sen!2sin" allowfullscreen=""></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--map end-->
@endsection
<!DOCTYPE html>
<html lang="en">
@inject('cat', 'App\Category')
<head>
        <meta charset="utf-8" />
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Title -->
        <title>Data-X-Data</title>
        <!-- Favicon Icon -->
        <link rel="shortcut icon" href="{{asset('frontend/assets/images/favicon-icon')}}.png" />
        <!--== bootstrap -->
        <link href="{{asset('frontend/assets/css/bootstrap.min')}}.css" rel="stylesheet" type="text/css" />
        <!--== font -->
        <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
        <!--== animate -->
        <link href="{{asset('frontend/assets/css/animate.css')}}" rel="stylesheet" type="text/css" />
        <!--== line-awesome -->
        <link href="{{asset('frontend/assets/css/line-awesome')}}.min.css" rel="stylesheet" type="text/css" />
        <!--== magnific-popup -->
        <link href="{{asset('frontend/assets/css/magnific-popup')}}.css" rel="stylesheet" type="text/css" />
        <!--== owl.carousel -->
        <link href="{{asset('frontend/assets/css/owl.carousel')}}.css" rel="stylesheet" type="text/css" />
        <!--== base -->
        <link href="{{asset('frontend/assets/css/base.css')}}" rel="stylesheet" type="text/css" />
        <!--== shortcodes -->
        <link href="{{asset('frontend/assets/css/shortcodes.css')}}" rel="stylesheet" type="text/css" />
        <!--== spacing -->
        <link href="{{asset('frontend/assets/css/spacing.css')}}" rel="stylesheet" type="text/css" />
        <!--== style -->
        <link href="{{asset('frontend/assets/css/style.css')}}" rel="stylesheet" type="text/css" />
        <!--== responsive -->
        <link href="{{asset('frontend/assets/css/responsive.css')}}" rel="stylesheet" type="text/css" />
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

        @yield('css')
        <style>
        .error{
                color: red !important;
            }
        </style>
    <!-- Additional library for page -->
</head>
<!--body with default sidebar pinned -->
<body>
        <!-- page wrapper start -->

        <div class="page-wrapper">
            <!--header start-->
            @include('frontend.partial.header')

            @yield('breadcumb')
            <!--header end-->

            <!--body content start-->

            <div class="page-content">
            @if($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Error!</strong> {{ $message }}
                </div>
            @endif
  
            @if($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade {{ Session::has('success') ? 'show' : 'in' }}" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Success!</strong> {{ $message }}
                </div>
            @endif

               
               @yield('content')
            </div>

            <!--body content end-->

            <!--footer start-->
            @include('frontend.partial.footer')

            <!--footer end-->
        </div>

        <!-- page wrapper end -->

        <!-- inject js start -->

        <!--== jquery -->
        <script src="{{asset('frontend/assets/js/jquery.min.js')}}"></script>

        <!--== bootstrap -->
        <script src="{{asset('frontend/assets/js/bootstrap.bundle.min.js')}}"></script>

        <!--== modernizr -->
        <script src="{{asset('frontend/assets/js/modernizr.min.js')}}"></script>

        <!--== owl-carousel -->
        <script src="{{asset('frontend/assets/js/owl.carousel.min.js')}}"></script>

        <!--== magnific-popup -->
        <script src="{{asset('frontend/assets/js/jquery.magnific-popup.min.js')}}"></script>

       

        <!--== countdown -->
        <script src="{{asset('frontend/assets/js/jquery.countdown.min.js')}}"></script>

        <!--== skill bars -->
        <script src="{{asset('frontend/assets/js/skill.bars.jquery.js')}}"></script>

        <!--== canvas -->
        <script src="{{asset('frontend/assets/js/canvas-js.js')}}"></script>

        <!--== theme-script -->
        <script src="{{asset('frontend/assets/js/theme-script.js')}}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @include('frontend.partial.ajax')

        @yield('script')

        <!-- inject js end -->
        <script>
            $(document).ready(function () {
                $(".package_main_wrapper").owlCarousel({
                    autoplay: true,
                    responsive: {
                        0: {
                            items: 1,
                        },

                        600: {
                            items: 3,
                        },

                        1024: {
                            items: 4,
                        },

                        1366: {
                            items: 2,
                        },
                    },
                });
            });
        </script>

<script>
        $(document).on('click','.blockButton',function(){
            var getInputVal = $('.blockInput').val();
        
            console.log('getInputVal',getInputVal);
            $.ajax({
        
                url : "{{ route('blockData') }}",
                data : {'number' : getInputVal},
                type : 'GET',
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                success : function(result){

                    console.log("===== " + result.message + " =====");
                    $('.blockInput').after('<span class="error">'+ result.message +'</span>');
                    $('.blockInput').val('');

                },
                error : function(error)
                {
                    console.log('error');
                    console.log(error.responseJSON);
                    console.log(error.status);
                    if(error.status == 401){
                        Swal.fire({
                            title: 'You will need to login first',
                            showCancelButton: true,
                            confirmButtonColor: 'rgb(69 133 141)',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, login it!'
                            }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "{{ route('customer-login') }}";
                            }
                        });
                    }else
                    {
                        Swal.fire({
                            title: error.responseJSON.message,
                            showCancelButton: true,
                            confirmButtonColor: 'rgb(69 133 141)',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                        });
                    }
                    
                }
            });
        });
    </script>
    </body>

</html>
@extends('frontend.partial.master')
@inject('cat', 'App\Category')

@section('breadcumb')
     <!--hero section start-->
            <section class="page-title position-relative overflow-hidden shape-1 right">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="bg-white p-md-5 p-3 d-inline-block">
                                <h1 class="font-w-3 mb-4"><span class="text-primary font-w-5">Packages</span></h1>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="{{route('home')}}"><i class="las la-home me-1"></i>Home</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Packages</li>
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
        <!--price table start-->
            <section class="">
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
                        @if(count($packages))
                            @foreach($packages as $package)
                                <div class="package_items col-lg-11">
                                    <div class="price-table rounded bg-white box-shadow">
                                        <div class="price-title ps-5">{{$package->category->name}}</div>
                                        <div class="price-value my-5 ps-5 d-flex justify-content-between align-items-center">
                                            <h2 class="mb-0 me-3 text-primary"><i class="las la-rupee-sign"></i>{{$package->package_amount}}/-</h2>
                                        </div>
                                        <div class="price-list ps-5">
                                            <ul class="list-unstyled">
                                                <li class="mb-3">{{$cat::excelCount($package->category_id)}} Data Count</li>
                                                <li class="mb-3">90% - 95% Accuracy</li>
                                                <li class="mb-3">More then 25+ Categorys</li>
                                                <li class="mb-3">Instant Data Delivery</li>
                                                <li class="mb-3">Whatsapp Active status on request</li>
                                            </ul>
                                        </div>
                                        <a class="btn btn-dark mt-5 ms-5 purchasePackage" data-qty="{{$cat::excelCount($package->category_id)}}" id="{{$package->id}}"> <span>Buy Now</span> </a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                        <p>No packages available</p>
                        @endif
                    </div>
                </div>
            </section>
        <!--price table end-->
@endsection

@section('script')
 <!--== counter -->
 <script>
    $(document).on('click','.purchasePackage',function(){
        console.log($(this).attr('id'));
        var getId = $(this).attr('id');
        var getQty = $(this).attr('data-qty');
        $.ajax({
       
            url : "{{ route('addToCart') }}",
            data : {'package_id' : getId, 'qty' : getQty},
            type : 'GET',
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success : function(result){

                console.log("===== " + result.message + " =====");
                $('.purchaseQty_'+getId).val('');
                window.location.href = "{{ route('checkout') }}";

                getProduct();

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
@endsection
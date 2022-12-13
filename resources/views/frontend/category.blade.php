@extends('frontend.partial.master')

@section('breadcumb')
     <!--hero section start-->
            <section class="page-title position-relative overflow-hidden shape-1 right">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="bg-white p-md-5 p-3 d-inline-block">
                                <h1 class="font-w-3 mb-4"><span class="text-primary font-w-5">Category </span>List</h1>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="{{route('home')}}"><i class="las la-home me-1"></i>Home</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Category List</li>
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
       <!--product start-->
                <section>
                    <div class="container">
                        <div class="row">
                            @if(count($categories))
                                @foreach($categories as $category)
                                    <div class="col-lg-4 col-sm-6 mt-5 d-flex">
                                        <div class="card product-card text-center">
                                            <div class="product-img position-relative">
                                                <img class="img-fluid rounded" src="{{asset('images/').'/'.$category->image}}" alt="{{$category->name}}" />
                                                <div class="sample_data_btn">
                                                <a class="btn-cart excel" href ="{{route('excelCategory',$category->id)}}" type="button" title="Sample Data for {{$category->name}}"><i
                                                        class="las la-download me-1"></i>&nbsp; Sample Data</a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="product-title">{{$category->name}}</div>
                                            </div>
                                            <div class="card-footer">
                                                <div>
                                                    <label>Enter Category Qty.</label>
                                                    <input type="text" class="purchaseQty_{{$category->id}}" placeholder="Enter your purchase Qty" />
                                                    <!-- <input type="text" list="cars" /> -->
                                                    <!-- <datalist id="cars">
                                                        <option>Volvo</option>
                                                        <option>Saab</option>
                                                        <option>Mercedes</option>
                                                        <option>Audi</option>
                                                        </datalist> -->
                                                </div>
                                                <div>
                                                    <button class="btn-cart mx-3 purchasePackage" id="purchaseQty_{{$category->id}}" type="button"><i
                                                        class="las la-shopping-cart me-1"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                            <p>No category available</p>
                            @endif
                            
                        </div>
                    </div>
                </section>
                <!--product end-->
@endsection
@section('script')
<script>
    $(document).on('click','.purchasePackage',function(){
        console.log($(this).attr('id'));
        var getId = $(this).attr('id').split('purchaseQty_')[1];
        var getQty = $('.purchaseQty_'+getId).val();
       
        console.log($('.purchaseQty_'+getId).val());
        $.ajax({
       
            url : "{{ route('addToCart') }}",
            data : {'category_id' : getId, 'qty' : getQty},
            type : 'GET',
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success : function(result){

                console.log("===== " + result.message + " =====");
                $('.purchaseQty_'+getId).val('');
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
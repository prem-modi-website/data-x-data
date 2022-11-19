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
                                        <li class="breadcrumb-item active" aria-current="page">Product Cart</li>
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
        <!--cart start-->
                <section>
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="table-responsive table-bordered border-bottom-0">
                                    <table class="cart-table table table-bordered text-center mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th scope="col">Product</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Remove</th>
                                            </tr>
                                        </thead>
                                        <tbody class="border-top-0">
                                            @if(count($products))
                                            @foreach($products as $product)
                                            <tr class="parent_{{$product->id}}">
                                                <td>
                                                    <div class="d-md-flex align-items-center">
                                                        <a href="#">
                                                            <img class="img-fluid rounded me-lg-2 mb-2 mb-lg-0" src="{{asset('images/').'/'.$product->package->category->image}}" alt="" />
                                                        </a>
                                                        <div class="text-left">
                                                            <div class="product-title"><a class="link-title" href="#">{{$product->package->category->name}}</a></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h6 class="mb-0"><i class="las la-rupee-sign"></i>{{$product->package->package_amount}}</h6>
                                                </td>
                                                <td>
                                                    <h6 class="mb-0">{{$product->qty}}</h6>
                                                </td>
                                                <td>
                                                    <h6 class="mb-0"><i class="las la-rupee-sign"></i>{{$product->package->package_amount}}</h6>
                                                </td>
                                                <td class="border-right-0">
                                                    <button type="submit" class="btn btn-primary btn-sm cartRemove" id="removeCart_{{$product->id}}"><i class="las la-times"></i></button>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td scope="col">No Data available</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-8 justify-content-center">
                            <div class="col-lg-6 mt-1 mt-lg-0">
                                <div class="rounded p-md-5 p-3 box-shadow">
                                    <h4 class="text-dark text-center mb-2">Cart Totals</h4>
                                    <div class="d-flex justify-content-between align-items-center border-bottom py-3"><span class="text-muted ">Subtotal</span> <span class="text-dark cartTotal"><i class="las la-rupee-sign"></i>{{$count}}</span></div>
                                    <div class="d-flex justify-content-between align-items-center pt-3 mb-5"><span class="text-dark h5 ">Total</span> <span class="text-dark font-weight-bold h5 cartTotal"><i class="las la-rupee-sign"></i>{{$count}}</span></div>
                                    <a class="btn btn-dark me-sm-2" href="{{route('checkout')}}">Proceed To Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--cart end-->
@endsection
@section('script')
<script>
    $(document).on('click','.cartRemove',function(){
        console.log($(this).attr('id'));
        var getId = $(this).attr('id').split('removeCart_')[1];
        var getQty = $('.parent_'+getId).remove();
       
        $.ajax({
       
            url : "{{ route('removeProduct') }}",
            data : {'id' : getId},
            type : 'GET',
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success : function(result){

                console.log("===== " + result.message + " =====");
                console.log(result.count);
                $('.cartTotal').html(`<i class="las la-rupee-sign"></i>`+result.count);

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
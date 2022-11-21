                
@if(count($products))
    @foreach($products as $product)
        <div class="parent_{{$product->id}}">
            <div class="row align-items-center">
                <div class="col-5 d-flex align-items-center">
                    <div class="me-4">
                        <button type="button" class="btn btn-primary btn-sm headercartRemove" id="removeCart_{{$product->id}}" ><i class="las la-times"></i></button>
                    </div>
                    <!-- Image -->
                    <a href="product-single.html">
                        <img class="img-fluid rounded" src="{{asset('images/').'/'.$product->package->category->image}}" alt="IT" />
                    </a>
                </div>
                <div class="col-7">
                    <!-- Title -->
                    <h6><a href="product-single.html">{{$product->package->category->name}}</a></h6>
                    <div class="product-meta">
                        <span class="me-2 text-primary"><i class="las la-rupee-sign px-2"></i>{{$product->package->package_amount}}</span><span class="text-muted">x {{$product->qty}}</span>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-4" />
    @endforeach
@else
@endif
<div class="d-flex justify-content-between align-items-center mb-6">
    <span class="text-muted">Subtotal:</span>
    <span class="text-dark"><i class="las la-rupee-sign px-2"></i>{{$count}}</span>
</div>
<a href="{{route('cart')}}" class="btn btn-primary me-2">View Cart</a>
<a href="{{route('checkout')}}" class="btn btn-dark">Continue To Checkout</a>
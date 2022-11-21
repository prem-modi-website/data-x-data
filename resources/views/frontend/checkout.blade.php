@extends('frontend.partial.master')

@section('breadcumb')
     <!--hero section start-->
     <section class="page-title position-relative overflow-hidden shape-1 right">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="bg-white p-md-5 p-3 d-inline-block">
                                <h1 class="font-w-3 mb-4"><span class="text-primary font-w-5">Product</span> Checkout</h1>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="{{route('home')}}"><i class="las la-home me-1"></i>Home</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Product Checkout</li>
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

                <!--checkout start-->
                <section>
                    <div class="container">
                        <form  action="{{route('customerOrder')}}" method="post">
                            @csrf
                            <div class="row">

                                <div class="col-lg-8 col-md-12">
                                    <div class="checkout-form box-shadow p-4 rounded">
                                        <h2 class="mb-5"><span class="font-w-5">Billing</span> details</h2>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="mb-2">First Name</label>
                                                    <input type="text" id="fname" name="firstname" class="form-control" />
                                                </div>
                                                @if($errors->has('firstname'))
                                                    <div class="error">{{ $errors->first('firstname') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="mb-2">Last Name</label>
                                                    <input type="text" id="lname" name="lastname" class="form-control" />
                                                </div>
                                                @if($errors->has('lastname'))
                                                    <div class="error">{{ $errors->first('lastname') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="mb-2">E-mail Address</label>
                                                    <input type="text" id="email" name="email" class="form-control" />
                                                </div>
                                                @if($errors->has('email'))
                                                    <div class="error">{{ $errors->first('email') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="mb-2">Phone Number</label>
                                                    <input type="text" name="phone" class="form-control" />
                                                </div>
                                                @if($errors->has('phone'))
                                                    <div class="error">{{ $errors->first('phone') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="mb-2">Company Name</label>
                                                    <input type="text" name="company_name" class="form-control" />
                                                </div>
                                                @if($errors->has('company_name'))
                                                    <div class="error">{{ $errors->first('company_name') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="mb-2">Country</label>
                                                    <input type="text" name="country" class="form-control" />
                                                </div>
                                                @if($errors->has('country'))
                                                    <div class="error">{{ $errors->first('country') }}</div>
                                                @endif
                                            </div>
                                        <!--  <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="mb-2">Select Country</label>
                                                    <select class="form-control form-select">
                                                        <option value="#">Select country</option>
                                                        <option value="#">Alaska</option>
                                                        <option value="#">China</option>
                                                        <option value="#">Japan</option>
                                                        <option value="#">Korea</option>
                                                        <option value="#">Philippines</option>
                                                    </select>
                                                </div>
                                            </div> -->
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="mb-2">Address</label>
                                                    <input type="text" name="address1" class="form-control" />
                                                </div>
                                                @if($errors->has('address1'))
                                                    <span class="error">{{ $errors->first('address1') }}</span>
                                                @endif
                                                <div class="mb-3">
                                                    <input type="text" name="address2" class="form-control" />
                                                </div>
                                                @if($errors->has('address2'))
                                                    <span class="error">{{ $errors->first('address2') }}</span>
                                                @endif
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="mb-2">Town/City</label>
                                                    <input type="text" name="city"id="towncity" class="form-control" />
                                                </div>
                                            </div>
                                            @if($errors->has('city'))
                                                <span class="error">{{ $errors->first('city') }}</span>
                                            @endif
                                            <div class="col-md-6">
                                                <div class="mb-3 mb-md-0">
                                                    <label class="mb-2">State</label>
                                                    <input type="text" name="state" class="form-control" />
                                                </div>
                                                @if($errors->has('state'))
                                                    <span class="error">{{ $errors->first('state') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3 mb-md-0">
                                                    <label class="mb-2">Zip/Postal Code</label>
                                                    <input type="text" name="postalcode" class="form-control" />
                                                </div>
                                                @if($errors->has('postalcode'))
                                                    <span class="error">{{ $errors->first('postalcode') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 mt-5 mt-lg-0">
                                    <div class="rounded p-4 bg-light">
                                        <h3 class="mb-3">Your Order</h3>
                                        <ul class="list-unstyled">
                                            @if(count($products))
                                            @foreach($products as $product)
                                            <li class="mb-3 border-bottom pb-3"><span> {{$product->qty}} x {{$product->package->category->name}} </span> <i class="las la-rupee-sign px-2"></i>{{$product->package->package_amount}} </li>
                                            @endforeach
                                            <li class="mb-3 border-bottom pb-3"><span> Subtotal </span> <i class="las la-rupee-sign px-2"></i>{{$count}}</li>
                                            <li>
                                                <span><strong class="cart-total"> Total :</strong></span> <strong class="cart-total"><i class="las la-rupee-sign px-2"></i> {{$count}}</strong>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="my-5">
                                        <h3 class="mb-3">Payment Method</h3>
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input type="radio" id="customRadio1" name="customRadio" class="form-check-input" />
                                                <label class="form-check-label" for="customRadio1">Direct Bank Tranfer</label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input type="radio" id="customRadio2" name="customRadio" class="form-check-input" />
                                                <label class="form-check-label" for="customRadio2">Check Payment</label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input type="radio" id="customRadio3" name="customRadio" class="form-check-input" />
                                                <label class="form-check-label" for="customRadio3">Paypal Account</label>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck1" />
                                                <label class="form-check-label" name="check" for="customCheck1">I have read and accept the terms and conditions</label>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" type="submit">Proceed to Payment</button>
                                </div>
                            </div>
                        </form>    
                    </div>
                </section>
                <!--checkout end-->
@endsection
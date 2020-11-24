@extends('layouts.frontLayout.front_design')
@section('content')
    <section id="form" style="margin-top:20px;"><!--form-->
        <div class="container">
            @if(Session::has('flash_message_error'))
                <div class="alert alert-error alert-block" style="background-color:#f4d2d2">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{!! session('flash_message_error') !!}</strong>
                </div>
            @endif
            <form action="{{ url('/checkout') }}" method="post">{{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-1">
                        <div class="login-form">
                            <h2>Billing Info</h2>
                            <div class="form-group">
                                <input name="billing_name" id="billing_name" @if(!empty($userDetails->name)) value="{{ $userDetails->name }}" @endif type="text" placeholder="Billing Name" class="form-control" />
                            </div>
                            <div class="form-group">
                                <input name="billing_address" id="billing_address" @if(!empty($userDetails->address)) value="{{ $userDetails->address }}" @endif type="text" placeholder="Address" class="form-control" />
                            </div>
                            <div class="form-group">
                                <input name="billing_city" id="billing_city" @if(!empty($userDetails->city)) value="{{ $userDetails->city }}" @endif type="text" placeholder="City" class="form-control" />
                            </div>
                            <div class="form-group">
                                <input name="billing_country" id="billing_country" @if(!empty($userDetails->country)) value="{{ $userDetails->country }}" @endif type="text" placeholder="Country" class="form-control" />
                            </div>
                            <div class="form-group">
                                <input name="billing_postcode" id="billing_postcode" @if(!empty($userDetails->postcode)) value="{{ $userDetails->postcode }}" @endif type="text" placeholder="Postcode" class="form-control" />
                            </div>
                            <div class="form-group">
                                <input name="billing_mobile" id="billing_mobile" @if(!empty($userDetails->mobile)) value="{{ $userDetails->mobile }}" @endif type="text" placeholder="Mobile No." class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <h2></h2>
                    </div>
                    <div class="col-sm-4">
                        <div class="signup-form" id="billingForm">
                            <h2>Deliver To</h2>
                            <div class="form-group">
                                <input name="shipping_name" id="shipping_name" @if(!empty($shippingDetails->name)) value="{{ $shippingDetails->name }}" @endif type="text" placeholder="Delivery Name" class="form-control" />
                            </div>
                            <div class="form-group">
                                <input name="shipping_room" id="shipping_room" @if(!empty($shippingDetails->room)) value="{{ $shippingDetails->room }}" @endif type="text" placeholder="Room No." class="form-control" />
                            </div>
                            <div class="form-group">
                                <input name="shipping_floor" id="shipping_floor" @if(!empty($shippingDetails->floor)) value="{{ $shippingDetails->floor }}" @endif type="text" placeholder="Floor No." class="form-control" />
                            </div>
                            <div class="form-group">
                                <input name="shipping_building" id="shipping_building" @if(!empty($shippingDetails->building)) value="{{ $shippingDetails->building }}" @endif type="text" placeholder="Building Name" class="form-control" />
                            </div>
                            <div class="form-group">
                                <input name="shipping_mobile" id="shipping_mobile" @if(!empty($shippingDetails->mobile)) value="{{ $shippingDetails->mobile }}" @endif type="text" placeholder="Mobile No." class="form-control" />
                            </div>
                            <button type="submit" class="btn btn-default">Check Out</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section><!--/form-->


@endsection
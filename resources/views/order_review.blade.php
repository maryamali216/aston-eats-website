@extends('layouts.frontLayout.front_design')
@section('content')

    <section id="cart_items">
        <div class="container">

            <div class="shopper-informations">
                <div class="row">
                    <h2>Review and Payment</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form">
                        <h2>Billing Info</h2>
                        <div class="form-group">
                            {{ $userDetails->name }}
                        </div>
                        <div class="form-group">
                            {{ $userDetails->address }}
                        </div>
                        <div class="form-group">
                            {{ $userDetails->city }}
                        </div>
                        <div class="form-group">
                            {{ $userDetails->country }}
                        </div>
                        <div class="form-group">
                            {{ $userDetails->postcode }}
                        </div>
                        <div class="form-group">
                            {{ $userDetails->mobile }}
                        </div>
                    </div>
                </div>
                <div class="col-sm-1">
                    <h2></h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form">
                        <h2>Delivery Info</h2>
                        <div class="form-group">
                            {{ $shippingDetails->name }}
                        </div>
                        <div class="form-group">
                            {{ $shippingDetails->room }}
                        </div>
                        <div class="form-group">
                            {{ $shippingDetails->floor }}
                        </div>
                        <div class="form-group">
                            {{ $shippingDetails->building }}
                        </div>
                        <div class="form-group">
                            {{ $shippingDetails->mobile }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="review-payment">
                <hr>
            </div>

            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $total_amount = 0; ?>
                    @foreach($userBasket as $basket)
                        <tr>
                            <td class="cart_product">
                                <a href=""><img style="width:130px;" src="{{ asset('/images/backend_images/items/small/'.$basket->image) }}" alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="">{{ $basket->item_name }}</a></h4>
                                <p>Code: {{ $basket->item_code }}</p>
                                <p>Size: {{ $basket->size }}</p>
                            </td>
                            <td class="cart_price">
                                <p>£ {{ $basket->price }}</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    {{ $basket->quantity }}
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">£ {{ $basket->price*$basket->quantity }}</p>
                            </td>
                        </tr>
                        <?php $total_amount = $total_amount + ($basket->price*$basket->quantity); ?>
                    @endforeach
                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td colspan="2">
                            <table class="table table-condensed total-result">
                                <tr>
                                    <td>Basket Sub Total</td>
                                    <td>£ {{ $total_amount }}</td>
                                </tr>
                                <tr class="shipping-cost">
                                    <td>Shipping Cost</td>
                                    <td> Free</td>
                                </tr>
                                <tr>
                                    <td>Grand Total</td>
                                    <td><span>£ {{ $grand_total = $total_amount }}</span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="review-payment" style="padding-bottom: 30px">
                <hr>
            </div>

            <form name="paymentForm" id="paymentForm" action="{{ url('/place-order') }}" method="post">{{ csrf_field() }}
                <input type="hidden" name="grand_total" value="{{ $grand_total }}">
                <div class="payment-options">
					<span>
						<label><strong>Select Payment Method:</strong></label>
					</span>
                    <span>
						<label><input type="radio" name="payment_method" id="Cash" value="Cash"> <strong>Cash</strong></label>
					</span>
                    <span>
						<label><input type="radio" name="payment_method" id="Paypal" value="Paypal"> <strong>Paypal</strong></label>
					</span>
                    <span style="float:right;">
						<button type="submit" class="btn btn-default" onclick="return selectPaymentMethod();">Place Order</button>
					</span>
                </div>
            </form>
        </div>
    </section> <!--/#cart_items-->

@endsection
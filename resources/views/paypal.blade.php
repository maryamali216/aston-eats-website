@extends('layouts.frontLayout.front_design')
@section('content')
    <?php use App\Order; ?>
    <section id="cart_items">
        <div class="container">
        </div>
    </section>

    <section id="do_action">
        <div class="container">
            <div class="heading" align="center">
                <h3>YOUR ORDER IS ALMOST COMPLETE</h3>
                <p>Your order number is {{ Session::get('order_id') }} and total payable is £ {{ Session::get('grand_total') }}</p>
                <p>Please make payment by clicking on the button below</p>

                <?php
                $orderDetails = Order::getOrderDetails(Session::get('order_id'));
                $orderDetails = json_decode(json_encode($orderDetails));
                $nameArr = explode(' ',$orderDetails->name);
                ?>
                <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                    <input type="hidden" name="cmd" value="_xclick">
                    <input type="hidden" name="business" value="maryamali216@business.example.com">
                    <input type="hidden" name="item_name" value="{{ Session::get('order_id') }}">
                    <input type="hidden" name="currency_code" value="GBP">
                    <input type="hidden" name="amount" value="{{ Session::get('grand_total') }}">
                    <input type="hidden" name="first_name" value="{{ $nameArr[0] }}">
                    <input type="hidden" name="last_name" value="{{ $nameArr[1] }}">
                    <input type="hidden" name="address1" value="">
                    <input type="hidden" name="address2" value="">
                    <input type="hidden" name="city" value="">
                    <input type="hidden" name="state" value="">
                    <input type="hidden" name="zip" value="">
                    <input type="hidden" name="email" value="">
                    <input type="hidden" name="country" value="">
                    <input type="hidden" name="return" value="{{ url('paypal/thanks') }}">
                    <input type="hidden" name="cancel_return" value="{{ url('paypal/cancel') }}">
                    <input type="image"
                           src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_paynow_107x26.png" alt="Pay Now">
                    <img alt="" src="https://paypalobjects.com/en_US/i/scr/pixel.gif"
                         width="1" height="1">
                </form>


            </div>
        </div>
    </section>

@endsection

<?php
Session::forget('grand_total');
Session::forget('order_id');
?>
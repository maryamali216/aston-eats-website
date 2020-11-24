@extends('layouts.frontLayout.front_design')
@section('content')

    <section id="cart_items">
        <div class="container">
        </div>
    </section>

    <section id="do_action">
        <div class="container">
            <div class="heading" align="center">
                <h3>YOUR CASH PAYMENT ORDER HAS BEEN PLACED</h3>
                <p>Your order number is {{ Session::get('order_id') }} and total payable is £ {{ Session::get('grand_total') }}</p>
            </div>
        </div>
    </section>

@endsection

<?php
Session::forget('grand_total');
Session::forget('order_id');
?>
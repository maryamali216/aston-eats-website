@extends('layouts.frontLayout.front_design')
@section('content')

    <section id="do_action">
        <div class="container">
            <div class="heading" align="center">
                <h3>YOUR PAYPAL ORDER HAS BEEN PLACED</h3>
                <p>Thanks for the payment. We will process your order very soon</p>
            </div>
        </div>
    </section>

@endsection

<?php
Session::forget('grand_total');
Session::forget('order_id');
?>
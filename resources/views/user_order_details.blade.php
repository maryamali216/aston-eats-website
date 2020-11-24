@extends('layouts.frontLayout.front_design')
@section('content')
    <section id="do_action">
        <div class="container">
            <div class="heading" align="center">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>Item Code</th>
                        <th>Item Name</th>
                        <th>Item Size</th>
                        <th>Item Company</th>
                        <th>Item Price</th>
                        <th>Item Qty</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orderDetails->orders as $pro)
                        <tr>
                            <td>{{ $pro->item_code }}</td>
                            <td>{{ $pro->item_name }}</td>
                            <td>{{ $pro->item_size }}</td>
                            <td>{{ $pro->item_company }}</td>
                            <td>{{ $pro->item_price }}</td>
                            <td>{{ $pro->item_qty }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

@endsection
@extends('layouts.frontLayout.front_design')
@section('content')
    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <img src="images/frontend_images/homebg.jpg" style="max-width: 100%"/>
                    </div>

                </div>
            </div>
        </div>
    </section><!--/slider-->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    @include('layouts.frontLayout.front_sidebar')
                </div>

                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Featured Items</h2>
                        @foreach($itemsAll as $item)
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{ asset('images/backend_images/items/small/'.$item->image) }}" alt="" />
                                            <h2>£ {{ $item->price }}</h2>
                                            <p>{{ $item->item_name }}</p>
                                            <a href="{{ url('item/'.$item->id) }}" class="btn btn-default add-to-cart">View Item</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div><!--features_items-->
                </div>

            </div>
        </div>
    </section>
@endsection
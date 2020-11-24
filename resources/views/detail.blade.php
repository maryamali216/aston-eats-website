@extends('layouts.frontLayout.front_design')

@section('content')

    <section>
        <div class="container">
            <div class="row">
                @if(Session::has('flash_message_error'))
                    <div class="alert alert-error alert-block" style="background-color:#f4d2d2">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{!! session('flash_message_error') !!}</strong>
                    </div>
                @endif
                <div class="col-sm-3">
                    @include('layouts.frontLayout.front_sidebar')
                </div>

                <div class="col-sm-9 padding-right">
                    <div class="product-details"><!--product-details-->
                        <div class="col-sm-5">
                            <div class="view-product">
                                <img src="{{ asset('images/backend_images/items/medium/'.$itemDetails->image) }}" alt="" />
                                {{--<h3>ZOOM</h3>--}}
                            </div>
                            <div id="similar-product" class="carousel slide" data-ride="carousel">

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
                                        <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
                                        <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
                                    </div>
                                    <div class="item">
                                        <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
                                        <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
                                        <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
                                    </div>
                                    <div class="item">
                                        <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
                                        <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
                                        <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
                                    </div>

                                </div>

                                <!-- Controls -->
                                {{--<a class="left item-control" href="#similar-product" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="right item-control" href="#similar-product" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>--}}
                            </div>

                        </div>
                        <div class="col-sm-7">
                            <form name="addtobasketForm" id="addtobasketForm" action="{{ url('/add-basket') }}" method="post">{{ csrf_field() }}
                                <input type="hidden" name="item_id" value="{{ $itemDetails->id }}">
                                <input type="hidden" name="item_name" value="{{ $itemDetails->item_name }}">
                                <input type="hidden" name="item_code" value="{{ $itemDetails->item_code }}">
                                <input type="hidden" name="company" value="{{ $itemDetails->company }}">
                                <input type="hidden" name="price" id="price" value="{{ $itemDetails->price }}">
                                <div class="product-information"><!--/product-information-->
                                <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                                <h2>{{ $itemDetails->item_name }}</h2>
                                <p>Code: {{ $itemDetails->item_code }}</p>
                                <p>
                                    <select id="selSize" name="size" style="width:150px">
                                        <option value="">Select</option>
                                        @foreach($itemDetails->attributes as $sizes)
                                            <option value="{{ $itemDetails->id }}-{{ $sizes->size }}">{{ $sizes->size }}</option>
                                        @endforeach
                                    </select>
                                </p>
                                <img src="images/product-details/rating.png" alt="" />
                                <span>
									<span id="getPrice">£ {{ $itemDetails->price }}</span>
									<label>Quantity:</label>
									<input type="text" name="quantity" value="1" />
                                    @if($total_stock>0)
                                        <button type="submit" class="btn btn-fefault cart" id="basketButton">
                                            <i class="fa fa-shopping-cart"></i>
                                            Add to cart
                                        </button>
                                    @endif
								</span>
                                <p><b>Availability:</b><span id="Availability">@if($total_stock>0) In Stock @else Out of Stock @endif</p></span>
                                <p><b>Condition:</b> New</p>
                                <p><b>Company:</b> {{ $itemDetails->company }}</p>
                                <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
                            </div><!--/product-information-->
                            </form>
                        </div>
                    </div><!--/product-details-->

                    <div class="category-tab shop-details-tab"><!--category-tab-->
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#description" data-toggle="tab">Description</a></li>
                                <li><a href="#delivery" data-toggle="tab">Delivery Options</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade" id="description" >
                                <div class="col-sm-12">
                                    <p>{{ $itemDetails->description }}</p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="delivery" >
                                <div class="col-sm-12">
                                    <p>100% Original Products <br>
                                        Cash on delivery might be available</p>
                                </div>
                            </div>


                        </div>
                    </div><!--/category-tab-->

                </div>

            </div>
        </div>
    </section>

@endsection
<?php
use App\Http\Controllers\Controller;
$mainCategories = Controller::mainCategories();
?>

<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="icon-phone"></i> +0121 344 876</a></li>
                            <li><a href="#"><i class="icon-envelope"></i> INFO@ASTONEATS.CO.UK</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="https://www.facebook.com/astonuniversity/"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://twitter.com/astonuniversity?lang=en"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://www.linkedin.com/school/aston-university/"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="{{ asset('/') }}"><img src="/images/frontend_images/rsz_1logoblk.png" alt="" /></a>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="{{ asset('/admin') }}"><i class="fa fa-user"></i> Admin</a></li>
                            <li><a href="{{ url('/orders') }}"><i class="icon-th-list"></i> Orders</a></li>
                            <li><a href="{{ asset('/basket') }}"><i class="icon-shopping-cart"></i> Cart</a></li>
                            @if(empty(Auth::check()))
                                <li><a href="{{ url('/login-register') }}"><i class="fa fa-lock"></i> Login</a></li>
                            @else
                                <li><a href="{{ url('/account') }}"><i class="fa fa-user"></i> Account</a></li>
                                <li><a href="{{ url('/user-logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="/" class="active">Home</a></li>
                            <li class="dropdown"><a href="#">Menu<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    @foreach($mainCategories as $cat)
                                        <li><a href="{{ asset('items/'.$cat->url) }}">{{ $cat->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="{{ url('/contact-us') }}">About</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <input type="text" placeholder="Search"/>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->
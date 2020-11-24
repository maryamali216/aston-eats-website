@extends('layouts.adminLayout.admin_design')
@section('content')

<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"> <a href="/admin/dashboard" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">
        <div class="quick-actions_homepage">
            <ul class="quick-actions">
                <li class="bg_lh span6"> <a href="/admin/add-category"> <i class="icon-plus"></i> Add Menu Category</a> </li>
                <li class="bg_lh span6"> <a href="/admin/view-categories"> <i class="icon-list"></i> View Menu Categories</a> </li>
                <li class="bg_lh span6"> <a href="/admin/add-item"> <i class="icon-plus"></i> Add Menu Items</a> </li>
                <li class="bg_lh span6"> <a href="/admin/view-items"> <i class="icon-list"></i> View Menu Items</a> </li>
                <li class="bg_lh span6"> <a href="/admin/view-orders"> <i class="icon-money"></i> Orders</a> </li>
                <li class="bg_lh span6"> <a href="/admin/settings"> <i class="icon-cog"></i> Settings</a> </li>
            </ul>
        </div>
        <!--End-Action boxes-->
    </div>
</div>
<!--end-main-container-part-->

@endsection
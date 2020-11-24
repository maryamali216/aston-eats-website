@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="/admin/dashboard" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Menu Items</a> <a href="/admin/view-items" class="current">View Menu Items</a> </div>
            <h1>Menu Items</h1>
            @if(Session::has('flash_message_error'))
                <div class="alert alert-error alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{!! session('flash_message_error') !!}</strong>
                </div>
            @endif
            @if(Session::has('flash_message_success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{!! session('flash_message_success') !!}</strong>
                </div>
            @endif
        </div>
        <div class="container-fluid" style="padding: 50px">
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                            <h5>Menu Items</h5>
                        </div>
                        <div class="widget-content no-padding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th>Item ID</th>
                                    {{--<th>Category</th>--}}
                                    <th>Item Name</th>
                                    <th>Item Code</th>
                                    <th>Company</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $item)
                                    <tr class="gradeX">
                                        <td class="center">{{ $item->id }}</td>
                                        {{--<td class="center">{{ $item->category_name }}</td>--}}
                                        <td class="center">{{ $item->item_name }}</td>
                                        <td class="center">{{ $item->item_code }}</td>
                                        <td class="center">{{ $item->company }}</td>
                                        <td class="center">{{ $item->price }}</td>
                                        <td class="center">
                                            @if(!empty($item->image))
                                                <img src="{{ asset('/images/backend_images/items/small/'.$item->image) }}" style="width:50px;">
                                            @endif
                                        </td>
                                        <td class="center">
                                            <a href="#myModal{{ $item->id }}" data-toggle="modal" class="btn btn-info btn-mini">View</a>
                                            <a href="{{ url('/admin/edit-item/'.$item->id) }}" class="btn btn-warning btn-mini">Edit</a>
                                            <a href="{{ url('/admin/add-attribute/'.$item->id) }}" class="btn btn-success btn-mini">Add</a>
                                            <a id="delItem" href="{{ url('/admin/delete-item/'.$item->id) }}" class="btn btn-danger btn-mini">Delete</a>

                                            <div id="myModal{{ $item->id }}" class="modal hide">
                                                <div class="modal-header">
                                                    <button data-dismiss="modal" class="close" type="button">×</button>
                                                    <h2>Full Details</h2>
                                                </div>
                                                <div class="modal-body">
                                                    <h5>{{ $item->item_name }}</h5>
                                                    <p>Product ID: {{ $item->id }}</p>
                                                    <p>Category ID: {{ $item->category_id }}</p>
                                                    <p>Item Code: {{ $item->item_code }}</p>
                                                    <p>Company: {{ $item->company }}</p>
                                                    <p>Price: {{ $item->price }}</p>
                                                    <p>Description: {{ $item->description }}</p>
                                                    <img src="{{ asset('/images/backend_images/items/small/'.$item->image) }}" >
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
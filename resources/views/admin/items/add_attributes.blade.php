@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="/admin/dashboard" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Menu Items</a> <a href="#" class="current">Add Item Attributes</a> </div>
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
                        <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>Add Item Attributes</h5>
                        </div>
                        <div class="widget-content no-padding">
                            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('admin/add-attribute/'.$itemDetails->id) }}" name="add_item" id="add_item" novalidate="novalidate">{{ csrf_field() }}
                                <input type="hidden" name="item_id" value="{{ $itemDetails->id }}">
                                {{--<div class="control-group">
                                    <label class="control-label">Category Name</label>
                                    <label class="control-label">{{ $category_name }}</label>
                                </div>--}}
                                <div class="control-group">
                                    <label class="control-label">Item Name</label>
                                    <label class="control-label">{{ $itemDetails->item_name }}</label>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Item Code</label>
                                    <label class="control-label">{{ $itemDetails->item_code }}</label>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Company</label>
                                    <label class="control-label">{{ $itemDetails->company }}</label>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"></label>
                                    <div class="controls field_wrapper">
                                        <input required title="Required" type="text" name="sku[]" id="sku" placeholder="SKU" style="width:120px;">
                                        <input required title="Required" type="text" name="size[]" id="size" placeholder="Size" style="width:120px;">
                                        <input required title="Required" type="text" name="allergens[]" id="stock" placeholder="Allergens" style="width:120px;">
                                        <input required title="Required" type="text" name="price[]" id="price" placeholder="Price" style="width:120px;">
                                        <input required title="Required" type="text" name="stock[]" id="stock" placeholder="Stock" style="width:120px;">
                                        <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <input type="submit" value="Add Attributes" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                            <h5>Attributes</h5>
                        </div>
                        <div class="widget-content no-padding">
                            <form action="{{ url('admin/edit-attribute/'.$itemDetails->id) }}" method="post">{{ csrf_field() }}
                                <table class="table table-bordered data-table">
                                    <thead>
                                    <tr>
                                        <th>Attribute ID</th>
                                        <th>SKU</th>
                                        <th>Size</th>
                                        <th>Allergens</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($itemDetails['attributes'] as $attribute)
                                        <tr class="gradeX">
                                            <td class="center"><input type="hidden" name="idAttr[]" value="{{ $attribute->id }}">{{ $attribute->id }}</td>
                                            <td class="center">{{ $attribute->sku }}</td>
                                            <td class="center">{{ $attribute->size }}</td>
                                            <td class="center"><input name="allergens[]" type="text" value="{{ $attribute->allergens }}" /></td>
                                            <td class="center"><input name="price[]" type="text" value="{{ $attribute->price }}" /></td>
                                            <td class="center"><input name="stock[]" type="text" value="{{ $attribute->stock }}" required /></td>
                                            <td class="center">
                                                <input type="submit" value="Update" class="btn btn-primary btn-mini" />
                                                <a id="delRecord" href="{{ url('/admin/delete-attribute/'.$attribute->id) }}" class="btn btn-danger btn-mini">Delete</a>
                                               {{-- <a rel="{{ $attribute->id }}" rel1="delete-attribute" href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</a> --}}
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
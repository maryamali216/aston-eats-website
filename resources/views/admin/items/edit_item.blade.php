@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="/admin/dashboard" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Menu Items</a> <a href="#" class="current">Edit Menu Items</a> </div>
            <h1>Edit Menu Items</h1>
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
                            <h5>Edit Menu Items</h5>
                        </div>
                        <div class="widget-content no-padding">
                            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('admin/edit-item/'.$itemDetails->id) }}" name="edit_item" id="edit_item" novalidate="novalidate">{{ csrf_field() }}
                                <div class="control-group">
                                    <label class="control-label">Category</label>
                                    <div class="controls">
                                        <select name="category_id" id="category_id" style="width:220px;">
                                            <?php echo $categories_dropdown; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Item Name</label>
                                    <div class="controls">
                                        <input type="text" name="item_name" id="item_name" value="{{ $itemDetails->item_name }}">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Item Code</label>
                                    <div class="controls">
                                        <input type="text" name="item_code" id="item_code" value="{{ $itemDetails->item_code }}">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Company</label>
                                    <div class="controls">
                                        <input type="text" name="company" id="company" value="{{ $itemDetails->company }}">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Item Description</label>
                                    <div class="controls">
                                        <textarea name="description">{{ $itemDetails->description }}</textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Item Price</label>
                                    <div class="controls">
                                        <input type="text" name="price" id="price" value="{{ $itemDetails->price }}">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Image</label>
                                    <div class="controls">
                                        <div id="uniform-undefined">
                                            <table>
                                                <tr>
                                                    <td>
                                                        <input name="image" id="image" type="file">
                                                        @if(!empty($itemDetails->image))
                                                            <input type="hidden" name="current_image" value="{{ $itemDetails->image }}">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if(!empty($itemDetails->image))
                                                            <img style="width:40px;" src="{{ asset('/images/backend_images/items/small/'.$itemDetails->image) }}"> | <a href="{{ url('/admin/delete-item-image/'.$itemDetails->id) }}">Delete</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <input type="submit" value="Edit Item" class="btn btn-success">
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
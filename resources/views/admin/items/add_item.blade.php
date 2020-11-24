@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="/admin/dashboard" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Menu Items</a> <a href="#" class="current">Add Menu Item</a> </div>
            <h1>Add Menu Item</h1>
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
                            <h5>Add Item</h5>
                        </div>
                        <div class="widget-content no-padding">
                            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('admin/add-item') }}" name="add_item" id="add_item" novalidate="novalidate">{{ csrf_field() }}
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
                                        <input type="text" name="item_name" id="item_name">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Item Code</label>
                                    <div class="controls">
                                        <input type="text" name="item_code" id="item_code">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Company</label>
                                    <div class="controls">
                                        <input type="text" name="company" id="company">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Item Description</label>
                                    <div class="controls">
                                        <textarea name="description"></textarea>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Item Price</label>
                                    <div class="controls">
                                        <input type="text" name="price" id="price">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Image</label>
                                    <div class="controls">
                                        <div class="uploader" id="uniform-undefined"><input name="image" id="image" type="file" size="19" style="opacity: 0;"><span class="filename">No file selected</span><span class="action">Choose File</span></div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" value="Add Item" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
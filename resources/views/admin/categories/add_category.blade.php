@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="/admin/dashboard" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Menu Category</a> <a href="#" class="current">Add Menu Category</a> </div>
        <h1>Add Menu Categories</h1>
    </div>
    <div class="container-fluid" style="padding: 50px">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                        <h5>Menu Category</h5>
                    </div>
                    <div class="widget-content no-padding">
                        <form class="form-horizontal" method="post" action="{{ url('/admin/add-category') }}" name="add_category" id="add_category" novalidate="novalidate"> {{ csrf_field() }}
                            <div class="control-group">
                                <label class="control-label">Main Category</label>
                                <div class="controls">
                                    <select name="parent_id" style="width:220px;">
                                        <option value="0">Main Category</option>
                                        @foreach($levels as $val)
                                            <option value="{{ $val->id }}">{{ $val->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Subcategory</label>
                                <div class="controls">
                                    <input type="text" name="category_name" id="category_name">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Description</label>
                                <div class="controls">
                                    <textarea name="description" id="description"></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">URL</label>
                                <div class="controls">
                                    <input type="text" name="url" id="url">
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" value="Add Category" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
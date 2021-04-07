@extends('admin.layouts.app')
  @section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{__('Categories')}}
        <small>{{__('Create')}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('media_categories.index')}}"> Media Categories</a></li>
        <li class="active">Edit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="panel panel-success">
        @if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
                <form method="POST" action="{{ url('admin/media_categories/'.$cat['id']) }}">
                  {{ csrf_field() }}
                  {{ method_field('PATCH') }}
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Category Name</label>
                      <input class="form-control" type="text" placeholder="Category Name" name="name" value="{{ old('name',$cat['name']) }}">

                    </div>
                    <div class="form-group">
                      <label>Category Alias (Unique. without space)</label>
                      <input class="form-control" type="text" placeholder="Category Alias" name="alias" value="{{ old('alias',$cat['alias']) }}">
                    </div>

                    <div class="form-group">
                      <label>Large Image Width (Image will be resized to this size if image is larger)</label>
                      <input class="form-control" type="number" placeholder="Image Width (Large)" name="large_img_width" value="{{ old('large_img_width',$cat['large_img_width']) }}">
                    </div>

                    <div class="form-group">
                      <label>Large Image Height (Image will be resized to this size if image is larger)</label>
                      <input class="form-control" type="number" placeholder="Image Height (Large)" name="large_img_height" value="{{ old('large_img_height',$cat['large_img_height']) }}">
                    </div>

                    <div class="form-group">
                      <label>Thumb Image Width (Image will be resized and cropped to this size)</label>
                      <input class="form-control" type="number" placeholder="Image Width (Thumb)" name="thumb_img_width" value="{{ old('thumb_img_width',$cat['thumb_img_width']) }}">
                    </div>

                    <div class="form-group">
                      <label>Thumb Image Height (Image will be resized and cropped to this size)</label>
                      <input class="form-control" type="number" placeholder="Image Height (Thumb)" name="thumb_img_height" value="{{ old('thumb_img_height',$cat['thumb_img_height']) }}">
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
                </form>
              </div>
          </section>

@endsection

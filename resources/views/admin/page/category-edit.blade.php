@extends('admin.layouts.app')
  @section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{__('Categories')}}
        <small>{{__('Edit')}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('categories.index')}}"> Categories</a></li>
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
                <form method="POST" action="{{ url('admin/categories/'.$category_detail['id']) }}">
                  {{ csrf_field() }}
                  {{ method_field('PATCH') }}
                  <div class="panel-body">
            				<div class="row">
            					<div class="col-sm-8">
            						<div id="validation_errors"></div>
                  <div class="input-group input-group-sm">
                    <input class="form-control" type="text" placeholder="Category Name" name="category_name" value="{{ old('category_name', $category_detail['category_name']) }}">
                        <span class="input-group-btn">
                          <button type="submit" class="btn btn-info btn-flat">Save</button>
                        </span>
                  </div>
                </div>
              </div>
              </div>
                </form>
              </div>
          </section>

@endsection

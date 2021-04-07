@extends('admin.layouts.app')
  @section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{__('Product Sub-categories')}}
        <small>{{__('Edit')}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('product-categories.index')}}"> Product Sub-categories</a></li>
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

	   <form action="{{route('product-subcategories.update', $id)}}" enctype="multipart/form-data" method="POST">
		{{ csrf_field() }}
		{{ method_field('PUT') }}
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-6">
						<div id="validation_errors"></div>

						<div class="col-sm-12">
							<div class="form-group">

								<label class="control-label">@lang('common.name')</label>

									<input required type="text" name="name" value="{{ $category->name }}" class="form-control" />

								<div class="help-block with-errors"></div>
							</div>
						</div>

            <div class="col-sm-12">
							<div class="form-group">

								<label class="control-label">{{ __('Parent Category') }}</label>

									<select class="form-control" required name="parent_id">
                    <option value="">---</option>
                    @foreach($parent_categories as $row)
                      <option value="{{$row->id}}" @if($row->id == $category->parent_id) selected @endif>{{$row->name}}</option>
                    @endforeach
                  </select>

								<div class="help-block with-errors"></div>
							</div>
						</div>

            <div class="col-sm-12">
							<div class="form-group">

								<label class="control-label">{{ __('Image') }}</label>

									<input type="file" name="image" class="form-control" />

								<div class="help-block with-errors"></div>
							</div>
              <a href="{{url('uploads/product_categories/'.$category->image)}}" class="fancybox">
                <img src="{{url('uploads/product_categories/thumbs/'.$category->image)}}" style="width:120px;" />
              </a>
						</div>

						<div class="col-sm-12">
							<div class="form-group">

								<label class="control-label">@lang('common.status')</label>

									<select name="status" class="form-control">
										<option value="1" @if($category->status == 1) selected @endif >{{__('Enabled')}}</option>
										<option value="0" @if($category->status == 0) selected @endif>{{__('Disabled')}}</option>
									</select>

								<div class="help-block with-errors"></div>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<input type="hidden" name="id" value="{{ $id }}" />
								<button type="submit" class="btn green"><i class="icon-ok"></i> @lang('common.save')</button>
								<a class="btn btn-danger" href="{{ route('product-subcategories.index') }}" data-dismiss="modal"><i class="icon-remove"></i> @lang('common.cancel')</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>

    </div>
</section>


@endsection

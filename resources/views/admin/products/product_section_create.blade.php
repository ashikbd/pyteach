@extends('admin.layouts.app')
  @section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{__('Product Sections')}}
        <small>{{__('Create')}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('product-categories.index')}}"> Product Sections</a></li>
        <li class="active">Create</li>
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

	   <form action="{{route('product-sections.store')}}" method="POST">
		{{ csrf_field() }}
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-6">
						<div id="validation_errors"></div>

						<div class="col-sm-12">
							<div class="form-group">

								<label class="control-label">{{ __('Name') }}</label>

									<input required type="text" name="name" class="form-control" />

								<div class="help-block with-errors"></div>
							</div>
						</div>

            <div class="col-sm-12">
							<div class="form-group">

								<label class="control-label">{{ __('Sort') }}</label>

									<input type="text" required name="sort" value="{{$sort}}" class="form-control" />

								<div class="help-block with-errors"></div>
							</div>
						</div>



						<div class="col-sm-12">
							<div class="form-group">

								<label class="control-label">{{ __('Status') }}</label>

									<select name="status" class="form-control">
										<option value="1">{{ __('Enabled') }}</option>
										<option value="0">{{ __('Disabled') }}</option>
									</select>

								<div class="help-block with-errors"></div>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<button type="submit" class="btn green"><i class="icon-ok"></i> {{ __('Save') }}</button>
								<a class="btn btn-danger" href="{{ route('product-sections.index') }}" data-dismiss="modal"><i class="icon-remove"></i> {{ __('Cancel') }}</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
    </div>
</section>


@endsection

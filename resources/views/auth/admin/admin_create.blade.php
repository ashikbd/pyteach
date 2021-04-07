@extends('layouts.app')
@section('content')

@include('layouts.sidebar_main1')
<!-- BEGIN PAGE HEADER-->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="">@lang('common.home')</a>
            <i class="fa fa-angle-right"></i>
        </li>
    </ul>
</div>
<!-- END PAGE HEADER-->
<div class="page-title">
    <h3>@lang('user.profile_management')</h3>
</div>
<!-- BEGIN PAGE CONTENT-->
<div class="content-class">
    <div class="tabbable tabbable-custom boxless" style="overflow:inherit;">
        <!---start form -->
        <div class="portlet box blue ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-user"></i>@lang('user.add_user')
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                    <a href="#portlet-config" data-toggle="modal" class="config"></a>
                    <a href="javascript:;" class="reload"></a>
                    <a href="javascript:;" class="remove"></a>
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form method="POST" action="{{ route('admin.store') }}" id="new_user_register1" role="form" data-toggle="validator">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> @lang('user.problems_with_input')<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
                    <div class="validation_errors">
                        
                    </div>
					{{ csrf_field() }}
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>@lang('user.user_name')</label>
								<input type="text" class="form-control" placeholder="@lang('user.user_name')" name="first_name" value="{{ old('first_name') }}">

								@if ($errors->has('name'))
									<span class="help-block">
										<strong>{{ $errors->first('first_name') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="col-sm-6">
							 <div class="form-group">
								<label>@lang('user.user_surname')</label>
								<input type="text" class="form-control" placeholder="@lang('user.user_surname')" name="last_name" value="{{ old('last_name') }}">
							</div>
						</div>
					</div>
					
					
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
								<label>@lang('user.user_email')</label>
								<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="@lang('user.user_email')">

								@if ($errors->has('email'))
									<span class="help-block">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label>@lang('common.password')</label>
								<input id="password" type="password" class="form-control" name="password" required title="@lang('validation.required', ['attribute' => 'password'])">

								@if ($errors->has('password'))
									<span class="help-block">
										<strong>{{ $errors->first('password') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label>@lang('common.re_insert_password')</label>
								<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required title="@lang('validation.required', ['attribute' => trans('common.re_insert_password')])">
							</div>
						</div>
					</div>
                    <div class="form-actions">
                        <button type="submit" class="btn green"><i class="icon-ok"></i> @lang('common.save')</button>
                        <a href="{{ url('/'.LaravelLocalization::getCurrentLocale().'/user-list') }}" class="btn btn-danger"><i class="icon-remove"></i> @lang('common.cancel')</a>
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
		</div>
	</div>
</div>
<style>
    .box-select{
        padding: 16px;
        display: none;
        margin:10px 0;
        border: 1px solid #ddd;
    }
</style>


@endsection

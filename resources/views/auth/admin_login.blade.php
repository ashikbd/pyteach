@extends('admin.layouts.app')
@section('content')
<body class="login">
	<header>
		<div class="title-section clearfix">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 text-center">
						<h1 class="headline-single-page mb-0">Admin <strong>Login</strong></h1>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
	<div class="menu-toggler sidebar-toggler"></div>
	<section class="circle-img-bg py-5">
	<div class="container">
		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
				<div class="login-design login-panel padding-20 clearfix">
					<form class="login-form" action="{{ route('login') }}" method="post">
						{{ csrf_field() }}
						<?php //echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
						<div class="alert alert-danger display-hide">
							<button class="close" data-close="alert"></button>
							<span>Enter username and password. </span>
						</div>
						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
							<label class="control-label">Username</label>
							<input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username/Email" name="email" required autofocus/>
							@if ($errors->has('email'))
								<span class="help-block alert alert-danger">
									<strong>{{ $errors->first('email') }}</strong>
								</span>
							@endif
							<input type="hidden" name="user_type" value="admin">
						</div>
						<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
							<label class="control-label">Password</label>
							<input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" required/>
							@if ($errors->has('password'))
								<span class="help-block alert alert-danger">
									<strong>{{ $errors->first('password') }}</strong>
								</span>
							@endif
						</div>
						<div class="form-actions">
							<button type="submit" class="btn btn-theme">Login</button><br><br>
							<!--<label class="rememberme check">
							<input type="checkbox" name="remember" value="1"/>Remember </label>
							<a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>-->
						</div>
					</form>
				</div>
				<div class="col-sm-3"></div>
			</div>
		</div>
	</div>
	<div class="hidden">
		<!-- BEGIN LOGIN FORM -->

		<!-- END LOGIN FORM -->
		<!-- BEGIN FORGOT PASSWORD FORM -->
		<form class="forget-form" action="index.html" method="post">
			<h3>Forget Password ?</h3>
			<p>
				Enter your e-mail address below to reset your password.
			</p>
			<div class="form-group">
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email"/>
			</div>
			<div class="form-actions">
				<button type="button" id="back-btn" class="btn btn-default">Back</button>
				<button type="submit" class="btn btn-success uppercase pull-right">Submit</button>
			</div>
		</form>
		<!-- END FORGOT PASSWORD FORM -->
	</div>
	<div class="copyright"></div>
	</section>
@endsection

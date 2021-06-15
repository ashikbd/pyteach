@extends('layouts.app')

@section('content')
<div class=contentContainer>
	<div class=homePicture>
		<img id="contentPic" class="homePicture" src="{{ asset('public/images/PyLogo.JPG') }}" alt="placeholder">
	</div>
	<div class=rightContainer>
		<div class=textAboveBtn>
			<h1>Coding Python is Fun</h1>
			<p> An interactive Python learning platform for kids </p>
		</div>
		<div class=query>
            @if(Auth::guard('students')->check())
                <a href="{{url('students/dashboard')}}" class=redirectBtn id="firstBtn"> Dashboard</a>
            @elseif(Auth::guard('parents')->check())
                <a href="{{url('parents/dashboard')}}" class=redirectBtn id="firstBtn"> Dashboard</a>
            @else
                <a href="{{url('register')}}" class=redirectBtn id="firstBtn"> Sign Up</a>
                <a href="{{url('login')}}" class=redirectBtn>Login</a>
            @endif

		</div>
	</div>
</div>
@endsection

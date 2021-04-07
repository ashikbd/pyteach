@extends('layouts.app')

@section('content')
    <div class=loginPageContent>
        <form id="studentSignIn" class=login-col method="POST" action="{{ route('login') }}">
            @csrf
            <h1>Student Sign In</h1>
            <input name="user_type" value="student" type="hidden" />
            <input type="text" name="email" class="defaultForm" placeholder="Email" required />
            <br>
            <input type="password" name="password" class="defaultForm" placeholder = "Password" required />
            <br>

            <div class=submitContainer>
                <input type="submit" value="Sign In" id = "submitSignIn" name = "submitSignIn">
                <br>
            </div>
            <div class=loginQuestions>
                <a href="{{ route('password.request') }}?type=student">Forgot Password?</a>
                <a href="{{url('register?type=student')}}" id="notAMember">Create a student account</a>
            </div>
        </form>

        <form id="studentSignIn" class=login-col method="POST" action="{{ route('login') }}">
            @csrf
            <h1>Parent Sign In</h1>
            <input name="user_type" value="parent" type="hidden" />
            <input type="text" name = "email"  class = "defaultForm" placeholder = "Email" required>
            <br>
            <input type="password" name="password" class="defaultForm" placeholder = "Password" required>
            <br>
            <div class=submitContainer>
                <input type="submit" value="Sign In" id = "submitSignIn" name = "submitSignIn">
                <br>
            </div>
            <div class=loginQuestions>
                <a href="{{ route('password.request') }}?type=parent">Forgot Password?</a>
                <a href="{{url('register?type=parent')}}" id="notAMember">Create a parent account</a>
            </div>
        </form>
    </div>
@endsection

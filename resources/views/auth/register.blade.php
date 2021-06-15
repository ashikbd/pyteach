@extends('layouts.app')

@section('content')
    <h1 class="signUpTitle"> @if(isset($_GET['type']) && $_GET['type']=='parent') Parent @else Student @endif Sign Up</h1>
    <form id="signUp" class="signUpPage" method="POST" action="{{ url('create_user') }}">
        @if ($errors->any())
            <div class="alert alert-danger col-md-12">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="signUpForm">

            @csrf

            <input name="type" value = "@if(isset($_GET['type']) && $_GET['type']=='parent') parent @else student @endif" type = "hidden">
            <label>First Name</label>
            <input type="text" name = "firstName" id="fName" class = "defaultForm" placeholder = "First Name"  required>
            <label>Last Name</label>
            <input type="text" name = "lastName" id="lName" class = "defaultForm" placeholder = "Last Name" required>

            @if(!isset($_GET['type']) || (isset($_GET['type']) && $_GET['type']!='parent'))
                <label>Date of Birth</label>
            <input placeholder="Date of Birth" name="dateOfBirth" class="defaultForm" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="signUp-DOB" required />
            @endif
            <label>Email</label>
        <input type="email" name = "email" id="signUpEmail" class = "defaultForm" placeholder = "Email" required>
            <label>Password</label>
            <input type="password" name="password" id="signUpPassword" class="defaultForm" placeholder = "Password" required>
        @if(!isset($_GET['type']) || (isset($_GET['type']) && $_GET['type']!='parent'))
                <label>Parent's Email (Optional)</label>
            <input type="email" name= "parentEmail" id="pEmail" class = "defaultForm" placeholder="Parent's Email (Optional)">
            @endif

    </div>
    <div class=submitContainer>
        <input type="submit" value="Sign Up" id = "submitSignUp" name = "submitSignUp">
        <br>
    </div>
    </form>
    <div class=loginQuestions>
        <p>Already have an account? Click <a href="{{url('login')}}">LOGIN</a></p>
    </div>

    <style>
        label{
            display: block;
            text-align: left;
            margin-left: 77px;
            margin-bottom: 3px;
            font-weight: bold;
            font-size: 18px;
        }
    </style>
@endsection

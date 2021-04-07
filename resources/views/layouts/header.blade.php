<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PyTeach</title>
    <link rel="stylesheet" href="{{ asset('public/plugins/sweetalert/sweetalert.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel='stylesheet' type='text/css' href='{{ asset('public/css/style.css') }}'>
    <script type="text/javascript" src="{{ asset('public/plugins/jQuery/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="{{ asset('public/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <!--<script src="scripts/script.js" defer></script>-->
</head>

<body>

    <!--header start -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background-color: #3672a4 !important">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img id="logo" src="{{ asset('public/images/PyLogo.JPG') }}" alt="placeholder"> PyTeach</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    @if(Auth::guard('students')->check())
                        @include('layouts.nav_student')
                    @else
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{url('')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('page/why_python')}}">Why Python?</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('register?type=student')}}">Student Signup</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('register?type=parent')}}">Parents Signup</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('page/faq')}}">FAQ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('page/contact')}}">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('login')}}">Login</a>
                        </li>
                    @endif

                </ul>
            </div>
        </div>
    </nav>

    <!--header end-->
<!--Body of Content start-->
    <div class="Content" @if(Auth::guard('students')->check() || Auth::guard('parents')->check()) style="background-color: #ebebeb;" @endif">

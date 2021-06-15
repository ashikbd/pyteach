@extends('layouts.app')
@section('content')

        <h1 class="contentTitle"> Dashboard </h1>
        <div class="container">

            <div class="row">
                <div class="col-8 col-md-8 dashbuttons">
                    <div class="row">
                        <a href="{{url('parents/linked_students')}}"><span>Linked Students</span></a>
                        <a href="#"><span>Update Profile</span></a>
                        <a href="{{url('logout')}}"><span>Logout</span></a>
                    </div>
                </div>
                    <div class="col-8 col-md-4">
                <div class="dashProgress" style="background-color: #ffd94d;padding: 9px;">
                    <div class="progressText" style="border-bottom: 0px">
                        <img id="summaryLogo" src="{{asset('public/images/user.png')}}" alt="placeholder">
                        <div id="userInfoDashboard">
                            {{Auth::user()->firstName}} {{Auth::user()->lastName}}<br>
                            {{Auth::user()->email}}<br>
                            Member Since: {{date("d M Y",strtotime(Auth::user()->created_at))}}
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
                </div>
        </div>
@endsection

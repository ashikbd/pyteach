@extends('layouts.app')
@section('content')

        <h1 class="contentTitle"> Dashboard </h1>
        <div class="container">

            <div class="row">
                <div class="col-8 col-md-8 dashbuttons">
                    <div class="row">
                        <a href="#"><span>Learning Section</span></a>
                        <a href="#"><span>Statistics</span></a>
                        <a href="#"><span>Certification</span></a>
                        <a href="#"><span>Invite Parents</span></a>
                        <a href="#"><span>Invite Friends</span></a>
                        <a href="#"><span>Resources</span></a>
                        <a href="#"><span>Help</span></a>
                        <a href="#"><span>Update Profile</span></a>
                        <a href="#"><span>Logout</span></a>
                    </div>
                </div>
                    <div class="col-8 col-md-4">
                <div class="dashProgress">
                    <div class="progressText">
                        <img id="summaryLogo" src="{{asset('public/images/user.png')}}" alt="placeholder">
                        <div id="userInfoDashboard">
                            {{Auth::user()->firstName}} {{Auth::user()->lastName}}<br>
                            {{Auth::user()->email}}<br>
                            Member Since: {{date("d M Y",strtotime(Auth::user()->created_at))}}
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="overallProgress">
                        <div class="overallProgressChart" id="overallProgress"></div>
                        <div class="overallProgressTitle">Overall Progress</div>
                    </div>
                    <div class="pointsummary">
                        <div class="pointsummary_title">720/1000
                            <br />Points Earned
                        </div>
                        <div class="pointsummary_chart" id="pointsummary_chart"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
                </div>
        </div>

        <script type="application/javascript" src="{{asset('public/plugins/progressbar.min.js')}}"></script>
<script>
    var circle = new ProgressBar.Circle('#overallProgress', {
        color: '#FCB03C',
        strokeWidth: 3,
        trailWidth: 1,
        text: {
            value: '80%'
        }
    });

    circle.animate(0.8);

    var pointratio = 720/1000;
    var pointbar = new ProgressBar.Line('#pointsummary_chart', {
        color: 'green',
        strokeWidth: 12,
        trailWidth: 12
    });

    pointbar.animate(pointratio);
</script>
@endsection

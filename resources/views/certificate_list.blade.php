@extends('layouts.app')
@section('content')

        <h1 class="contentTitle"> Certificate </h1>
        <div class="container" style="padding-bottom: 20px">
            <div class="card col-md-8 text-center" style="margin: auto">
                <div class="card-header">
                    Certificate of completion
                </div>
                <div class="card-body">
                    @if($certificate)
                    <h5 class="card-title">Congratulations!</h5>
                    <p class="card-text">You have achieved the certificate of completion for the Python learning course</p>
                    <a href="{{url('view_certificate/'.$certificate->student_id)}}" target="_blank" class="btn btn-primary">View Certificate</a>
                    <a href="#" class="btn btn-warning">Share Link</a>
                    @else
                    <h5>Please complete and pass final quiz to get the certificate!</h5>
                    @endif
                </div>
                @if($certificate)
                <div class="card-footer text-muted">
                    Certificate generated on {{date("d M Y H:i A",strtotime($certificate->created_at))}}
                </div>
                    @endif
            </div>
        </div>
@endsection

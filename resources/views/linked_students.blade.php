@extends('layouts.app')
@section('content')

    <h2 class="contentTitle">Students</h2>
        <div class="container" style="padding-bottom: 20px">

            <div class="card col-md-8 text-center" style="margin: auto">
                <div class="card-header">
                    Linked Account(s)
                </div>
                <div class="card-body">
                    @if($students->count())
                        <table class="table">
                            <thead>
                            <th>Student Name</th>
                            <th>Student Email</th>
                            <th>Action</th>
                            </thead>
                            <tbody>
                            @foreach($students as $row)

                                <tr>
                                    <td>
                                        {{$row->student->firstName}} {{$row->student->lastName}}
                                    </td>
                                    <td>{{$row->student->email}}</td>
                                    <td>
                                        <a href="{{url('parents/student_statistics/'.$row->student_id)}}" class="btn btn-primary btn-sm">Statistics</a>
                                        <a href="{{url('parents/student_certificate/'.$row->student_id)}}" class="btn btn-success btn-sm">Certificate</a>
                                        <a href="{{url('parents/unlink_student/'.$row->student_id)}}" class="btn btn-danger btn-sm">Unlink</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        No student account is linked!
                    @endif
                </div>

            </div>

            @if($invitation->count())
                <div class="card col-md-8 text-center" style="margin: auto; margin-top: 20px">
                    <div class="card-header">
                        Pending Invitation(s)
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th>Student Name</th>
                                <th>Student Email</th>
                                <th>Status</th>
                                <th>Sent Date</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach($invitation as $row)

                                <tr>
                                    <td>
                                        {{$row->student->firstName}} {{$row->student->lastName}} <br />
                                    </td>
                                    <td>
                                        {{$row->student->email}}
                                    </td>
                                    <td>Pending</td>
                                    <td>
                                        {{date("d M Y H:i A",strtotime($row->created_at))}}
                                    </td>
                                    <td>
                                        <a class="btn btn-success btn-sm" href="{{url('parents/approve_invitation/'.$row->id)}}">Approve</a>
                                        <a class="btn btn-danger btn-sm" href="{{url('parents/deny_invitation/'.$row->id)}}">Deny</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            @endif
        </div>
@endsection

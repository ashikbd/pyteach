@extends('layouts.app')
@section('content')

    <h2 class="contentTitle">Parents</h2>
        <div class="container" style="padding-bottom: 20px">

            <div class="card col-md-8 text-center" style="margin: auto">
                <div class="card-header">
                    Linked Account(s)
                </div>
                <div class="card-body">
                    @if($parents->count())
                        <table class="table">
                            <thead>
                            <th>Parent Name</th>
                            <th>Parent Email</th>
                            <th>Unlink</th>
                            </thead>
                            <tbody>
                            @foreach($parents as $row)

                                <tr>
                                    <td>
                                        {{$row->parent->firstName}} {{$row->parent->lastName}}
                                    </td>
                                    <td>{{$row->parent->email}}</td>
                                    <td>
                                        <a href="#" class="btn btn-danger btn-sm">Unlink</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        No parent account is linked!
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
                                <th>Parent Email</th>
                                <th>Status</th>
                                <th>Sent Date</th>
                            </thead>
                            <tbody>
                                @foreach($invitation as $row)

                                <tr>
                                    <td>
                                        {{$row->email}}
                                    </td>
                                    <td>Pending</td>
                                    <td>
                                        {{date("d M Y H:i A",strtotime($row->created_at))}}
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

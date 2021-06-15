@extends('layouts.app')
@section('content')

        <h3 class="contentTitle"> Progress Report of @php echo App\Student::find($student_id)->firstName." ".App\Student::find($student_id)->lastName; @endphp </h3>
        <div class="container" style="padding-bottom: 20px">
            <div class="card col-md-8" style="margin: auto;">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Module</th>
                        <th>Quiz Points</th>
                        <th>Total Progress</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($topics as $row)
                        @php
                            $progress = get_module_progress($row->id,$student_id);
                            $achvd_point = get_module_quiz_progressed_points($row->id,$student_id);
                            $total_point = get_module_quiz_total_points($row->id);
                        @endphp
                    <tr>
                        <td>{{$row['title']}}</td>
                        <td>{{round($achvd_point)}}/{{$total_point}}</td>
                        <td>{{number_format($progress,2)}}%</td>

                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Total</td>
                            <td>{{$achieved_points}}/{{$total_points}}</td>
                            <td>{{$overall_progress}}%</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>


@endsection

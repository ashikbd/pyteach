@extends('layouts.app')
@section('content')

        <h1 class="contentTitle"> Learning Section </h1>
        <div class="container" style="padding-bottom: 20px">
            <div class="card col-md-8" style="margin: auto;">
                <div class="card-header">
                    <h5 class="card-title">Learning Modules</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Achieve atleast 80% to unlock next module</h6>
                </div>
                <ul class="list-group list-group-flush">
                    @php
                        $unlock_next = true;
                    @endphp
                    @foreach($topics as $row)
                        @php
                            $progress = get_module_progress($row->id);
                            $achvd_point = get_module_quiz_progressed_points($row->id);
                            $total_point = get_module_quiz_total_points($row->id);
                        @endphp
                    <li class="list-group-item">
                        <div class="topic_title float-start">{{$row['title']}}</div>
                        <a href="@if($unlock_next==true){{url('learning/topic_detail/'.$row['id'])}}@else # @endif" class="btn @if($unlock_next==true) btn-success @else btn-danger @endif btn-sm float-end">@if($progress) Continue @else Start @endif</a>
                        <div class="clearfix"></div>
                        <div class="topic_progress_text">
                            @php
                                if($progress<80){
                                    $unlock_next = false;
                                }else{
                                    $unlock_next = true;
                                }
                            @endphp
                            Progress: {{number_format($progress,2)}}% |
                            Quiz Points: {{round($achvd_point)}}/{{$total_point}}
                        </div>

                    </li>
                    @endforeach

                </ul>
            </div>
        </div>

        <script type="application/javascript" src="{{asset('public/plugins/progressbar.min.js')}}"></script>
<script>
    var pointratio = .8;
    var pointbar = new ProgressBar.Line('#topic_1', {
        color: 'green',
        strokeWidth: 2,
        trailWidth: 2
    });

    pointbar.animate(pointratio);
</script>
@endsection

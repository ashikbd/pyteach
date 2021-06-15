@extends('layouts.app')
@section('content')

        <h1 class="contentTitle"> Variable & Types </h1>
        <div class="container">
            <div class="col-md-8 m-auto">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    @if($topic->learning->count())
                    <li class="nav-item" role="presentation">
                        <button class="nav-link @if($active_section=='learning') active @endif" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Learn</button>
                    </li>
                    @endif
                   @if($topic->practice->count())
                    <li class="nav-item" role="presentation">
                        <button class="nav-link @if($active_section=='practice') active @endif" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Practice</button>
                    </li>
                    @endif
                    @if($topic->quiz->count())
                    <li class="nav-item" role="presentation">
                        <button class="nav-link @if($active_section=='quiz') active @endif" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Quiz</button>
                    </li>
                    @endif
                </ul>
                <div class="tab-content" id="pills-tabContent" style="    border: 1px solid #3672a4;">
                    @if($topic->learning->count())
                        <div class="tab-pane fade @if($active_section=='learning') show active @endif" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                                @php
                                    $selected_page = 1;
                                    if($learning_last_page){
                                        $i=1;
                                       foreach($topic->learning as $row){
                                           if($learning_last_page==$row->id){
                                               $selected_page = $i;
                                           }
                                           $i++;
                                       }
                                    }
                                    $i=1;
                                @endphp


                            @foreach($topic->learning as $row)
                                <div class="learning_slides @if($i==$selected_page) active @endif" data-page="{{$i}}" data-id="{{$row->id}}">
                                {!! $row->content !!}
                                </div>
                                @php
                                    $i++;
                                @endphp
                            @endforeach

                            <nav aria-label="Page navigation example" id="nav_learning">
                                <ul class="pagination justify-content-end pagination-sm">
                                    <li class="page-item page-prev">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                    </li>
                                    @for($pg=1;$pg<=$topic->learning->count();$pg++)
                                    <li class="page-item @if($pg==$learning_last_page) active @endif" data-page="{{$pg}}"><a class="page-link" href="#">{{$pg}}</a></li>
                                    @endfor
                                    <li class="page-item page-next">
                                        <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    @endif

                    @if($topic->practice->count())
                        <div class="tab-pane fade @if($active_section=='practice') show active @endif" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            @php
                                $selected_page = 1;
                                if($practice_last_page){
                                    $i=1;
                                   foreach($topic->practice as $row){
                                       if($practice_last_page==$row->id){
                                           $selected_page = $i;
                                       }
                                       $i++;
                                   }
                                }
                                $i=1;
                            @endphp
                            @foreach($topic->practice as $row)
                                <div class="learning_slides @if($i==$selected_page) active @endif" data-page="{{$i}}" data-id="{{$row->id}}">
                                    {!! $row->content !!}
                                </div>
                                @yield($i++)
                            @endforeach

                            <nav aria-label="Page navigation example" id="nav_practice">
                                <ul class="pagination justify-content-end pagination-sm">
                                    <li class="page-item page-prev">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                    </li>
                                    @for($pg=1;$pg<=$topic->practice->count();$pg++)
                                        <li class="page-item @if($pg==$selected_page) active @endif" data-page="{{$pg}}"><a class="page-link" href="#">{{$pg}}</a></li>
                                    @endfor
                                    <li class="page-item page-next">
                                        <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    @endif

                   @if($topic->quiz->count())
                    <div class="tab-pane fade @if($active_section=='quiz') show active @endif" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <form id="quiz_form" action="post">
                       @csrf
                            @php
                                $selected_page = 1;
                                if($quiz_last_page){
                                    $i=1;
                                   foreach($topic->quiz as $row){
                                       if($quiz_last_page==$row->id){
                                           $selected_page = $i;
                                       }
                                       $i++;
                                   }
                                }
                                $i=1;
                            @endphp
                        @foreach($topic->quiz as $row)
                            @php
                                $qans=array();
                                $point=0;
                                if(isset($answers[$row->id])){
                                   $qans=json_decode($answers[$row->id]['answers'],true);
                                   $point = round($answers[$row->id]['point']);
                                }
                            @endphp
                            <div class="learning_slides @if($i==$selected_page) active @endif" data-page="{{$i}}" data-id="{{$row->id}}">
                                {!! $row->question !!}
                            <br /><br />

                                @if($row->type==1)
                                    <div class="form-check">
                                        <label class="form-check-label" for="answer_fill_gap">
                                            Write Answer:
                                        </label>
                                        <input class="form-control" name="answer_fill_gap" id="answer_fill_gap" @if($qans) disabled="disabled" @endif value="@if(isset($qans[0])) {{$qans[0]}} @endif" />
                                    </div>
                                @endif

                                @if($row->type==2)
                                    @foreach($row->quiz_option as $key=>$opt)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" @if($qans) disabled="disabled" @endif  @if(in_array($opt['option'],$qans)) checked @endif name="options[{{$row['id']}}][]" id="options_{{$row['id']}}_{{$key}}" value="{{ $opt['option'] }}" />
                                            <label class="form-check-label" for="options_{{$row['id']}}_{{$key}}">
                                                {{ $opt['option'] }}
                                            </label>
                                        </div>
                                    @endforeach
                                @endif

                                @if($row->type==3)
                                    @foreach($row->quiz_option as $key=>$opt)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="options[{{$row['id']}}]" id="options_{{$row['id']}}_{{$key}}" value="{{ $opt['option'] }}" @if($qans) disabled="disabled" @endif  @if(in_array($opt['option'],$qans)) checked @endif />
                                            <label class="form-check-label" for="options_{{$row['id']}}_{{$key}}">
                                                {{ $opt['option'] }}
                                            </label>
                                        </div>
                                    @endforeach
                                @endif
                                @if($qans)
                                <div class="badge @if($point==0) bg-danger @elseif($point<$row['point']) bg-warning @elseif($point==$row['point']) bg-success @endif float-start" style="margin-top:30px">Point: {{$point}}/{{$row['point']}}</div>
                                @endif
                            </div>

                            @yield($i++)
                        @endforeach

                        <nav aria-label="Page navigation example" id="nav_quiz">

                            <ul class="pagination justify-content-end pagination-sm">
                                <li class="page-item page-prev">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                </li>
                                @for($pg=1;$pg<=$topic->quiz->count();$pg++)
                                    <li class="page-item @if($pg==$selected_page) active @endif" data-page="{{$pg}}"><a class="page-link" href="#">{{$pg}}</a></li>
                                @endfor
                                <li class="page-item page-next">
                                    <a class="page-link" href="#">Next</a>
                                </li>

                                <li class="page-item">
                                    <a class="btn btn-danger btn-sm" id="quiz_reset" href="#" style="margin-left: 10px; border-radius: 0px">Start Over</a>
                                </li>

                                <li class="page-item">
                                    <a class="btn btn-success btn-sm" id="quiz_submit" href="#" style="margin-left: 10px; border-radius: 0px">Save</a>
                                </li>



                            </ul>
                        </nav>
                            <input type="hidden" name="topic_id" value="{{$topic->id}}" />
                        </form>
                    </div>
                       @endif
                </div>
            </div>

        </div>
<style>
    .draggable.badge{
        font-size: 16px;
        cursor: move;
    }

    .droppable_practice{
        border: 1px dashed #ccc;
        min-width: 200px;
        min-height: 30px;
        display: inline-block;
        margin-bottom: -7px;
        background: #fcfcfc;
    }

    .correct_icon{
        width: 25px;
        margin-top: -5px;
    }
    .learning_slides,.quiz_slides{
        display: none;
    }
    .learning_slides.active,.quiz_slides.active{
        display: block;
    }
</style>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <script type="application/javascript" src="{{asset('public/plugins/progressbar.min.js')}}"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            $( function() {
                $( ".draggable" ).draggable({ revert: "invalid" });

                @if($topic->practice->count())
                    @foreach($topic->practice as $row)
                        {!! $row['js'] !!}
                    @endforeach
                @endif
            } );

            $(document).on("click",".page-item",function(e){
               e.preventDefault();
               if($(this).hasClass('page-prev')){
                   var page = $(this).parents('.tab-pane').find('.page-item.active').data('page');
                   page = page-1;
                   change_slide(page,$(this));
               }else if($(this).hasClass('page-next')){
                   var page = $(this).parents('.tab-pane').find('.page-item.active').data('page');
                   page = page+1;
                   change_slide(page,$(this));
               }else{
                   var page = $(this).data('page');
                   change_slide(page,$(this));
               }


            });

            function change_slide(page,el){
                if(el.parents('.tab-pane').find(".learning_slides[data-page='"+page+"']").length){
                    el.parents('.tab-pane').find('.learning_slides').removeClass('active');
                    el.parents('.tab-pane').find(".learning_slides[data-page='"+page+"']").addClass('active');
                    el.parents('.tab-pane').find('.page-item').removeClass('active');
                    el.parents('.tab-pane').find(".page-item[data-page='"+page+"']").addClass('active');

                    if(el.parents("#nav_learning").length){
                        var ptype = "learning";
                    }else if(el.parents("#nav_practice").length){
                        var ptype = "practice";
                    }else{
                        return false;
                    }

                    var id = el.parents('.tab-pane').find(".learning_slides[data-page='"+page+"']").data("id");

                    $.ajax({
                        url: "{{url('learning/save_progress')}}",
                        type: "post",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "type": ptype,
                            "id": id
                        }
                    });

                }
            }

            $( function() {
                $(document).on("click", "#quiz_submit", function (e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, submit!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{url('learning/submit_quiz')}}",
                                type: "post",
                                data: $("#quiz_form").serialize(),
                                success: function (result) {
                                    if (result) {

                                        Swal.fire(
                                            'Saved!',
                                            'Your quiz has been saved.',
                                            'success'
                                        ).then(function() {
                                            window.location = "{{url('learning/topic_detail/'.$topic->id.'?section=quiz')}}";
                                        });

                                    }
                                }
                            });

                        }
                    });
                });


                $(document).on("click", "#quiz_reset", function (e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "All the progress you have made for this module's quiz will be lost",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, submit!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{url('learning/reset_quiz')}}",
                                type: "post",
                                data: {topic_id:{{$topic->id}}, "_token": "{{ csrf_token() }}"},
                                success: function (result) {
                                    if (result) {
                                        window.location = "{{url('learning/topic_detail/'.$topic->id.'?section=quiz')}}";
                                    }
                                }
                            });

                        }
                    });
                });


            });
        </script>

@endsection

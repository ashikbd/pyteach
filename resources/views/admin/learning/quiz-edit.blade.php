@extends('admin.layouts.app')
  @section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{__('Quiz')}}
        <small>{{__('Edit')}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('learning')}}"> Topic</a></li>
        <li><a href="{{url('admin/learning/topic_quiz/'.$quiz->topic_id)}}"> Quiz Sections</a></li>
        <li class="active">Edit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="panel panel-success">
        @if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

                <form method="POST" action="{{ URL('admin/learning/quiz_update') }}" enctype="multipart/form-data" id="page_add_form1">

                  {{ csrf_field() }}

                  <div class="panel-body">
            				<div class="row">
            					<div class="col-sm-8">
            						<div id="validation_errors"></div>

                            <div class="form-group">
                              <label for="question">Quiz Question:</label>
                                <textarea required class="form-control" name="question" rows="5">{{ old('question',$quiz->question) }}</textarea>
                            </div>


                            <div class="form-group">
                              <label>Type:</label>
                              <select class="form-control" id="type" required name="type">
                                  <option value="1" @if($quiz->type==1) selected @endif>Fill in the gaps</option>
                                  <option value="2" @if($quiz->type==2) selected @endif>Multiple Choice</option>
                                  <option value="3" @if($quiz->type==3) selected @endif>Single Choice</option>
                              </select>
                            </div>

                            <div class="form-group" id="type_1">
                                <label>Answer:</label>
                                <input type="text" class="form-control" id="type_1_answer" name="type_1_answer"  value="{{ old('type_1_answer') }}">
                            </div>

                          <div class="form-group" id="type_23">
                            <label>Answer (Leave blank if you want to give fewer options):</label>
                              @yield($i=1)
                             @foreach($options as $row)
                            <div class="input-group">
                                <span class="input-group-addon">{{ $i }}</span>
                                <input type="text" name="option[]" class="form-control option" value="{{$row['option']}}" />
                                <span class="input-group-addon">
                                    <input type="checkbox" class="option_answer" name="option_answer[]" @if(in_array($row['option'],$answers)) checked @endif value="{{$i}}" />
                                </span>
                            </div>
                                  @yield($i++)
                              @endforeach

                              @if($i<=6)
                                  @for(;$i<=6;$i++)
                                      <div class="input-group">
                                          <span class="input-group-addon">{{$i}}</span>
                                          <input type="text" name="option[]" class="form-control option" aria-label="...">
                                          <span class="input-group-addon">
                                            <input type="checkbox" class="option_answer" name="option_answer[]" value="{{$i}}" />
                                        </span>
                                      </div>
                                  @endfor
                              @endif


                          </div>

                        <div class="form-group">
                            <label>Point:</label>
                            <input type="text" class="form-control" name="point" required value="{{ old('point',10) }}">
                        </div>

                    <div class="form-group">
                        <label>Position:</label>
                        <input type="text" class="form-control" name="position" required value="{{ old('position',$quiz->position) }}">
                    </div>

                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control" name="status">
                            <option value="1" @if($quiz['status']==1) selected @endif>Enabled</option>
                            <option value="0" @if($quiz['status']==0) selected @endif>Disabled</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="hidden" name="id" value="{{$id}}" />
                        <button type="submit" class="btn btn-success" id="submit_page_add">Save</button>
                    </div>
                  </div>
                  </div></div>
                </form>
              </div>
          </section>

      <style>
          .input-group{
              margin-bottom: 10px;
          }
      </style>

      <script>
          jQuery(document).ready(function($){
              function type_change(){
                  var type = $("#type").val();
                  if(type=='1'){
                      $("#type_23").hide();
                      $("#type_1").show();
                  }else if(type=='2' || type=='3'){
                      $("#type_23").show();
                      $("#type_1").hide();
                  }
              }

              type_change();


              $(document).on("change","#type",function(e){
                 type_change();
              });

              $(document).on("click","#submit_page_add",function(e){
                  e.preventDefault();

                  var type = $("#type").val();
                  if(type=='1'){
                      if($("#type_1_answer").val()==""){
                          swal("Please write correct answer!","","error");
                          return false;
                      }
                  }else if(type=='2'){
                      if($(".option_answer:checked").length<2 || $(".option").filter(function() { return $(this).val() == ""; }).length>4){
                          swal("Please give multiple options and select multiple correct answers!","","error");
                          return false;
                      }
                  }else if(type=='3'){
                      if($(".option_answer:checked").length!=1 || $(".option").filter(function() { return $(this).val() == ""; }).length>4){
                          swal("Please give multiple options and select ONE correct answer!","","error");
                          return false;
                      }
                  }

                  $("#page_add_form1").submit();
              });
          })
      </script>
@endsection

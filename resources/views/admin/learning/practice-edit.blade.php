@extends('admin.layouts.app')
  @section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{__('Practice')}}
        <small>{{__('Edit')}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('learning')}}"> Topic</a></li>
        <li><a href="{{url('admin/learning/topic_practice/'.$practice->topic_id)}}"> Practice Sections</a></li>
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

                <form method="POST" action="{{ URL('admin/learning/practice_update') }}" enctype="multipart/form-data" id="page_add_form1">

                  {{ csrf_field() }}

                  <div class="panel-body">
            				<div class="row">
            					<div class="col-sm-8">
            						<div id="validation_errors"></div>

                            <div class="form-group">
                              <label for="title">Practice Title (Optional):</label>
                              <input type="text" class="form-control" name="title"  value="{{ old('title',$practice->title) }}">
                            </div>


                            <div class="form-group">
                              <label for="practice_content">Content:</label>
                              <textarea class="form-control" id="practice_content" required name="description" rows="15" cols="80">{{$practice->content}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="practice_js">JavaScript:</label>
                                <textarea class="form-control" name="js" id="practice_js" rows="15" cols="80">{{$practice->js}}</textarea>
                            </div>

                                    <div class="form-group">
                                        <label for="position">Position:</label>
                                        <input type="text" class="form-control" name="position" required value="{{ old('position',$practice['position']) }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="status">Status:</label>
                                        <select class="form-control" name="status">
                                            <option value="1" @if($practice['status']==1) selected @endif>Enabled</option>
                                            <option value="0" @if($practice['status']==0) selected @endif>Disabled</option>
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

    <script src="{{asset('public/plugins/codemirror/lib/codemirror.js')}}"></script>
    <link rel="stylesheet" href="{{asset('public/plugins/codemirror/lib/codemirror.css')}}">
    <script src="{{asset('public/plugins/codemirror/mode/javascript/javascript.js')}}"></script>
    <script src="{{asset('public/plugins/codemirror/mode/javascript/htmlmixed.js')}}"></script>
        <style>
            .CodeMirror{
                border: 1px solid #ccc;
            }
        </style>
      <script>
          var editor = CodeMirror.fromTextArea(document.getElementById('practice_js'), {
              mode: "javascript",
              lineNumbers: true,
          });

          var editor2 = CodeMirror.fromTextArea(document.getElementById('practice_content'), {
              mode: "htmlmixed",
              lineNumbers: true
          });

          $(document).on("click","#submit_page_add",function(e){
              e.preventDefault();
              editor.save();
              editor2.save();
              $("#page_add_form1").submit();
          })
      </script>

@endsection

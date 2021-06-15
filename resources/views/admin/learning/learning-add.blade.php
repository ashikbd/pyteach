@extends('admin.layouts.app')
  @section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{__('Learning')}}
        <small>{{__('Create')}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('learning')}}"> Topic</a></li>
        <li class="active">Create</li>
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

                <form method="POST" action="{{ URL('admin/learning/learning_save') }}" enctype="multipart/form-data" id="page_add_form1">

                  {{ csrf_field() }}

                  <div class="panel-body">
            				<div class="row">
            					<div class="col-sm-8">
            						<div id="validation_errors"></div>

                            <div class="form-group">
                              <label for="title">Learning Title (Optional):</label>
                              <input type="text" class="form-control" name="title"  value="{{ old('title') }}">
                            </div>


                            <div class="form-group">
                              <label for="description">Content:</label>
                              <textarea class="form-control richeditor" required name="description" rows="15" cols="80">
                                {{ old('description') }}
                              </textarea>
                            </div>

                    <div class="form-group">
                        <input type="hidden" name="topic_id" value="{{$id}}" />
                        <button type="submit" class="btn btn-success" id="submit_page_add">Save</button>
                    </div>
                  </div>
                  </div></div>
                </form>
              </div>
          </section>

@endsection

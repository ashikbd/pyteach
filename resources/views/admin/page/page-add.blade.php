@extends('admin.layouts.app')
  @section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{__('Page')}}
        <small>{{__('Create')}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('pages.index')}}"> Pages</a></li>
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

                <form method="POST" action="{{ URL('admin/pages') }}" enctype="multipart/form-data" id="page_add_form1">

                  {{ csrf_field() }}

                  <div class="panel-body">
            				<div class="row">
            					<div class="col-sm-8">
            						<div id="validation_errors"></div>

                            <div class="form-group">
                              <label for="title">Title:</label>
                              <input type="text" class="form-control" name="title" onchange="update_alias(this.value)" value="{{ old('title') }}">
                            </div>

                            <div class="form-group">
                              <label for="alias">Alias:</label>
                              <input type="text" class="form-control" name="alias" value="{{ old('alias') }}">
                            </div>

                            <div class="form-group">
                              <label for="description">Page Detail:</label>
                              <textarea class="form-control richeditor" name="description" rows="10" cols="80">
                                {{ old('description') }}
                              </textarea>
                            </div>




                    <div class="form-group">
                            <label for="category">Select Category:</label>
                            <select class="form-control" name="category" required>
                              <option value="">Select Category</option>
                              @foreach($category_list as $category)
                                <option value="{{ $category['id'] }}" @if($category['id'] == old('category')) selected="" @endif>{{ $category['category_name'] }}</option>
                              @endforeach
                            </select>
                          </div>
                  <div id="fileuploader">Upload</div>
                  <div id="uploaded_file">
                    @if(old('featured_image'))
                      <img src="{{ URL('uploads/_temp/'.old('featured_image')) }}" style="height:200px;width:200px;">
                      <br/><br/>
                    @endif
                    <input type="hidden" name="featured_image" value="{{ old('featured_image') }}">
                  </div>
                    <div class="form-group"><button type="submit" class="btn btn-success" id="submit_page_add">Save</button></div>
                  </div>
                  </div></div>
                </form>
              </div>
          </section>


    <script >
      //CKEDITOR.replace('editor1');

      $('input[name=title]').change(function() {
        var title = $('input[name=title]').val();
        var alias = title.replace(/[\s]|[,]/g,"-");
        $('input[name=alias]').val(alias.toLowerCase());
      });

    </script>

    <link href="http://hayageek.github.io/jQuery-Upload-File/4.0.11/uploadfile.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://hayageek.github.io/jQuery-Upload-File/4.0.11/jquery.uploadfile.min.js"></script>
    <script>
      $(document).ready(function()
      {


        $("#fileuploader").uploadFile({
          url: "{{ url('pages/upload_featured_img') }}",
            fileName: "myfile",
            statusBarWidth: '100%',
            dragdropWidth: false,
            multiple: false,
            maxFileSize: 10 * 1024 * 1024,
            showStatusAfterSuccess: true,
            sequential: false,
            showPreview: true,
            previewHeight: "200px",
            previewWidth: "200px",
            showDelete: true,
            formData: {"_token":"{{ csrf_token() }}"},

            onSuccess: function (files, data, xhr, pd) {
              console.log(data);
                var uploaded_file = JSON.parse(data);
                console.log(uploaded_file);
                if(uploaded_file['success']){
                  $("#uploaded_file").html('<input type="hidden" name="featured_image" value="'+ uploaded_file['fileName']+'">');
                }
                else{
                  bootbox.alert(uploaded_file['errorMessage']);
                }

            },
            afterUploadAll: function (obj) {

            },
            deleteCallback: function(files, data, xhr){
                var file_info = JSON.parse(files);
                $('input[value="'+file_info['fileName']+'"').remove();
            }
        });
      });
      </script>
@endsection

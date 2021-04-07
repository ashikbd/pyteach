@extends('admin.layouts.app')
  @section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{__('Album')}}
        <small>{{__('Images')}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('media_categories.index')}}"> Media Albums</a></li>
        <li class="active">Images</li>
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

                <form method="POST" action="{{ URL('/media_albums') }}">
                  {{ csrf_field() }}
                  <div class="col-md-6">


                    <div class="form-group">
                      <label>Select Album</label>
                      <select name="album_id" id="album_id" class="form-control select2" required>
                        <option value="">---</option>
                        @foreach($album_list as $album)
                          <option value="{{ $album['id'] }}" @if($album_id == $album['id']) selected @endif>{{ $album['name'] }}</option>
                        @endforeach
                      </select>
                    </div>

                    @if($album_id)
                    <div class="box box-info box-solid">
                      <div class="box-header with-border">
                        <h3 class="box-title">Upload Media</h3>

                        <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                          </button>
                        </div>
                        <!-- /.box-tools -->
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body" style="">
                        <label class="radio-inline">
                            <input type="radio" name="media_type" class="media_type" value="1" checked />
                            Image
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="media_type" class="media_type" value="2" />
                            Video
                        </label>

                        <div id="image_uploader_wrap" style="margin-top:20px;">
                          <div id="image_uploader"></div>
                          <div id="image_error_res" class="error"></div>
                        </div>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    @endif
                </div>
                </form>

                <div class="col-md-12">
                  <div class="row" id="media_thumbs">
                  @if($media_list)
                    @foreach($media_list as $media)

                      @if($media['type'] == 1)
                      <div class="col-md-2" row_id="{{ $media['id'] }}" id="id-{{ $media['id'] }}">
                        <div class="thumbnail">
                          <a class="image-popup" href="{{ url('uploads/media/'.$media['name']) }}">
                              <img src="{{ url('uploads/media/thumbs/'.$media['name']) }}" style="width:100%">
                                <div class="caption">
                                  <a href="{{ URL('admin/media/additional_data/'.$media['id']) }}" class="btn btn-info btn-xs ajax-link" title="Add Data"><i class="glyphicon glyphicon-plus"></i></a>
                                  <a href="{{ URL('admin/media/destroy') }}" data-id="{{ $media['id'] }}" class="btn btn-danger btn-xs delete_confirm" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>

                                </div>
                            </a>
                            <span href="#" class="btn btn-default btn-xs pull-right media_sort" title="Drag to Sort"><i class="glyphicon glyphicon-move"></i></span>
                        </div>
                      </div>
                      @endif
                    @endforeach
                  @endif
                    </div>
                </div>
              </div>
          </section>

    <style>
    .media_sort{
      cursor: move;
      background-color: #ffffff;
      border-color: #8b8b8b;
      position: absolute;
      top: 5px;
      right: 20px;
      border-radius: 0px;
    }
    </style>
<link rel="stylesheet" href="{{ asset('public/plugins/jquery-upload-file/uploadfile.min.css') }}" />
<script src="{{ asset('public/plugins/jquery-upload-file/jquery.uploadfile.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('public/plugins/magnific-popup/magnific-popup.css') }}" />
<script src="{{ asset('public/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
<script>
$("#album_id").on("change",function(e){
  var album_id = $(this).val();
  if(album_id){
    location.href = "{{ URL('admin/media') }}/"+album_id;
  }else{
    location.href = "{{ URL('admin/media') }}";
  }

});


@if($album_id)
$("#image_uploader").uploadFile({
  url: "{{ url('admin/media/upload_img') }}",
    fileName: "image",
    statusBarWidth: '100%',
    multiple: true,
    maxFileSize: 10 * 1024 * 1024,
    showStatusAfterSuccess: false,
    sequential: true,
    sequentialCount: 1,
    allowedTypes: "jpg,jpeg,png,gif",
    formData: {"_token":"{{ csrf_token() }}","album_id":"{{ $album_id }}"},
    onSuccess: function (files, data, xhr, pd) {
      var res = JSON.parse(data);
      if(res.error){
        $("#image_error_res").html(res.error);
      }

      if(res.image){
        $("#image_error_res").html("");
        var html = '<div class="col-md-2" id="id-'+res.id+'" row_id="'+res.id+'">' +
          '<div class="thumbnail">'+
            '<a class="image-popup" href="{{ url('uploads/media') }}/'+res.image+'">' +
                '<img src="{{ url('uploads/media/thumbs') }}/'+res.image+'" style="width:100%">' +
                  '<div class="caption">' +
                    '<a href="#" class="btn btn-info btn-xs" title="Add Data"><i class="glyphicon glyphicon-plus"></i></a>' +
                    '<a href="{{ URL('admin/media/destroy') }}" data-id="'+res.id+'" class="btn btn-danger btn-xs delete_confirm" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>' +
                  '</div>' +
              '</a>' +
              '<span href="#" class="btn btn-default btn-xs pull-right media_sort" title="Drag to Sort"><i class="glyphicon glyphicon-move"></i></span>' +
          '</div>' +
        '</div>';

        $("#media_thumbs").append(html);
        $('.image-popup').magnificPopup({type:'image'});
      }
    }
});


$("#media_thumbs").sortable({
    update: function (e, u) {
        var data = $(this).sortable('serialize');
        $.ajax({
            url: "{{ url('admin/media/sort_media') }}",
            type: 'post',
            data: data,
            success: function (result) {

            },
            complete: function () {

            }
        });
    },
    cursor: "move",
    handle: ".media_sort",
    tolerance: "pointer",
    opacity: 0.5
});

$('.image-popup').magnificPopup({type:'image'});
$('.ajax-link').magnificPopup({type:'ajax',fixedContentPos:true});
@endif


</script>

<script>
$(document).on("submit",".additional_data_form",function(e){
  e.preventDefault();
  $.ajax({
    url: "{{ URL('admin/media/additional_data_save') }}",
    type: "post",
    data: $(this).serialize(),
    success: function(result){
      if(result == 'ok'){
        swal({
          icon: "success",
          title: "Successfully Saved!"
        });
        $.magnificPopup.close();
      }else{

      }
    }
  });
});
</script>
@endsection

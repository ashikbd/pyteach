@extends('admin.layouts.app')
  @section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{__('Product')}}
        <small>{{__('Edit')}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('products.index')}}"> Product</a></li>
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

	   <form action="{{route('products.update',$product->id)}}" enctype="multipart/form-data" method="POST">
       {{ csrf_field() }}
   		{{ method_field('PUT') }}
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-8">
						<div id="validation_errors"></div>

						<div class="col-sm-12">
							<div class="form-group">

								<label class="control-label">{{ __('Name') }}</label>

									<input required type="text" name="name" value="{{$product->name}}" class="form-control" />

								<div class="help-block with-errors"></div>
							</div>
						</div>

            <div class="col-sm-12">
							<div class="form-group">

								<label class="control-label">{{ __('Category') }}</label>

									<select class="form-control" required name="category_id" id="category_id">
                    <option value="">---</option>
                    @foreach($categories as $row)
                      <option value="{{$row->id}}" @if($product->category_id == $row->id) selected @endif>{{$row->name}}</option>
                    @endforeach
                  </select>

								<div class="help-block with-errors"></div>
							</div>
						</div>

            <div class="col-sm-12">
							<div class="form-group">

								<label class="control-label">{{ __('Sub-Category') }}</label>

									<select class="form-control" name="subcategory_id" id="subcategory_id">
                    <option value="">---</option>
                    @foreach($subcategories as $row)
                      <option value="{{$row->id}}" @if($product->subcategory_id == $row->id) selected @endif>{{$row->name}}</option>
                    @endforeach
                  </select>

								<div class="help-block with-errors"></div>
							</div>
						</div>

            <div class="col-sm-12">
							<div class="form-group">

								<label class="control-label">{{__('Description')}}</label>

									<textarea name="description" class="form-control richeditor">{{$product->description}}</textarea>

								<div class="help-block with-errors"></div>
							</div>
						</div>

            @foreach($sections as $row)
              <div class="col-sm-12">
                <div class="form-group">

                  <label class="control-label">{{$row->name}}</label>
                    @php
                    $section_details = $product->section_details()->where('section_id',$row->id)->first();
                    @endphp
                    <textarea name="section_description[{{$row->id}}]" class="form-control richeditor">{{$section_details?$section_details->getOriginal()['pivot_section_description']:''}}</textarea>

                  <div class="help-block with-errors"></div>
                </div>
              </div>
            @endforeach

            <div class="col-sm-12">
							<div class="form-group">

								<label class="control-label">{{ __('Price') }}</label>

									<input required type="text" value="{{$product->price}}" name="price" class="form-control" />

								<div class="help-block with-errors"></div>
							</div>
						</div>

            <div class="col-sm-12">
							<div class="form-group">

								<label class="control-label">{{ __('Special Price') }}</label>

									<input type="text" name="special_price" value='{{$product->special_price}}' class="form-control" />

								<div class="help-block with-errors"></div>
							</div>
						</div>

            <div class="col-sm-12">
							<div class="form-group">

								<label class="control-label">{{ __('Weight') }} (gm)</label>

									<input type="text" name="weight" value='{{$product->weight}}' class="form-control" />

								<div class="help-block with-errors"></div>
							</div>
						</div>

            <div class="col-sm-12">
							<div class="form-group">

								<label class="control-label">{{ __('Stock Qty') }}</label>

									<input type="text" name="stock" value='{{$product->stock}}' class="form-control" />

								<div class="help-block with-errors"></div>
							</div>
						</div>

            <div class="col-sm-12">
                <div class="form-group">
                    <label class="control-label">{{__('Images')}}</label>
                    <div id="image_uploader">Upload</div>
                    <div class="form-group">
                      <label class="control-label">{{__('OR Add Vimeo Video')}}</label>
                      <div class="input-group">
                        <input type="text" class="form-control" id='vimeo_id' placeholder="Vimeo Video ID" />
                        <div class="input-group-btn">
                          <button class="btn btn-success" id="vimeo_id_add"><i class="fa fa-plus" style="font-weight:normal; font-size:10px;"></i></button>
                        </div>
                      </div>
                    </div>

                    <div class="clearfix"></div>
                    <div id="image_response">
                      @foreach($product->images()->orderBy('sort')->get() as $row)
                        @if($row->type == 2)

                        <div class='col-md-4 editClass padding-left-0'>
                          <div class='buttonEdit green-bg'>
                            <a class='dropdown-toggle' data-toggle='dropdown' href='#' role='button' aria-expanded='false'><i class='fa fa-bars'></i></a>
                            <ul class="dropdown-menu" role="menu">
                            <li><a href="#" class="deleteImageExisting" data-id="{{ $row->id }}">Delete</a></li>
                            </ul>
                          </div>
                          <a href='https://player.vimeo.com/video/{{$row->vimeo_id}}' class='fancybox fancybox.iframe'>
                          <img style='max-width: 100%;' class='thumbnail mar-bottom-10'  src='{{$row->file_name}}' />
                          </a>
                          <input type="hidden" name="images[]" value="video_{{ $row->vimeo_id }}" />
                        </div>

                        @else
                        <div class='col-md-4 editClass padding-left-0'>
      									  <div class='buttonEdit green-bg'>
      										  <a class='dropdown-toggle' data-toggle='dropdown' href='#' role='button' aria-expanded='false'><i class='fa fa-bars'></i></a>
      										  <ul class="dropdown-menu" role="menu">
      											<li><a href="#" class="deleteImageExisting" data-id="{{ $row->id }}">Delete</a></li>
      										  </ul>
      									  </div>
      									  <a href='{{ url('uploads/products/'.$row->file_name) }}' class='fancybox'>
      										<img style='max-width: 100%;' class='thumbnail mar-bottom-10'  src='{{ url('uploads/products/thumbs/'.$row->file_name) }}' />
      									  </a>
      									  <input type="hidden" name="images[]" value="{{ $row->file_name }}" />
      									</div>
                        @endif
      								@endforeach
                    </div>

                    <div class="help-block with-errors"></div>
                </div>
            </div>

						<div class="col-sm-12">
							<div class="form-group">

								<label class="control-label">{{ __('Status') }}</label>

									<select name="status" class="form-control">
										<option value="1" @if($product->status == 1) selected @endif>{{ __('Enabled') }}</option>
										<option value="0" @if($product->status == 0) selected @endif>{{ __('Disabled') }}</option>
									</select>

								<div class="help-block with-errors"></div>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<button type="submit" class="btn green"><i class="icon-ok"></i> {{ __('Save') }}</button>
								<a class="btn btn-danger" href="{{ route('products.index') }}" data-dismiss="modal"><i class="icon-remove"></i> {{ __('Cancel') }}</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
    </div>
</section>
<style>
.ajax-upload-dragdrop{
	width: 100% !important;
}

#image_response .buttonEdit {
    position: absolute;
    top: 0;
    left: 0;
    padding: 5px;
    box-shadow: 1px 1px 1px #ccc;
    background-color: #FFF;
}
#image_response .dropdown-menu{
	left: 0;
}
</style>
<script>
$(document).on('ready',function(){
		$("a.fancybox").fancybox();
		$("#image_response").sortable();
	});
$("#image_uploader").uploadFile({
    url: "{{ url('admin/products/upload_image_temp') }}",
    fileName: "image",
    multiple: true,
    maxFileSize: 15 * 1024 * 1024,
    showStatusAfterSuccess: false,
    sequential: true,
    sequentialCount: 1,
    allowedTypes: "jpg,gif,jpef,png",
    formData: {"_token":"{{ csrf_token() }}"},
    onSuccess: function (files, data, xhr) {

      //data = JSON.parse(data);
      if (data.fileName) {

          var img = "<div class='col-md-4 editClass padding-left-0'>"
                  + "<div class='buttonEdit green-bg'>"
                  + "<a class='dropdown-toggle' data-toggle='dropdown' href='#' role='button' aria-expanded='false'><i class='fa fa-bars'></i></a>"
                  + '<ul class="dropdown-menu" role="menu">'
                  + '<li><a href="#" class="deleteImage" data-imgname="'+data.fileName+'">'
                  + 'Delete</a></li>'
                  + '</ul></div>'
                  + "<a href='{{ url('uploads/_temp') }}/"+data.fileName+"' class='fancybox'><img style='max-width: 100%;' class='thumbnail mar-bottom-10'  src='{{ url('uploads/_temp/thumbs') }}/"+data.fileName+"' /></a>"
                  + '<input type="hidden" name="images[]" value="'+data.fileName+'" />'
                  + "</div>";
          $("#image_response").append(img);
      }else{
           $("#image_response").html("<div class='alert alert-danger'>"+data.error+"<div>");
      }

  	  $("a.fancybox").fancybox();
  	  $("#image_response").sortable();
    }
});

$(document).on("click","#vimeo_id_add",function(e){
    e.preventDefault();
    var vimeo_id = $("#vimeo_id").val();
    //alert(vimeo_id);
    if(vimeo_id){
      $.ajax({
        url: "{{url('admin/products/get_vimeo_thumb')}}/"+vimeo_id,
        type: 'get',
        success: function(result){
          if(result){
            var img = "<div class='col-md-4 editClass padding-left-0'>"
                    + "<div class='buttonEdit green-bg'>"
                    + "<a class='dropdown-toggle' data-toggle='dropdown' href='#' role='button' aria-expanded='false'><i class='fa fa-bars'></i></a>"
                    + '<ul class="dropdown-menu" role="menu">'
                    + '<li><a href="#" class="deleteImageVideo" data-imgname="'+vimeo_id+'">'
                    + 'Delete</a></li>'
                    + '</ul></div>'
                    + "<a href='https://player.vimeo.com/video/"+vimeo_id+"' class='various fancybox.iframe'><img style='max-width: 100%;' class='thumbnail mar-bottom-10'  src='"+result+"' /></a>"
                    + '<input type="hidden" name="images[]" value="video_'+vimeo_id+'" />'
                    + "</div>";
            $("#image_response").append(img);

            $(".various").fancybox({
          		fitToView	: true,
          		autoSize	: true,
          		closeClick	: true
          	});
            $("#image_response").sortable();
            $("#vimeo_id").val('');
          }else{
              alert('Something is wrong with the id. Please check or try again!');
          }
        }
      })

    }

});


$(document).on("click",".deleteImage",function(e){
  e.preventDefault();
  var imgname = $(this).data('imgname');
  var parent = $(this).parents(".editClass");
  $.ajax({
    url: "{{ url('admin/products/deleteImageTemp') }}",
    data: {_token:"{{ csrf_token() }}", fileToDelete:imgname},
    type: "post",
	dataType:'json',
    success: function(result){
      if(result.success == true){
        parent.remove();
      }
    }
  });
});

$(document).on("click",".deleteImageVideo",function(e){
  e.preventDefault();
  var imgname = $(this).data('imgname');
  var parent = $(this).parents(".editClass");
  parent.remove();
});

$(document).on("click",".deleteImageExisting",function(e){
  e.preventDefault();
  var imgid = $(this).data('id');
  var parent = $(this).parents(".editClass");
  $.ajax({
    url: "{{ url('admin/products/deleteImage') }}",
    data: {_token:"{{ csrf_token() }}", imgid:imgid, product_id: {{ $product->id }}},
    type: "post",
    success: function(result){
      if(result.success == true){
        parent.remove();
      }
    }
  });
});

$(document).on("change","#category_id",function(e){
  var category_id = $(this).val();
  if(!category_id){
    $("#subcategory_id").html("<option value=''>---</option>");
    return false;
  }
  $.ajax({
    url: "{{ url('admin/products/load_subcategory') }}",
    data: {_token:"{{ csrf_token() }}", category_id:category_id},
    type: "post",
    dataType:'json',
    success: function(result){
      var dropdown = "<option value=''>---</option>";
      $.each(result, function(key, value) {
        dropdown += "<option value='"+value.id+"'>"+value.name+"</option>";
      });
      $("#subcategory_id").html(dropdown);
    }
  });
});
</script>

@endsection

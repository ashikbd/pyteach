<div class="box box-info" style="width:600px;margin:auto">
  <div class="box-header">
    <!-- /. tools -->
  </div>
  <!-- /.box-header -->
  <div class="box-body pad">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="additional_data_form" method="POST" action="">
      {{ csrf_field() }}
      <div class="col-md-12">


        <div class="tabbable ">
          <ul class="nav nav-tabs">
            @foreach($lang_list as $key => $lang)
              <li @if($key == 0) class="active" @endif>
                <a href="#tab_{{ $lang['code'] }}" data-toggle="tab">
                  {{ $lang['name'] }}
                </a>
              </li>

            @endforeach
          </ul>
          <div class="tab-content">
            @foreach($lang_list as $key => $lang)
                <div class="tab-pane @if($key == 0) active @endif" id="tab_{{ $lang['code'] }}">
                  <br/>
                  <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" name="title[{{ $lang['code'] }}]" value="{{ old('title.'.$lang["code"],$additional_data[$lang["code"]]['title']) }}">
                  </div>


                  <div class="form-group">
                    <label for="description">Page Detail:</label>
                    <textarea class="form-control" name="description[{{ $lang['code'] }}]">{{ old('description.'.$lang['code'],$additional_data[$lang["code"]]['description']) }}</textarea>
                  </div>
                </div>
              @endforeach

            </div>
          </div>

          <div class="form-group">
            <input type="hidden" name="media_id" value="{{ $media_id }}" />
            <button type="submit" class="btn btn-success pull-right">Save</button>
          </div>
    </div>
    </form>
  </div>
</div>

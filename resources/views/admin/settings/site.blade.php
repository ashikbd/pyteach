@extends('admin.layouts.app')
  @section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{__('Common Settings')}}
        <small>{{__('Create')}}</small>
      </h1>
      
    </section>
<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
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
        <form method="POST" action="{{ URL('admin/settings')}}">
          {{ csrf_field() }}
          <div class="col-md-12">
                <div class="page-header">
                    <h4><b><i class="icon-map-marker"></i> Address and Location</b></h4>
                </div>
                <div class="form-group">
                    <label class="control-label" for="contact_address">Contact Address</label>
                    <div class="controls">
                        <input type="text" name="settings[contact_address]" id="contact_address" class="form-control" value="@if(!empty($settings['contact_address'])){{$settings['contact_address']}}@endif">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="contact_phone_1">Contact Phone 1</label>
                    <div class="controls">
                        <input type="text" name="settings[contact_phone_1]" id="contact_phone_1" class="form-control" value="@if(!empty($settings['contact_phone_1'])){{$settings['contact_phone_1']}}@endif">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="contact_phone_2">Contact Phone 2</label>
                    <div class="controls">
                        <input type="text" name="settings[contact_phone_2]" id="contact_phone_2" class="form-control" value="@if(!empty($settings['contact_phone_2'])){{$settings['contact_phone_2']}}@endif">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="contact_email">Contact Email</label>
                    <div class="controls">
                        <input type="text" name="settings[contact_email]" id="contact_email" class="form-control" value="@if(!empty($settings['contact_email'])){{$settings['contact_email']}}@endif">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="contact_page_text">Contact Page Text</label>
                    <div class="controls">
                        <textarea name="settings[contact_page_text]" id="contact_page_text" class="form-control">@if(!empty($settings['contact_page_text'])){{$settings['contact_page_text']}}@endif</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="contact_page_map">Google Map Embed Code</label>
                    <div class="controls">
                        <textarea name="settings[contact_page_map]" rows="4" id="contact_page_map" class="form-control">@if(!empty($settings['contact_page_map'])){{$settings['contact_page_map']}}@endif</textarea>
                    </div>
                </div>

            </div>

            <div class="col-md-6">
                                <div class="page-header">
                                    <h4><b><i class="icon-link"></i> Social Media Link</b></h4>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="instagram_link">Instagram Link</label>
                                    <div class="controls">
                                        <input type="text" name="settings[instagram_link]" id="instagram_link" class="form-control" value="@if(!empty($settings['instagram_link'])){{$settings['instagram_link']}}@endif">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="twitter_link">Twitter Link</label>
                                    <div class="controls">
                                        <input type="text" name="settings[twitter_link]" id="twitter_link" class="form-control" value="@if(!empty($settings['twitter_link'])){{$settings['twitter_link']}}@endif">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="facebook_link">Facebook Link</label>
                                    <div class="controls">
                                        <input type="text" name="settings[facebook_link]" id="facebook_link" class="form-control" value="@if(!empty($settings['facebook_link'])){{$settings['facebook_link']}}@endif">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="youtube_link">Youtube Link</label>
                                    <div class="controls">
                                        <input type="text" name="settings[youtube_link]" id="youtube_link" class="form-control" value="@if(!empty($settings['youtube_link'])){{$settings['youtube_link']}}@endif">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="pinterest_link">Pinterest Link</label>
                                    <div class="controls">
                                        <input type="text" name="settings[pinterest_link]" id="pinterest_link" class="form-control" value="@if(!empty($settings['pinterest_link'])){{$settings['pinterest_link']}}@endif">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="page-header">
                                    <h4><b><i class="icon-info-sign"></i> Custom Information</b></h4>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="site_title">Site Title</label>
                                    <div class="controls">
                                        <input type="text" name="settings[site_title]" id="site_title" class="form-control" value="@if(!empty($settings['site_title'])){{$settings['site_title']}}@endif">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label" for="custom_js">Custom JS</label>
                                    <div class="controls">
                                        <textarea name="settings[custom_js]" rows="6" id="custom_js" class="form-control">@if(!empty($settings['custom_js'])){{$settings['custom_js']}}@endif</textarea>
                                    </div>
                                </div>
                                <input type="hidden" name="type" value="{{ $type }}" />
                                <input type="submit" value="save" class="btn btn-success  pull-right">
                            </div>
        </form>
      </div>
    </div>
    <!-- /.box -->
    </div>
    </div>
  </div>

@endsection

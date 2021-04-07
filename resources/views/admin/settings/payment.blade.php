@extends('admin.layouts.app')
  @section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{__('Payment Settings')}}
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
                    <h4><b><i class="icon-map-marker"></i> Stripe Payment Settings</b></h4>
                </div>
                <div class="form-group">
                    <label class="control-label" for="stripe_env">Environment</label>
                    <div class="controls">
                        <select class='form-control' name='settings[stripe_env]'>
                          <option value='test' @if(!empty($settings['stripe_env']) && $settings['stripe_env'] == 'test') selected @endif>Test Mode</option>
                          <option value='live' @if(!empty($settings['stripe_env']) && $settings['stripe_env'] == 'live') selected @endif>Live Mode</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="stripe_public_key_test">Test Public Key</label>
                    <div class="controls">
                        <input type="text" name="settings[stripe_public_key_test]" id="stripe_public_key_test" class="form-control" value="@if(!empty($settings['stripe_public_key_test'])){{$settings['stripe_public_key_test']}}@endif">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="stripe_secret_key_test">Test Secret Key</label>
                    <div class="controls">
                        <input type="text" name="settings[stripe_secret_key_test]" id="stripe_secret_key_test" class="form-control" value="@if(!empty($settings['stripe_secret_key_test'])){{$settings['stripe_secret_key_test']}}@endif">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="stripe_public_key_live">Live Public Key</label>
                    <div class="controls">
                        <input type="text" name="settings[stripe_public_key_live]" id="stripe_public_key_live" class="form-control" value="@if(!empty($settings['stripe_public_key_live'])){{$settings['stripe_public_key_live']}}@endif">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="stripe_secret_key_live">Live Secret Key</label>
                    <div class="controls">
                        <input type="text" name="settings[stripe_secret_key_live]" id="stripe_secret_key_live" class="form-control" value="@if(!empty($settings['stripe_secret_key_live'])){{$settings['stripe_secret_key_live']}}@endif">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="stripe_api_version">API Version</label>
                    <div class="controls">
                        <input type="text" name="settings[stripe_api_version]" id="stripe_api_version" class="form-control" value="@if(!empty($settings['stripe_api_version'])){{$settings['stripe_api_version']}}@endif">
                    </div>
                </div>
                <br />
                <div class="page-header">
                    <h4><b><i class="icon-map-marker"></i> Currency Conversion Rate</b></h4>
                </div>
                <div class="form-group">
                    <label class="control-label" for="usd_to_hkd_rate">1 USD = ? HKD</label>
                    <div class="controls">
                        <input type="text" name="settings[usd_to_hkd_rate]" id="usd_to_hkd_rate" class="form-control" value="@if(!empty($settings['usd_to_hkd_rate'])){{$settings['usd_to_hkd_rate']}}@endif">
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

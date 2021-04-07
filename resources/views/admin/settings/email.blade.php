@extends('layouts.app')
@section('content')
    @include('layouts.sidebar')
      <div class="content-wrapper">
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
        <form method="POST" action="{{ URL('/settings')}}">
          {{ csrf_field() }}
          <div class="col-md-12">
                <div class="page-header">
                    <h4><b><i class="icon-map-marker"></i> Email Settings</b></h4>
                </div>
                <div class="form-group">
            <label class="control-label" for="settings_mail_protocol">Email Protocol</label>
            <div class="controls">
                <select class="form-control" name="settings[mail_protocol]">
                    <option value="mail" @if(!empty($settings['mail_protocol']) && $settings['mail_protocol'] == 'mail') selected @endif>Mail</option>
                    <option value="smtp" @if(!empty($settings['mail_protocol']) && $settings['mail_protocol'] == 'smtp') selected @endif>SMTP</option>
                </select>
            </div>
        </div>


        <div class="form-group">
            <label class="control-label" for="settings_email_noti">Notification Email Address (For contact and other notifications)</label>
            <div class="controls">
                <input type="text" name="settings[email_noti]" id="ini_email_noti" class="form-control" value="@if(!empty($settings['email_noti'])){{$settings['email_noti']}}@endif">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="email_site_name">Website Name (To be used in outgoing email header)</label>
            <div class="controls">
                <input type="text" name="settings[email_site_name]" id="email_site_name" class="form-control" value="@if(!empty($settings['email_site_name'])){{$settings['email_site_name']}}@endif">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="settings_email_from">Email Address (Outgoing emails will be sent from this address)</label>
            <div class="controls">
                <input type="text" name="settings[email_from]" id="ini_email_from" class="form-control" value="@if(!empty($settings['email_from'])){{$settings['email_from']}}@endif">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="settings_smtp_port">SMTP Port</label>
            <div class="controls">
                <input type="text" name="settings[smtp_port]" id="ini_smtp_port" class="form-control" value="@if(!empty($settings['smtp_port'])){{$settings['smtp_port']}}@endif">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="settings_smtp_host">SMTP Host</label>
            <div class="controls">
                <input type="text" name="settings[smtp_host]" id="ini_smtp_host" class="form-control" value="@if(!empty($settings['smtp_host'])){{$settings['smtp_host']}}@endif">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="settings_smtp_user">SMTP User</label>
            <div class="controls">
                <input type="text" name="settings[smtp_user]" id="ini_smtp_user" class="form-control" value="@if(!empty($settings['smtp_user'])){{$settings['smtp_user']}}@endif">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="settings_smtp_pass">SMTP Password</label>
            <div class="controls">
                <input type="text" name="settings[smtp_pass]" id="ini_smtp_pass" class="form-control" value="@if(!empty($settings['smtp_pass'])){{$settings['smtp_pass']}}@endif">
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

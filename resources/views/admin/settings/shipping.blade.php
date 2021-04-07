@extends('admin.layouts.app')
  @section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{__('Shipping Settings')}}
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
                <h4><b><i class="icon-map-marker"></i> Shipping Method</b></h4>
            </div>

            <div class="radio">
              <label><input type='radio' name='settings[shipping_method]' class="shipping_method" value='hk_post' @if(!empty($settings['shipping_method']) && $settings['shipping_method'] == 'hk_post') checked @endif />HK POST</label>
              <label style="margin-left:20px;"><input type='radio' class="shipping_method" name='settings[shipping_method]' value='custom' @if(!empty($settings['shipping_method']) && $settings['shipping_method'] == 'custom') checked @endif />Customized</label>
            </div>

          </div>

          <div class="col-md-6 shipping_form shipping_custom">
            <div class="page-header">
                <h4><b><i class="icon-map-marker"></i> Custom Shipping Configuration</b></h4>
            </div>

                <div class="form-group">
                    <label class="control-label" for="shipping_standard_label">Shipping Standard Label</label>
                    <div class="controls">
                        <input type="text" name="settings[shipping_standard_label]" id="shipping_standard_label" class="form-control" value="@if(!empty($settings['shipping_standard_label'])){{$settings['shipping_standard_label']}}@endif">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="shipping_express_label">Shipping Express Label</label>
                    <div class="controls">
                        <input type="text" name="settings[shipping_express_label]" id="shipping_express_label" class="form-control" value="@if(!empty($settings['shipping_express_label'])){{$settings['shipping_express_label']}}@endif">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="postmen_hkpost_id_test">Cost for standard shipping</label>
                    <div class="controls">
                        <table class="table">

                          <tbody>
                            <tr>
                              <td>Order Amount</td>
                              <td>0 ~ <input style="display: inline; width: 50px" type="text" name="settings[shipping_standard_range_1]" id="shipping_standard_range_1" class="form-control" value="@if(!empty($settings['shipping_standard_range_1'])){{$settings['shipping_standard_range_1']}}@endif">
                                 ~ <input style="display: inline; width: 50px" type="text" name="settings[shipping_standard_range_2]" id="shipping_standard_range_2" class="form-control" value="@if(!empty($settings['shipping_standard_range_2'])){{$settings['shipping_standard_range_2']}}@endif">
                                 ~ Rest
                              </td>
                            </tr>
                            <tr>
                              <td>Shipping Cost</td>
                              <td><input style="display: inline; width: 50px; margin-left: 20px;" type="text" name="settings[shipping_standard_range_1_cost]" id="shipping_standard_range_1_cost" class="form-control" value="@if(!empty($settings['shipping_standard_range_1_cost'])){{$settings['shipping_standard_range_1_cost']}}@endif">
                                 <input style="display: inline; width: 50px; margin-left: 10px;" type="text" name="settings[shipping_standard_range_2_cost]" id="shipping_standard_range_2_cost" class="form-control" value="@if(!empty($settings['shipping_standard_range_2_cost'])){{$settings['shipping_standard_range_2_cost']}}@endif">
                                 <input style="display: inline; width: 50px; margin-left: 10px;" type="text" name="settings[shipping_standard_rest_cost]" id="shipping_standard_rest_cost" class="form-control" value="@if(!empty($settings['shipping_standard_rest_cost'])){{$settings['shipping_standard_rest_cost']}}@else 0 @endif">
                              </td>
                            </tr>

                          </tbody>
                        </table>
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label" for="shipping_express_cost">Cost for Express Shipping</label>
                    <div class="controls">
                        <input type="text" name="settings[shipping_express_cost]" id="shipping_express_cost" class="form-control" value="@if(!empty($settings['shipping_express_cost'])){{$settings['shipping_express_cost']}}@endif">
                    </div>
                </div>



            </div>

          <div class="col-md-6 shipping_form shipping_hk_post">
            <div class="page-header">
                <h4><b><i class="icon-map-marker"></i> Postmen(HKPOST) Settings</b></h4>
            </div>
                <div class="form-group">
                    <label class="control-label" for="stripe_env">Environment</label>
                    <div class="controls">
                        <select class='form-control' name='settings[postmen_env]'>
                          <option value='test' @if(!empty($settings['postmen_env']) && $settings['postmen_env'] == 'test') selected @endif>Test Mode</option>
                          <option value='live' @if(!empty($settings['postmen_env']) && $settings['postmen_env'] == 'live') selected @endif>Live Mode</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="postmen_api_key_test">Test Postmen Api Key</label>
                    <div class="controls">
                        <input type="text" name="settings[postmen_api_key_test]" id="postmen_api_key_test" class="form-control" value="@if(!empty($settings['postmen_api_key_test'])){{$settings['postmen_api_key_test']}}@endif">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="postmen_api_key_production">Production Postmen Api Key</label>
                    <div class="controls">
                        <input type="text" name="settings[postmen_api_key_production]" id="postmen_api_key_production" class="form-control" value="@if(!empty($settings['postmen_api_key_production'])){{$settings['postmen_api_key_production']}}@endif">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="postmen_hkpost_id_test">HongKong Post Test ID</label>
                    <div class="controls">
                        <input type="text" name="settings[postmen_hkpost_id_test]" id="postmen_hkpost_id_test" class="form-control" value="@if(!empty($settings['postmen_hkpost_id_test'])){{$settings['postmen_hkpost_id_test']}}@endif">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="postmen_hkpost_id_live">HongKong Post Production ID</label>
                    <div class="controls">
                        <input type="text" name="settings[postmen_hkpost_id_live]" id="postmen_hkpost_id_live" class="form-control" value="@if(!empty($settings['postmen_hkpost_id_live'])){{$settings['postmen_hkpost_id_live']}}@endif">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="postmen_hkpost_e_express_label">HongKong Post E-express Label</label>
                    <div class="controls">
                        <input type="text" name="settings[postmen_hkpost_e_express_label]" id="postmen_hkpost_e_express_label" class="form-control" value="@if(!empty($settings['postmen_hkpost_e_express_label'])){{$settings['postmen_hkpost_e_express_label']}}@endif">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="postmen_hkpost_speedpost_label">HongKong Post Speedpost Label</label>
                    <div class="controls">
                        <input type="text" name="settings[postmen_hkpost_speedpost_label]" id="postmen_hkpost_speedpost_label" class="form-control" value="@if(!empty($settings['postmen_hkpost_speedpost_label'])){{$settings['postmen_hkpost_speedpost_label']}}@endif">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="postmen_hkpost_smartpost_label">HongKong Post Smart Post Label</label>
                    <div class="controls">
                        <input type="text" name="settings[postmen_hkpost_smartpost_label]" id="postmen_hkpost_smartpost_label" class="form-control" value="@if(!empty($settings['postmen_hkpost_smartpost_label'])){{$settings['postmen_hkpost_smartpost_label']}}@endif">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label" for="postmen_hkpost_e_express_free_shipping_amount">Free Shipping Minimum Amount (For HongKong Post E-express)</label>
                    <div class="controls">
                        <input type="text" name="settings[postmen_hkpost_e_express_free_shipping_amount]" id="postmen_hkpost_e_express_free_shipping_amount" class="form-control" value="@if(!empty($settings['postmen_hkpost_e_express_free_shipping_amount'])){{$settings['postmen_hkpost_e_express_free_shipping_amount']}}@endif">
                    </div>
                </div>



            </div>

            <div class='col-md-6 shipping_form shipping_hk_post'>
              <div class="page-header">
                  <h4><b><i class="icon-map-marker"></i> Shipper Address</b></h4>
              </div>


              <div class="form-group">
                  <label class="control-label" for="shipper_company_name">Company Name</label>
                  <div class="controls">
                      <input type="text" name="settings[shipper_company_name]" id="shipper_company_name" class="form-control" value="@if(!empty($settings['shipper_company_name'])){{$settings['shipper_company_name']}}@endif">
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label" for="shipper_street">Street</label>
                  <div class="controls">
                      <input type="text" name="settings[shipper_street]" id="shipper_street" class="form-control" value="@if(!empty($settings['shipper_street'])){{$settings['shipper_street']}}@endif">
                  </div>
              </div>

              <div class="form-group">
                  <label class="control-label" for="shipper_city">City</label>
                  <div class="controls">
                      <input type="text" name="settings[shipper_city]" id="shipper_city" class="form-control" value="@if(!empty($settings['shipper_city'])){{$settings['shipper_city']}}@endif">
                  </div>
              </div>

              <div class="form-group">
                  <label class="control-label" for="shipper_state">State</label>
                  <div class="controls">
                      <input type="text" name="settings[shipper_state]" id="shipper_state" class="form-control" value="@if(!empty($settings['shipper_state'])){{$settings['shipper_state']}}@endif">
                  </div>
              </div>

              <div class="form-group">
                  <label class="control-label" for="shipper_country_code">Country (3 char code)</label>
                  <div class="controls">
                      <input type="text" name="settings[shipper_country_code]" id="shipper_country_code" class="form-control" value="@if(!empty($settings['shipper_country_code'])){{$settings['shipper_country_code']}}@endif">
                  </div>
              </div>

              <div class="form-group">
                  <label class="control-label" for="shipper_phone">Phone</label>
                  <div class="controls">
                      <input type="text" name="settings[shipper_phone]" id="shipper_phone" class="form-control" value="@if(!empty($settings['shipper_phone'])){{$settings['shipper_phone']}}@endif">
                  </div>
              </div>

              <div class="form-group">
                  <label class="control-label" for="shipper_email">Email</label>
                  <div class="controls">
                      <input type="text" name="settings[shipper_email]" id="shipper_email" class="form-control" value="@if(!empty($settings['shipper_email'])){{$settings['shipper_email']}}@endif">
                  </div>
              </div>

              <div class="form-group">
                  <label class="control-label" for="shipper_address_type">Address Type</label>
                  <div class="controls">
                      <input type="text" name="settings[shipper_address_type]" id="shipper_address_type" class="form-control" value="@if(!empty($settings['shipper_address_type'])){{$settings['shipper_address_type']}}@endif">
                  </div>
              </div>



            </div>




            <div class='col-md-12'>
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

  <style>
    .shipping_form{
      display: none;
    }
  </style>

  <script>
    $(document).on("change",".shipping_method",function(e){
      shipping_method();
    });

    function shipping_method(){
      var shipping_method = $(".shipping_method:checked").val();
      if(shipping_method == 'hk_post'){
        $(".shipping_form").css('display','none');
        $(".shipping_hk_post").css('display','block');
      }else if(shipping_method == 'custom'){
        $(".shipping_form").css('display','none');
        $(".shipping_custom").css('display','block');
      }else{
        $(".shipping_form").css('display','none');
      }
    }

    shipping_method();
  </script>
@endsection

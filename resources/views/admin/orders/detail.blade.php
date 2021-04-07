@extends('admin.layouts.app')
  @section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{__('Order')}}
        <small>{{__('Detail')}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('admin/orders')}}">Orders</a></li>
        <li>Detail</li>
      </ol>
    </section>

    <section class="page-content">
			<div class="cart-section p-3 clearfix">
				<div class="container-fluid">
          <div class="row">
            <div class="col-md-2"></div>
  					<div class="col-md-8">
              <div class="row">
                <div class="col-md-4">
                  <div class="panel panel-default">
                    <div class='panel-heading'>Order Detail</div>
                    <div class="panel-body">
                      <p class="card-text">Order # {{$order->order_ref}}</p>
                      <p class="card-text">Shipping: {{getShippingLabel($order->shipping_type)}}</p>
                      <!--<p class="card-text">Tracking Code: {{$order->shipping_tracking_code}} <a href="https://www.hongkongpost.hk/en/mail_tracking/" target="_blank">Track  Parcel</a></p>-->
                      <p class="card-text">Date: {{$order->created_at->format('d M Y')}}</p>
                    </div>
                  </div>
                </div>
              <div class="col-md-4">
                  <div class="panel panel-default">
                    <div class='panel-heading'>Billing Address</div>
                    <div class="panel-body">
                      <p class="card-text">{{$order->billing_first_name}} {{$order->billing_last_name}}</p>
                      <p class="card-text">{{$order->billing_email}}, {{$order->billing_phone}}</p>
                      <p class="card-text">{{$order->billing_address}}, {{$order->billing_city}} - {{$order->billing_post_code}}, {{$order->billing_country}}</p>
                    </div>
                  </div>
              </div>
              <div class="col-md-4">
                <div class="panel panel-default">
                  <div class='panel-heading'>Shipping Address</div>
                  <div class="panel-body">
                    <p class="card-text">{{$order->shipping_first_name}} {{$order->shipping_last_name}}</p>
                    <p class="card-text">{{$order->shipping_email}}, {{$order->shipping_phone}}</p>
                    <p class="card-text">{{$order->shipping_address}}, {{$order->shipping_city}} - {{$order->shipping_post_code}}, {{$order->shipping_country}}</p>
                  </div>
                </div>
              </div>
            </div>
              <div class="clearfix"></div>
  						<table class="table table-bordered" style="margin-top:20px;">
                <thead>
    							<tr>
    								<th>Product</th>
    								<th class="text-right">Price</th>
    								<th class="text-right">Qty.</th>
    								<th class="text-right">Total</th>
    							</tr>
                </thead>
                <tbody>
                  @foreach($items as $row)
    							<tr class="item-row">
    								<td>
    									<p> <strong><a href="{{url('product/'.$row->product->slug)}}">{{$row->product->name}}</a></strong></p>
												@if($row->addon_products)
													Eye Lashes:
													@php $i=1; @endphp
													@php $addon_products = explode(",",$row->addon_products); @endphp
													@foreach($addon_products as $addon_prod)
														<p style='margin-bottom:2px;'>
															<a href="{{url('product/'.getProduct($addon_prod)->slug)}}">
																{{"[$i] ".getProduct($addon_prod)->name}}
															</a>
														</p>
														@php $i++; @endphp
													@endforeach
												@endif
    								</td>
    								<td class="text-right">{{$row->unit_price}}</td>
    								<td class="text-right">
    									{{$row->qty}}
    								</td>
    								<td class="text-right">{{$row->item_total_price}}</td>
    								</td>
    							</tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <td></td><td></td>
                    <td class="text-right">Sub-Total</td>
                    <td class="text-right">{{$order->subtotal}}</td>
                  </tr>
                  <tr>
                    <td style="border-top:0px;"></td><td style="border-top:0px;"></td>
                    <td class="text-right">Discount</td>
                    <td class="text-right">{{$order->discount}}</td>
                  </tr>
                  <tr>
                    <td style="border-top:0px;"></td><td style="border-top:0px;"></td>
                    <td class="text-right">Shipping</td>
                    <td class="text-right">{{$order->shipping}}</td>
                  </tr>
                  <tr>
                    <td style="border-top:0px;"></td><td style="border-top:0px;"></td>
                    <td class="text-right">Total</td>
                    <td class="text-right">{{$order->total}}</td>
                  </tr>
                </tfoot>
  						</table>

  					</div>
          </div>

				</div>
			</div>
        </section>


@endsection

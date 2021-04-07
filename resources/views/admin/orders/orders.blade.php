@extends('admin.layouts.app')
  @section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{__('Orders')}}
        <small>{{__('List')}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Orders</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="panel panel-success">
        <div class="panel-body">

          <table class="table table-striped table-bordered table-hover display responsive nowrap dataTable" id="sample_1">
            <thead>
            <tr>
              <th>Order#</th>
              <th>Customer</th>
              <th>Total Price</th>
              <th>Date</th>
              <th>Status</th>
              <th>Tracking Code</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($orders as $row)
            <tr class="item-row">
              <td>{{$row->order_ref}}</td>
              <td>{{$row->user->first_name}} {{$row->user->last_name}}<br />
                  {{$row->user->email}}
              </td>
              <td>{{$row->total}}</td>
              <td>{{$row->created_at->format('d M Y h:i A')}}</td>

              <td>
                @if($row->payment_status == 1)
                  <span class="label label-success">PAID</span>
                @endif
              </td>
              <td>{{$row->shipping_tracking_code}}</td>
              <td>
                <a class="btn btn-info" href='{{url('admin/orders/detail/'.$row->id)}}'>
                  Detail
                </a>
                @if($row->shipping_tracking_code)
                <a  target="_blank" href='{{$row->shipping_label_file}}' title='Shipping Label PDF'>
                  <img src="{{asset('images/hkpost.png')}}" style="width:75px; border-radius:5px; margin-left:10px; border:1px solid #000;" />
                </a>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
          </table>

		</div>
    </div>
</section>


@endsection

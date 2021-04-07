@extends('admin.layouts.app')
  @section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{__('Product Categories')}}
        <small>{{__('List')}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Product Categories</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="panel panel-success">
        <div class="panel-body">
          <a class="btn btn-success pull-right" href="{{url('admin/product-categories/create')}}">Create Category</a>
          <div class="clearfix"></div>

				<table class="table table-striped table-bordered table-hover display responsive nowrap dataTable" id="sample_1" width="100%">
					<thead>
						<tr>
              <th width="70">{{__('Image')}}</th>
							<th>{{__('Name')}}</th>
							<th>{{__('Status')}}</th>
							<th width="60">{{__('Action')}}</th>
						</tr>
					</thead>
					<tbody>
						@foreach($categories as $category)
						<tr>
              <td>
                <a href="{{url('uploads/product_categories/'.$category->image)}}" class="fancybox">
                  <img src="{{url('uploads/product_categories/thumbs/'.$category->image)}}" style="width:60px;" />
                </a>
              </td>
							<td>{{ $category->name }}</td>
							<td>@if($category->status) <span class="label label-success">{{__('Enabled')}}</span> @else <span class="label label-danger">{{__('Disabled')}}</span>@endif</td>
							<td>
								<div class="dropdown">
										<button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
										   {{__('Action')}}
										   <span class="caret"></span>
										</button>
										<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
											<li>
												<a href="{{route('product-categories.edit', $category->id)}}">{{__('Edit')}}</a>
											</li>
											<li>
												<a href="{{route('product-categories.destroy', $category->id)}}" class="deleteConfirm">{{__('Delete')}}</a>
											</li>

										</ul>
									</div>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>

		</div>
    </div>
</section>


@endsection

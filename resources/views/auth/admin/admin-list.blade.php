@extends('admin.layouts.app')
  @section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{__('Users')}}
        <small>{{__('List')}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>User List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="panel panel-success">
        <div class="panel-body">

          <div class="clearfix"></div>
								<table class="table table-striped table-bordered table-hover display responsive nowrap dataTable" id="sample_1" width="100%">
									<thead>
										<tr>
											<th style="width:8px;">ID</th>
											<th>@lang('common.name')</th>
											<th class="hidden-480"><?php echo 'Email'; ?></th>
											<th>{{__('Total Orders')}}</th>
											<th>{{__('Create Date')}}</th>
											<th style="width:60px;">@lang('common.action')</th>
										</tr>
									</thead>

									<tbody>
										@foreach($user_list as $user)
											<tr class="odd gradeX">
												<td>{{ $user->id }}</td>
												<td>
													{{ $user->first_name }} {{ $user->last_name?$user->last_name:'' }}
												</td>
												<td class="hidden-480">
													{{ $user->email }}
												</td>
												<td class="hidden-480">
													{{ $user->orders->count() }}
												</td>
											   <td>
													{{$user->created_at->format('d M Y')}}
												</td>
												<td>
													<div class="dropdown">
														<button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
														@lang('common.action')
														<span class="caret"></span>
														</button>
														<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
															<li><a href="{{ url('admin/user-delete/'.$user->id) }}" class="delete confirm">@lang('common.delete')</a></li>
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

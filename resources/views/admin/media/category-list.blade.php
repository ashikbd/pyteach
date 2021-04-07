@extends('admin.layouts.app')
  @section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{__('Categories')}}
        <small>{{__('List')}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Media Category</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="panel panel-success">
        <div class="panel-body">
          <a class="btn btn-success pull-right" href="{{url('admin/media_categories/create')}}">Create Category</a>
          <br /><br />
          <div class="clearfix"></div>

                  @if (count($category_list) > 0)
                  <table class="table table-bordered table-hover DataTable" id="category_list1">
                    <thead>
                    <tr>
                      <th>S/N</th>
                      <th>Category Name</th>
                      <th>Alias</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($category_list as $key => $category)
                    <tr row_id="{{ $category['id'] }}">
                      <td>{{ $category['id'] }}</td>
                      <td>{{ $category['name'] }}</td>
                      <td>{{ $category['alias'] }}</td>
                      <td>
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Action
                            <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu " aria-labelledby="dropdownMenu1">
                                <li><a href="{{ URL('admin/media_categories/'.$category['id'].'/edit') }}">Edit</a></li>
                                <li><a href="{{ URL('admin/media_categories/destroy') }}" data-id="{{ $category['id'] }}" class="delete_confirm">Delete</a></li>
                            </ul>
                        </div>
                    </td>
                    </tr>
                    @endforeach
                    </tbody>

                  </table>
                  @else
                  <p>No Record found</p>
                  @endif
                </div>
                </div>
            </section>

    <script type="text/javascript">

       $(document).ready(function(){
           $('#category_list1').dataTable({
               responsive: true,
           });
       });


    </script>
  </div>
@endsection

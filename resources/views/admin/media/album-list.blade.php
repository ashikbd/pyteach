@extends('admin.layouts.app')
  @section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{__('Album')}}
        <small>{{__('List')}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Media Album</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="panel panel-success">
        <div class="panel-body">
          <a class="btn btn-success pull-right" href="{{url('admin/media_albums/create')}}">Create Album</a>
          <br /><br />
          <div class="clearfix"></div>

                  @if (count($album_list) > 0)
                  <table class="table table-bordered table-hover DataTable" id="album_list">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>Album Name</th>
                      <th>Category Name</th>
                      <th>Alias</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($album_list as $key => $album)
                    <tr row_id="{{ $album['id'] }}">
                      <td>{{ $album['id'] }}</td>
                      <td>{{ $album['name'] }}</td>
                      <td>{{ $album->category->name }}</td>
                      <td>{{ $album['alias'] }}</td>
                      <td>
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Action
                            <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu " aria-labelledby="dropdownMenu1">
                                <li><a href="{{ URL('admin/media_albums/'.$album['id'].'/edit') }}">Edit</a></li>
                                <li><a href="{{ URL('admin/media_albums/destroy') }}" data-id="{{ $album['id'] }}" class="delete_confirm">Delete</a></li>
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
           $('#album_list').dataTable({
               responsive: true,
           });
       });


    </script>
  </div>
@endsection

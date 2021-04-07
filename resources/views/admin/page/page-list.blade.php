@extends('admin.layouts.app')
  @section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{__('Pages')}}
        <small>{{__('List')}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Pages</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="panel panel-success">
        <div class="panel-body">
          <a class="btn btn-success pull-right" href="{{url('admin/pages/create')}}">Create Page</a>
          <br /><br />
          <div class="clearfix"></div>

            <table class="table table-bordered table-hover DataTable">
              <thead>
              <tr>
                <th>S/N</th>
                <th>Title</th>
                <th>Alias</th>
                <th>Category</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                  @foreach($page_list as $page)
              <tr>
                <td>{{ $page['id'] }}</td>
                <td>
                  {{ $page->title }}
                </td>
                <td>
                  {{ $page->alias }}
                </td>
                <td>{{ $page->categoryDetail['category_name'] }}</td>
                <td>
                  <div class="dropdown">
                      <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      Action
                      <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu " aria-labelledby="dropdownMenu1">
                          <li><a href="{{ URL('page/'.$page['alias']) }} " target="_blank">View</a></li>
                          <li><a href="{{ URL('admin/pages/'.$page['id'].'/edit') }} ">Edit</a></li>
                          <li><a href="#" onclick="delete_page('{{ $page['id'] }}')">Delete</a></li>
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
<script>
  function delete_page(page_id){
    swal({
      title: "Are you sure?",
      text: "You will not be able to recover this page!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false,
      html: false
    }, function(){
        $.ajax({
          data:{id: page_id },
          url: '{{url("admin/pages/destroy")}}',
          type: "DELETE",
          success: function(results){
            swal({
              title: "Page successfully deleted!",
              type: "success",
              text: ""
            }, function(){
              location.reload();
            });

          },
          error: function(err){
            console.log("error occur");
            console.log(err);
          }
        });
    });
  }


 $(document).ready(function(){
   $('.DataTable').dataTable({
      responsive:true
    });
 });

</script>
@endsection

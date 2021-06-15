@extends('admin.layouts.app')
  @section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{__('Topic Learning Section')}}
        <small>{{__('List')}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="{{url('admin/learning')}}"> Topic List</a></li>
        <li>Learning Section</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="panel panel-success">
        <div class="panel-body">
          <a class="btn btn-success pull-right" href="{{url('admin/learning/topic_learning_add/'.$id)}}">Create Learning Content</a>
          <br /><br />
          <div class="clearfix"></div>

            <table class="table table-bordered table-hover DataTable">
              <thead>
              <tr>
                <th>S/N</th>
                <th width="50%">Title</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @yield($i=1)
                  @foreach($learning as $row)
              <tr>
                <td>{{ $i++ }}</td>
                <td>
                  {{ $row->title }}
                </td>
                <td>
                  @if($row->status)
                        <span class="label label-success">Enabled</span>
                  @else
                        <span class="label label-danger">Disabled</span>
                  @endif
                </td>
                <td>
                    <a href="{{ URL('admin/learning/topic_learning_edit/'.$row['id']) }}" class="btn btn-success">Edit</a>
                    <a href="#" onclick="delete_page('{{ $row['id'] }}')" class="btn btn-danger">Delete</a>
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
          url: '{{url("admin/learning/topic_learning_delete")}}',
          type: "post",
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

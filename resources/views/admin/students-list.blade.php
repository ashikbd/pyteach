@extends('admin.layouts.app')
  @section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{__('Registered Students')}}
        <small>{{__('List')}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Students</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="panel panel-success">
        <div class="panel-body">
          <div class="clearfix"></div>

            <table class="table table-bordered table-hover DataTable">
              <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                  <th>DOB</th>
                  <th>Registration Date</th>
                <th>Status</th>
              </tr>
              </thead>
              <tbody>

                  @foreach($students as $row)
              <tr>
                <td>{{ $row->firstName }} {{ $row->lastName }}</td>
                <td>
                  {{ $row->email }}
                </td>
                  <td>
                      {{ $row->dateOfBirth }}
                  </td>
                  <td>
                      {{ $row->created_at }}
                  </td>
                <td>
                  @if($row->status)
                        <span class="label label-success">Enabled</span>
                  @else
                        <span class="label label-danger">Disabled</span>
                  @endif
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

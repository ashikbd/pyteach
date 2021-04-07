@extends('admin.layouts.app')
  @section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{__('Album')}}
        <small>{{__('Create')}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('media_albums.index')}}"> Media Albums</a></li>
        <li class="active">Create</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="panel panel-success">
        @if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

                <form method="POST" action="{{ URL('admin/media_albums') }}">
                  {{ csrf_field() }}
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Album Name</label>
                      <input class="form-control" required type="text" placeholder="Album Name" name="name" value="{{ old('name') }}">

                    </div>
                    <div class="form-group">
                      <label>Album Alias (Unique. without space)</label>
                      <input class="form-control" required type="text" placeholder="Album Alias" name="alias" value="{{ old('alias') }}">
                    </div>

                    <div class="form-group">
                      <label>Category</label>
                      <select name="cat_id" class="form-control" required>
                        <option value="">---</option>
                        @foreach($categories as $category)
                          <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                        @endforeach
                      </select>
                    </div>


                    <div class="form-group">
                      <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
                </form>
              </div>
          </section>

@endsection

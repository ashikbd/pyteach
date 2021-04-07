@include('admin.layouts.header')

@if (Route::has('login'))

    @auth
        @include('admin.layouts.logged_in_header')
        @include('admin.layouts.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          @if (session('success'))
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  {{ session('success') }}
              </div>
          @endif
        @yield('content')
        </div>
       	@include('admin.layouts.logged_in_footer')
    @else
        @yield('content')
    @endauth

@endif

@include('admin.layouts.footer')

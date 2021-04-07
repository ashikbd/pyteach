<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <i class="fa fa-user fa-3x" aria-hidden="true" style="color: #fff"></i>

        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="@if(Request::url() == url('admin/dashboard')) active @endif">
          <a href="{{ url('admin/dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>

        </li>

        <li class="treeview @if(Request::is('admin/learning*')) active @endif">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Learning Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@if(Request::url() == url('admin/learning')) active @endif"><a href="{{ url('admin/learning') }}"><i class="fa fa-circle-o"></i> Learning Management</a></li>
          </ul>
        </li>

        <li class="treeview @if(Request::is('admin/students*')) active @endif">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Student Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@if(Request::is('admin/students*')) active @endif"><a href="{{ url('admin/students') }}"><i class="fa fa-circle-o"></i> Student Management</a></li>
          </ul>
        </li>

        <li class="treeview @if(Request::is('admin/parents*')) active @endif">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Parent Manager</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@if(Request::is('admin/parents')) active @endif"><a href="{{ url('admin/parents') }}"><i class="fa fa-circle-o"></i> Parent Management</a></li>
          </ul>
        </li>




        <li class="treeview @if(Request::is('admin/settings/*')) active @endif">
          <a href="#">
            <i class="fa fa-cogs"></i>
            <span>Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

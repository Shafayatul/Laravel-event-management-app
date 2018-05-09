<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="{!! asset('dist/img/avatar.png" class="img-circle" alt="Us') !!}er Image">
    </div>
    <div class="pull-left info">
      <p>{{Auth::user()->name}}</p>
      <a href-nt="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div>

  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li>
      <a href="{{url("/")}}">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
      </a>
    </li>
{{--     <li class="treeview">
      <a href="#">
        <i class="fa fa-address-book"></i>
        <span>Delegate</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="{!! route('delegates.create') !!}"><i class="fa fa-plus"></i> Add Delegate</a></li>
        <li><a href="{!! route('delegates.index') !!}"><i class="fa fa-list"></i> Delegate List</a></li>
      </ul>
    </li> --}}
    @if($is_super_admin)
    <li class="treeview">
      <a href="#">
        <i class="fa fa-calendar"></i>
        <span>Event</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="{!! route('events.create') !!}"><i class="fa fa-plus"></i> Add Event</a></li>
        <li><a href="{!! route('events.index') !!}"><i class="fa fa-list"></i> Event List</a></li>
      </ul>
    </li>    
    <li class="treeview">
      <a href="#">
        <i class="fa fa-user-secret"></i> 
        <span>Admin</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="{!! route('register') !!}"><i class="fa fa-plus"></i> Add Admin</a></li>
        <li><a href="{{url("/users/")}}"><i class="fa fa-list"></i> Admin List</a></li>
      </ul>
    </li>
    @endif
  </ul>
</section>
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
      <a href="{{url('/')}}">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
      </a>
    </li>
    <li>
      <a href="{{url('/bookings/add/'.$event_id)}}">
        <i class="fa fa-plus"></i> <span>Add Delegate</span>
      </a>
    </li>

    <li class="treeview">
      <a href="#">
        <i class="fa fa-address-book"></i>
        <span>Greet Delegates</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{url('/bookings/bookingList/'.$event_id)}}"><i class="fa fa-plus"></i> Check In</a></li>
        <li><a href="{{url('/bookings/history/'.$event_id)}}"><i class="fa fa-list"></i> History</a></li>
        {{-- <li><a href="{{url('/events/stat/'.$event_id)}}"><i class="fa fa-list"></i> Stat</a></li> --}}
      </ul>
    </li>

    <li class="treeview">
      <a href="#">
        <i class="fa fa-ticket"></i>
        <span>Pass</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="{!! url('passes/create/'.$event_id) !!}"><i class="fa fa-plus"></i> Add Pass</a></li>
        <li><a href="{!! url('passes/show-pass-list/'.$event_id) !!}"><i class="fa fa-list"></i> Pass list</a></li>
      </ul>
    </li>

  </ul>
</section>
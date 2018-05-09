@extends('layouts.default')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Version 2.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href-nt="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Main row -->
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Event List:</h3>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($events as $event)
                  <tr id="row-{{$event->id}}">
                    <td>{{$event->id}}</td>
                    <td>{{$event->name}}</td>
                    <td>{{$event->start_date}} - {{$event->start_time}}</td>
                    <td>{{$event->end_date}} - {{$event->end_time}}</td>
                    <td>
                      <a class="btn btn-social btn-dropbox" href="{{url('/bookings/bookingList/'.$event->id)}}">
                        <i class="fa fa-tasks"></i> Manage
                      </a>                  
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
    <!-- /.content -->
@stop

@section('footer-script')
  <script>
    $(function () {
      $('#example1').DataTable();
    })
  </script>
@stop
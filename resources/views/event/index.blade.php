@extends('layouts.default')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Events
  </h1>
  <ol class="breadcrumb">
    <li><a href-nt="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Event List</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <!-- Main row -->
  <div class="row">
    <!-- Left col -->
    <div class="col-md-12">


      <!-- TABLE: LATEST ORDERS -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Events:</h3>
        </div>
        <div class="box-body table-responsive">
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
                  <a class="btn btn-social btn-github" href="{{ url('/events/asign/'.$event->id) }}">
                    <i class="fa fa-id-badge"></i> Admin
                  </a>
                  <a class="btn btn-social btn-dropbox" href="{!! route('events.edit', ['id' => $event->id]) !!}">
                    <i class="fa fa-edit"></i> Edit
                  </a>                  
                  <a class="btn btn-social btn-google event-delete" id="{{$event->id}}">
                    <i class="fa fa-trash-o fa-lg"></i> Delete
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
   <!-- /.box -->
 </div>
 <!-- /.col -->
</div>
<!-- /.row -->
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
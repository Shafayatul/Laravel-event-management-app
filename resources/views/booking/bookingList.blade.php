@extends('layouts.default2')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Booking
      </h1>
      <ol class="breadcrumb">
        <li><a href-nt="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Booking List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-address-book"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Delegates</span>
              <span class="info-box-number">{{$total_delegates}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-check-square"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Delegates Sign In</span>
              <span class="info-box-number" id="delegates_sign_in">{{$delegates_sign_in}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-envelope"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pending Delegate</span>
              <span class="info-box-number" id="delegates_pending">{{$pending_delegates}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-plus"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Add New Delegates</span>
              <span class="info-box-number">
                <a href="{{url('bookings/add/'.$event_id)}}">
                  <button type="button" class="btn bg-orange btn-flat margin">Add New</button>
                </a>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Booking List:</h3>
            </div>
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Delegate Name</th>
                    <th>Delegate Email</th>
                    <th>Type</th>
                    <th>Pass</th>
                    <th>Source</th>
                    <th>Reference</th>
                    <th>Hotel</th>
                    <th>Quantity</th>
                    <th>Action</th>
                  </tr>
                </thead>
                  <tbody>
                    @foreach($bookings as $booking)
                     <tr id="row-{{$booking->id}}">
                       <td>{{$booking->id}}</td>
                       <td>{{$booking->delegate_name}}</td>
                       <td>{{$booking->delegate_email}}</td>
                       <td>{{$booking->delegate_type}}</td>
                       <td>
                        @foreach($passes as $pass)
                          @if($booking->pass_id == $pass->id)
                            <em class="pass_swatch" style="background-color:{{$pass->color_code}}" data-toggle="tooltip" title="{{$pass->color_name}}" data-placement="left"></em> {{$pass->color_name}} -  &pound;{{$pass->price}}
                          @endif
                        @endforeach
                       </td>
                        <td>{{$booking->purchase_source}}</td>
                        <td>{{$booking->purchase_reference}}</td>
                        <td>{{$booking->hotel}}</td>
                        <td>{{$booking->Quantity}}</td>                       
                       <td id="action-{{$booking->id}}" class="text-center">
                        @if($booking->is_checked_in == 1)
                          <span class="label label-success">Checked In</span><br><br>
                          <a class="btn btn-social btn-google check-out" id="{{$booking->id}}">
                            <i class="fa fa-close"></i> Check Out
                          </a>                          
                        @else
                          <a class="btn btn-social btn-dropbox check-in" id="{{$booking->id}}">
                            <i class="fa fa-check-square"></i> Check IN
                          </a>
                        @endif
                        <br><br>
                          <a class="btn btn-social btn-tumblr" href="{!! url('bookings/edit/'.$booking->id.'/'.$event_id) !!}">
                            <i class="fa fa-check-square"></i> Edit
                          </a>                        
                      </td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Delegate Name</th>
                    <th>Delegate Email</th>
                    <th>Type</th>
                    <th>Pass</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
              </table>
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
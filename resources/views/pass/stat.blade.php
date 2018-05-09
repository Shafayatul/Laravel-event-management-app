@extends('layouts.default2')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Stat
      </h1>
      <ol class="breadcrumb">
        <li><a href-nt="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Customer Stat</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-12">


          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">All Stat</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th> Event </th>
                    <th> Pass </th>
                    <th> Purchase Source </th>
                    <th> Purchase Reference </th>
                    <th> Hotel </th>
                    <th> Quantity </th>
                    <th> Checked In </th>
                  </tr>
                  </thead>
                  <tbody>
                  	@foreach($bookings as $booking)

                      @foreach($passes as $pass)
                        @if($booking->pass_id == $pass->id)
                          @php
                          $pass_data = '<em class="pass_swatch" style="background-color:'.$pass->color_code.'" data-toggle="tooltip" title="'.$pass->color_name.'" data-placement="left"></em> '.$pass->color_name.' -  &pound;'.$pass->price;
                          $event_id = $pass->event_id;
                          @endphp
                        @endif
                      @endforeach

                      @foreach($events as $event)
                        @if($booking->event_id == $event->id)
                          @php
                            $event_data = $event->name.' ['.$event->start_date.' - '.$event->start_time.']';
                          @endphp
                        @endif
                      @endforeach

                   <tr>
                    <td>{!! $event_data !!}</td>
                    <td>{!! $pass_data !!}</td>
                    <td>{{ $booking->purchase_source }}</td>
                    <td>{{ $booking->purchase_reference }}</td>
                    <td>{{ $booking->hotel }}</td>
                    <td>{{ $booking->Quantity }}</td>
                    <td>
                      @if($booking->is_checked_in == 1)
                        Yes
                      @else
                        No
                      @endif
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                </table>
              </div>
                <!-- /.table-responsive -->
              <div class="text-center">
                {!! $bookings->links(); !!}
              </div>

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
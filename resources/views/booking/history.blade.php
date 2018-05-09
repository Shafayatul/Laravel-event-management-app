@extends('layouts.default2')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        History
      </h1>
      <ol class="breadcrumb">
        <li><a href-nt="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">History</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">


      <!-- Main row -->
      <div class="row">



        <div class="col-md-4">
          <!-- Line chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">Check In By Delegate Type</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div id="bar-chart2" style="height: 300px;"></div>
            </div>
            <!-- /.box-body-->
          </div>

        </div>
        <!-- /.col -->

        <div class="col-md-4">
          <!-- Bar chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">Check In By Admin/stuff</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div id="bar-chart" style="height: 300px;"></div>
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4">
          <!-- Bar chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">Booking By Pass Type</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div id="bar-chart3" style="height: 300px;"></div>
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->








      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">History:</h3>
            </div>
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Check In time</th>
                    <th>Delegate</th>
                    <th>Type</th>
                    <th>Pass</th>
                    <th>Checked By</th>
                  </tr>
                </thead>
                  <tbody>
                    @foreach($bookings as $booking)
                     <tr>
                       <td>
                          @if($booking->is_checked_in == 1)
                            {{$booking->updated_at}}
                          @else
                            Pending
                          @endif
                        </td>
                       <td>{{$booking->delegate_name}}</td>
                       <td>{{$booking->delegate_type}}</td>
                       <td>
                        @foreach($passes as $pass)
                          @if($booking->pass_id == $pass->id)
                            <em class="pass_swatch" style="background-color:{{$pass->color_code}}" data-toggle="tooltip" title="{{$pass->color_name}}" data-placement="left"></em> {{$pass->color_name}} -  &pound;{{$pass->price}}
                          @endif
                        @endforeach
                       </td>
                        <td>
                          @if($booking->is_checked_in == 1)
                            {{$booking->checked_in_by}}
                          @else
                            Pending
                          @endif
                        </td>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>Check In time</th>
                    <th>Delegate</th>
                    <th>Type</th>
                    <th>Pass</th>
                    <th>Checked By</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <input type="hidden" id="admin_check_in_array" value="{{ $admin_check_in_array2 }}">
    <input type="hidden" id="delecate_type_array" value="{{ $delecate_type_array2 }}">
    <input type="hidden" id="pass_type_array" value="{{ $pass_type_array2 }}">
@stop

@section('footer-script')
  <script>
    $(function () {
      $('#example1').DataTable();
    })
  </script>

  <!-- FastClick -->
  <script src="{!! asset('bower_components/fastclick/lib/fastclick.js') !!}"></script>
  <!-- AdminLTE App -->
  <script src="{!! asset('dist/js/adminlte.min.js') !!}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{!! asset('dist/js/demo.js') !!}"></script>
  <!-- FLOT CHARTS -->
  <script src="{!! asset('bower_components/Flot/jquery.flot.js') !!}"></script>
  <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
  <script src="{!! asset('bower_components/Flot/jquery.flot.resize.js') !!}"></script>
  <!-- FLOT PIE PLUGIN - also used to draw donut charts -->
  <script src="{!! asset('bower_components/Flot/jquery.flot.pie.js') !!}"></script>
  <!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
  <script src="{!! asset('bower_components/Flot/jquery.flot.categories.js') !!}"></script>

  <script>
    $(function () {

      /*
       * Flot Interactive Chart
       * -----------------------
       */
      // We use an inline data source in the example, usually data would
      // be fetched from a server
      var data = [], totalPoints = 100

      function getRandomData() {

        if (data.length > 0)
          data = data.slice(1)

        // Do a random walk
        while (data.length < totalPoints) {

          var prev = data.length > 0 ? data[data.length - 1] : 50,
              y    = prev + Math.random() * 10 - 5

          if (y < 0) {
            y = 0
          } else if (y > 100) {
            y = 100
          }

          data.push(y)
        }

        // Zip the generated y values with the x values
        var res = []
        for (var i = 0; i < data.length; ++i) {
          res.push([i, data[i]])
        }

        return res
      }

      var interactive_plot = $.plot('#interactive', [getRandomData()], {
        grid  : {
          borderColor: '#f3f3f3',
          borderWidth: 1,
          tickColor  : '#f3f3f3'
        },
        series: {
          shadowSize: 0, // Drawing is faster without shadows
          color     : '#3c8dbc'
        },
        lines : {
          fill : true, //Converts the line chart to area chart
          color: '#3c8dbc'
        },
        yaxis : {
          min : 0,
          max : 100,
          show: true
        },
        xaxis : {
          show: true
        }
      })

      var updateInterval = 500 //Fetch data ever x milliseconds
      var realtime       = 'on' //If == to on then fetch data every x seconds. else stop fetching
      function update() {

        interactive_plot.setData([getRandomData()])

        // Since the axes don't change, we don't need to call plot.setupGrid()
        interactive_plot.draw()
        if (realtime === 'on')
          setTimeout(update, updateInterval)
      }

      //INITIALIZE REALTIME DATA FETCHING
      if (realtime === 'on') {
        update()
      }
      //REALTIME TOGGLE
      $('#realtime .btn').click(function () {
        if ($(this).data('toggle') === 'on') {
          realtime = 'on'
        }
        else {
          realtime = 'off'
        }
        update()
      })
      /*
       * END INTERACTIVE CHART
       */

      /*
       * LINE CHART
       * ----------
       */
      //LINE randomly generated data

      var sin = [], cos = []
      for (var i = 0; i < 14; i += 0.5) {
        sin.push([i, Math.sin(i)])
        cos.push([i, Math.cos(i)])
      }
      var line_data1 = {
        data : sin,
        color: '#3c8dbc'
      }
      var line_data2 = {
        data : cos,
        color: '#00c0ef'
      }
      $.plot('#line-chart', [line_data1, line_data2], {
        grid  : {
          hoverable  : true,
          borderColor: '#f3f3f3',
          borderWidth: 1,
          tickColor  : '#f3f3f3'
        },
        series: {
          shadowSize: 0,
          lines     : {
            show: true
          },
          points    : {
            show: true
          }
        },
        lines : {
          fill : false,
          color: ['#3c8dbc', '#f56954']
        },
        yaxis : {
          show: true
        },
        xaxis : {
          show: true
        }
      })
      //Initialize tooltip on hover
      $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
        position: 'absolute',
        display : 'none',
        opacity : 0.8
      }).appendTo('body')
      $('#line-chart').bind('plothover', function (event, pos, item) {

        if (item) {
          var x = item.datapoint[0].toFixed(2),
              y = item.datapoint[1].toFixed(2)

          $('#line-chart-tooltip').html(item.series.label + ' of ' + x + ' = ' + y)
            .css({ top: item.pageY + 5, left: item.pageX + 5 })
            .fadeIn(200)
        } else {
          $('#line-chart-tooltip').hide()
        }

      })
      /* END LINE CHART */

      /*
       * FULL WIDTH STATIC AREA CHART
       * -----------------
       */
      var areaData = [[2, 88.0], [3, 93.3], [4, 102.0], [5, 108.5], [6, 115.7], [7, 115.6],
        [8, 124.6], [9, 130.3], [10, 134.3], [11, 141.4], [12, 146.5], [13, 151.7], [14, 159.9],
        [15, 165.4], [16, 167.8], [17, 168.7], [18, 169.5], [19, 168.0]]
      $.plot('#area-chart', [areaData], {
        grid  : {
          borderWidth: 0
        },
        series: {
          shadowSize: 0, // Drawing is faster without shadows
          color     : '#00c0ef'
        },
        lines : {
          fill: true //Converts the line chart to area chart
        },
        yaxis : {
          show: false
        },
        xaxis : {
          show: false
        }
      })

      /* END AREA CHART */

      /*
       * BAR CHART
       * ---------
       */
      var bar_data = {
        // data : [['aa', 10], ['February', 8], ['March', 4], ['April', 13], ['May', 17], ['June', 9]],
        data : jQuery.parseJSON($('#delecate_type_array').val()),
        color: '#3c8dbc'
      }
      $.plot('#bar-chart2', [bar_data], {
        grid  : {
          borderWidth: 1,
          borderColor: '#f3f3f3',
          tickColor  : '#f3f3f3'
        },
        series: {
          bars: {
            show    : true,
            barWidth: 0.5,
            align   : 'center'
          }
        },
        xaxis : {
          mode      : 'categories',
          tickLength: 0
        }
      })
      /*
       * BAR CHART
       * ---------
       */
      var bar_data = {
        // data : [['aa', 10], ['February', 8], ['March', 4], ['April', 13], ['May', 17], ['June', 9]],
        data : jQuery.parseJSON($('#pass_type_array').val()),
        color: '#3c8dbc'
      }
      $.plot('#bar-chart3', [bar_data], {
        grid  : {
          borderWidth: 1,
          borderColor: '#f3f3f3',
          tickColor  : '#f3f3f3'
        },
        series: {
          bars: {
            show    : true,
            barWidth: 0.5,
            align   : 'center'
          }
        },
        xaxis : {
          mode      : 'categories',
          tickLength: 0
        }
      })
      /* END BAR CHART */
      /*
       * BAR CHART
       * ---------
       */
      var bar_data = {
        // data : [['aa', 10], ['February', 8], ['March', 4], ['April', 13], ['May', 17], ['June', 9]],
        data : jQuery.parseJSON($('#admin_check_in_array').val()),
        color: '#3c8dbc'
      }
      $.plot('#bar-chart', [bar_data], {
        grid  : {
          borderWidth: 1,
          borderColor: '#f3f3f3',
          tickColor  : '#f3f3f3'
        },
        series: {
          bars: {
            show    : true,
            barWidth: 0.5,
            align   : 'center'
          }
        },
        xaxis : {
          mode      : 'categories',
          tickLength: 0
        }
      })
      /* END BAR CHART */

      /*
       * DONUT CHART
       * -----------
       */

      var donutData = [
        { label: 'Series2', data: 30, color: '#3c8dbc' },
        { label: 'Series3', data: 20, color: '#0073b7' },
        { label: 'Series4', data: 50, color: '#00c0ef' }
      ]
      $.plot('#donut-chart', donutData, {
        series: {
          pie: {
            show       : true,
            radius     : 1,
            innerRadius: 0.5,
            label      : {
              show     : true,
              radius   : 2 / 3,
              formatter: labelFormatter,
              threshold: 0.1
            }

          }
        },
        legend: {
          show: false
        }
      })
      /*
       * END DONUT CHART
       */

    })

    /*
     * Custom Label formatter
     * ----------------------
     */
    function labelFormatter(label, series) {
      return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
        + label
        + '<br>'
        + Math.round(series.percent) + '%</div>'
    }
  </script>


@stop
@extends('layouts.default2')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Passes
      </h1>
      <ol class="breadcrumb">
        <li><a href-nt="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pass List</li>
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
              <h3 class="box-title">All Passes</h3>

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
                    <th>Name</th>
                    <th>Color</th>
                    <th>Price</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  	@foreach($passes as $pass)
                   <tr id="row-{{$pass->id}}">
                     <td>{{$pass->name}}</td>
                     <td><em class="pass_swatch" style="background-color:{{$pass->color_code}}" data-toggle="tooltip" title="{{$pass->color_name}}" data-placement="left"></em> {{$pass->color_name}}</td>
                     <td>{{$pass->price}}</td>
                     <td>
                      <a class="btn btn-social btn-dropbox" href="{!! url('/passes/edit/'.$pass->id.'/'.$event_id) !!}">
                        <i class="fa fa-check-square"></i> Edit
                      </a>
                      <a class="btn btn-social btn-google pass-delete" id="{{$pass->id}}">
                        <i class="fa fa-trash-o fa-lg"></i> Delete
                      </a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                </table>
              </div>
                <!-- /.table-responsive -->

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
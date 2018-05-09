@extends('layouts.default')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Delegates
      </h1>
      <ol class="breadcrumb">
        <li><a href-nt="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Delegate List</li>
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
              <h3 class="box-title">All Delegates</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              @if(Session::has('success'))
                <div class="alert alert-success fade in alert-dismissible" style="margin-top:18px;">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                  <strong>Success!</strong> {{ Session::get('success') }}
                </div>
              @endif

              @if(Session::has('error'))
                <div class="alert alert-danger fade in alert-dismissible" style="margin-top:18px;">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                  <strong>Error!</strong> {{ Session::get('error') }}
                </div>
              @endif  

              @if(count($errors)>0)
                <div class="alert alert-danger fade in alert-dismissible" style="margin-top:18px;">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                  <strong>Error!</strong> 
                  @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                  @endforeach
                </div>
              @endif

              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($delegates as $delegate)
                   <tr id="row-{{$delegate->id}}">
                     <td>{{$delegate->id}}</td>
                     <td>{{$delegate->name}}</td>
                     <td>{{$delegate->email}}</td>
                     <td>{{$delegate->type}}</td>
                     <td>
                      <a class="btn btn-social btn-dropbox get-delegate-id" data-toggle="modal" data-target="#myModal" id="{{$delegate->id}}">
                        <i class="fa fa-check-square"></i> Book
                      </a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                </table>
              </div>
                <!-- /.table-responsive -->
                {{-- Pagination --}}
              <div class="text-center">
                {!! $delegates->links(); !!}
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

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Booking</h4>
      </div>
      <div class="modal-body">
        

            {!! Form::open(["route"=>"bookings.store"]) !!}
                {{ Form::label('pass_id', 'Select Pass:') }}
                @foreach($passes as $pass)
                  <p>
                    {{ Form::radio('pass_id', $pass->id, null, array("class" => "form-group")) }} {{$pass->name.' -  &pound;'.$pass->price}}
                  </p>
                @endforeach

                <br>
                {{ Form::label('purchase_source', 'Purchase Source:') }}
                {{ Form::text('purchase_source', null, array("class" => "form-control")) }}

                {{ Form::label('purchase_reference', 'Purchase Reference:') }}
                {{ Form::text('purchase_reference', null, array("class" => "form-control")) }}

                {{ Form::label('hotel', 'Hotel:') }}
                {{ Form::text('hotel', null, array("class" => "form-control")) }}

                {{ Form::label('Quantity', 'Quantity:') }}
                {{ Form::number('Quantity', null, array("class" => "form-control")) }}

                <br>
                 
                {{ Form::checkbox('is_checked_in', 1) }}
                {{ Form::label('is_checked_in', 'Already Checked In') }}


                {{ Form::hidden('event_id', $event_id) }}
                {{ Form::hidden('delegate_id', null, array('id' => 'hidden_delegate_id')) }}

                {{ Form::submit('Save', array('class' => 'btn btn-lg btn-block btn-success form-margin model-submit')) }}

            {!! Form::close() !!}


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

@stop

@section('footer-script')

<script>
  $(function () {

    $('.get-delegate-id').click(function(){
      $('#hidden_delegate_id').val($(this).attr('id'));
    });
  });
</script>

@endsection
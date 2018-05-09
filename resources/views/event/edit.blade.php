@extends('layouts.default')

@section('header-script')
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{!! asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') !!}">
<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="{!! asset('plugins/timepicker/bootstrap-timepicker.min.css') !!}">
@endsection

@section('content')  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Event
      </h1>
      <ol class="breadcrumb">
        <li><a href-nt="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Event</li>
      </ol>
    </section>

	<section class="content">

		<div class="row">
			<div class="col-sm-8 col-sm-offset-2 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Edit Event</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<br />

						{{-- <div class="alert alert-success fade in alert-dismissible" style="margin-top:18px;">
						    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
						    <strong>Success!</strong> This alert box indicates a successful or positive action.
						</div> --}}

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

						{!! Form::model($event, ['method' => 'PUT','route' => ['events.update', $event->id]]) !!}
						    {{ Form::label('name', 'Name:') }}
						    {{ Form::text('name', null, array("class" => "form-control", "required" => "required")) }}

						    {{ Form::label('start_date', 'Start Date:') }}
						    {{ Form::text('start_date', null, array("class" => "form-control datepicker", "required" => "required")) }}
						    
						    <div class="bootstrap-timepicker">
						    {{ Form::label('start_time', 'Start Time:') }}
						    {{ Form::text('start_time', null, array("class" => "form-control timepicker", "required" => "required")) }}
							</div>


						    {{ Form::label('end_date', 'End Date:') }}
						    {{ Form::text('end_date', null, array("class" => "form-control datepicker", "required" => "required")) }}

						    <div class="bootstrap-timepicker">
						    {{ Form::label('end_time', 'End Time:') }}
						    {{ Form::text('end_time', null, array("class" => "form-control timepicker", "required" => "required")) }}
							</div>


						    {{ Form::submit('Save', array('class' => 'btn btn-lg btn-block btn-success form-margin')) }}

						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

@section('footer-script')
<!-- bootstrap datepicker -->
<script src="{!! asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') !!}"></script>
<!-- bootstrap time picker -->
<script src="{!! asset('plugins/timepicker/bootstrap-timepicker.min.js') !!}"></script>
<script>
	$(function () {
		//Date picker
		$('.datepicker').datepicker({
			autoclose: true
		});
		//Timepicker
		$('.timepicker').timepicker({
			showInputs: false
		});
	});
</script>
@endsection
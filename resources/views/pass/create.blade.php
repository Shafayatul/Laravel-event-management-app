@extends('layouts.default2')


@section('header-script')
	<!-- color Picker -->
	<link rel="stylesheet" href="{!! asset('bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') !!}">
@endsection



@section('content')  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{-- Add Pass --}}
      </h1>
      <ol class="breadcrumb">
        <li><a href-nt="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Pass</li>
      </ol>
    </section>

	<section class="content">

		<div class="row">
			<div class="col-sm-8 col-sm-offset-2 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Add Pass</h2>
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
							



						{!! Form::open(["route"=>"passes.store"]) !!}
						    {{ Form::label('name', 'Name:') }}
						    {{ Form::text('name', null, array("class" => "form-control", "required" => "required")) }}
						    
						    {{ Form::label('color_name', 'Pass colour/badge type:') }}
						    {{ Form::text('color_name', null, array("class" => "form-control", "required" => "required")) }}


						    {{ Form::label('color_code', 'Color Code:') }}
						    {{ Form::text('color_code', null, array("class" => "form-control my-colorpicker1", "required" => "required")) }}
						    
						    {{ Form::label('price', 'Price:') }}
						    {{ Form::text('price', null, array("class" => "form-control", "required" => "required")) }}

						    {{ Form::hidden('event_id', $event_id) }}

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
<script src="{!! asset('bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') !!}"></script>
<script>
	$(function () {
	    //Colorpicker
	    $('.my-colorpicker1').colorpicker();
	});
</script>
@endsection
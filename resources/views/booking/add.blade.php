@extends('layouts.default2')


@section('content')  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
            
      </h1>
      <ol class="breadcrumb">
        <li><a href-nt="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Delegate</li>
      </ol>
    </section>

	<section class="content">

		<div class="row">
			<div class="col-sm-8 col-sm-offset-2 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Add Delegate</h2>
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
							



						{!! Form::open(["route"=>"bookings.store"]) !!}
						    {{ Form::label('delegate_name', 'Name:') }}
						    {{ Form::text('delegate_name', null, array("class" => "form-control", "required" => "required")) }}

						    {{ Form::label('delegate_email', 'Email:') }}
						    {{ Form::text('delegate_email', null, array("class" => "form-control", "required" => "required")) }}
						    
						    <div class="bootstrap-timepicker">
						    {{ Form::label('delegate_type', 'Type:') }}
						    {{ Form::text('delegate_type', null, array("class" => "form-control",  "placeholder" => "E.g. Performer, Standard, Promoter etc")) }}
							</div>

						    {!! Form::label('pass_id', 'Select Pass:') !!}
						    {!! Form::select('pass_id', $passes, null, ['class' => 'form-control pass_change', "required" => "required"]) !!}

			                {{ Form::label('amount_paid', 'Amount Paid:') }}
			                {{ Form::number('amount_paid', null, array("class" => "form-control pass_amount", "required" => "required")) }}

			                {{ Form::label('purchase_source', 'Purchase Source:') }}
			                {{ Form::text('purchase_source', null, array("class" => "form-control")) }}

			                {{ Form::label('purchase_reference', 'Purchase Reference:') }}
			                {{ Form::text('purchase_reference', null, array("class" => "form-control")) }}

			                {{ Form::label('hotel', 'Hotel:') }}
			                {{ Form::text('hotel', null, array("class" => "form-control")) }}

			                {{ Form::label('Quantity', 'Quantity:') }}
			                {{ Form::number('Quantity', 1, array("class" => "form-control", "min" => "1", "required" => "required")) }}

			                <br>
			                 
			                {{ Form::checkbox('is_checked_in', 1) }}
			                {{ Form::label('is_checked_in', 'Already Checked In') }}


			                {{ Form::hidden('event_id', $event_id) }}
			                {{ Form::hidden('delegate_id', null, array('id' => 'hidden_delegate_id')) }}


						    {{ Form::submit('Add New Delegate', array('class' => 'btn btn-lg btn-block btn-success form-margin')) }}

						{!! Form::close() !!}

					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
@extends('layouts.default')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Users
      </h1>
      <ol class="breadcrumb">
        <li><a href-nt="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User List</li>
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
              <h3 class="box-title">All Users</h3>

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
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Staff Option</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  	@foreach($users as $user)
	                  <tr id="row-{{$user->id}}">
	                    <td>{{$user->id}}</td>
	                    <td>{{$user->name}}</td>
	                    <td>{{$user->email}}</td>
	                    <td>
							@if ($user->is_super_admin == 1)
							    Super Admin
							@else
							    Admin
							@endif
	                    </td>
	                    <td>
	                    	<a class="btn btn-social btn-twitter admin-status-change" id="{{$user->id}}" current-type="{{$user->is_super_admin}}">
				                <i class="fa fa-id-badge"></i> Change Account Type
				            </a>
				            
				            <a class="btn btn-social btn-google admin-delete" id="{{$user->id}}">
				                <i class="fa fa-trash-o fa-lg"></i> Delete
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
                {!! $users->links(); !!}
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
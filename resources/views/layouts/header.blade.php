  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Event Manager</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{!! asset('bower_components/bootstrap/dist/css/bootstrap.min.css') !!}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{!! asset('bower_components/font-awesome/css/font-awesome.min.css') !!}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{!! asset('bower_components/Ionicons/css/ionicons.min.css') !!}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{!! asset('bower_components/jvectormap/jquery-jvectormap.css') !!}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{!! asset('dist/css/AdminLTE.min.css') !!}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{!! asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') !!}">  
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{!! asset('dist/css/skins/_all-skins.min.css') !!}">

  <style>
    .form-margin{
      margin-top: 20px;
    }
    .pass_swatch {
      border: 1px solid #000;
      display: inline-block;
      height: 12px;
      margin-bottom: 3px;
      vertical-align: middle;
      width: 12px;
    }    
  </style>


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="{!! asset('https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js') !!}"></script>
  <script src="{!! asset('https://oss.maxcdn.com/respond/1.4.2/respond.min.js') !!}"></script>
  <![endif]-->

  @yield('header-script')

  <!-- Google Font -->
  <link rel="stylesheet" href="{!! asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic') !!}">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href-nt="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>{{Auth::user()->name}}</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Event</b>Manager</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href-nt="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href-nt="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{!! asset('dist/img/avatar.png" class="user-image" alt="Us') !!}er Image">
              <span class="hidden-xs">{{Auth::user()->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{!! asset('dist/img/avatar.png" class="img-circle" alt="Us') !!}er Image">
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{url('/users/resetPassword')}}" class="btn btn-default btn-flat">Change Password</a>
                </div>
                <div class="pull-right">
                  <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href-nt="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
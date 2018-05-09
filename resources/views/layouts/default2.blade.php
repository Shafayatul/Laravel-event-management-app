<!DOCTYPE html>
<html>
<head>
	@include('layouts.header')
</header>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
	@include('layouts.sidebar2')
<!-- /.sidebar -->
</aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  	@yield('content')
  </div>
  <!-- /.content-wrapper -->

  @include('layouts.footer')

</body>
</html>

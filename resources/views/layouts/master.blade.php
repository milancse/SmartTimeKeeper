<!doctype html>
<html>
<head>
@include('includes.head')
</head>
<body class="skin-blue">
	<header class="header"> @include('includes.header') </header>
	<!-- BEGAIN PRELOADER -->
	<div id="preloader" class="hide">
		<div id="status">&nbsp;</div>
	</div>
	<!-- END PRELOADER -->
	<div class="wrapper row-offcanvas row-offcanvas-left">
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="left-side sidebar-offcanvas">
			@include('includes.sidebar')
		</aside>
		<!-- Right side column. Contains the navbar and content of the page -->
		<aside class="right-side">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					@yield('page_head') <small>@yield('page_summery')</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Dashboard</li>
				</ol>
			</section>
			<!-- Main content -->
			<section class="content">
                	<?= Session::get('message')?>
                    @yield('content')
                </section>
			<!-- /.content -->
		</aside>
	</div>
	@include('includes.footer')
</body>
</html>

<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
	<!-- Sidebar user panel -->
	<div class="user-panel">
		<div class="pull-left image">
			<img src="{!! Session::get('profile_pic')!!}" class="img-circle" alt="User Image" />
		</div>
		<div class="pull-left info">
			<p>Hello, 
				@if(Session::has('first_name'))
					{!!Session::get('first_name')!!}
				@else
					Guest
				@endif
			</p>

			<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
		</div>
		@if(Session::get('in_time')==1)
		<div class="text-center">
		<a href="#"><button class="btn btn-md btn-danger" id="comment"><i class="fa fa-sign-in"></i> Punch In</button></a>
		</div>
		@endif
	</div>
	
	<!-- search form -->
	<!-- <form action="#" method="get" class="sidebar-form">
		<div class="input-group">
			<input type="text" name="q" class="form-control" placeholder="Search..."/>
			<span class="input-group-btn">
				<button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
			</span>
		</div>
	</form> -->
	<!-- /.search form -->
	<!-- sidebar menu: : style can be found in sidebar.less -->
	<ul class="sidebar-menu">
		<li>
			<a href="{!!URL::to('dashboard')!!}">
				<i class="fa fa-dashboard"></i> <span>Dashboard</span>
			</a>
		</li>
		@if((Auth::user()->role->name)=='admin')
		<li class="treeview">
			<a href="#">
				<i class="fa fa-clock-o"></i>
				<span>Attendance</span>
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li><a href="{!!URL::to('attendance')!!}"><i class="fa fa-angle-double-right"></i>Attendance</a></li>
				<li><a href="{!!URL::to('attendance/attendance-report')!!}"><i class="fa fa-angle-double-right"></i>Generate Report</a></li>
			</ul>
		</li>
		@else
		<li>
			<a href="{!!URL::to('attendance')!!}">
				<i class="fa fa-clock-o"></i> <span>Attendance</span>
			</a>
		</li>
		@endif
		@if((Auth::user()->role->name)=='admin')
		<li class="treeview">
			<a href="#">
				<i class="fa fa-simplybuilt"></i>
				<span>Company</span>
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li><a href="{!!URL::to('company/create')!!}"><i class="fa fa-angle-double-right"></i>Add New Company</a></li>
				<li><a href="{!!URL::to('company')!!}"><i class="fa fa-angle-double-right"></i>Manage Company</a></li>
				
			</ul>
		</li>
		<li class="treeview">
			<a href="#">
				<i class="fa fa-user"></i>
				<span>User</span>
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li><a href="{!!URL::to('user/createuser')!!}"><i class="fa fa-angle-double-right"></i>Add New User</a></li>
				<li><a href="{!!URL::to('user')!!}"><i class="fa fa-angle-double-right"></i>Manage User</a></li>
				
			</ul>
		</li>
		@endif
		<!-- <li>
			<a href="../widgets.html">
				<i class="fa fa-th"></i> <span>Widgets</span> <small class="badge pull-right bg-green">new</small>
			</a>
		</li>
		<li class="treeview">
			<a href="#">
				<i class="fa fa-bar-chart-o"></i>
				<span>Charts</span>
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li><a href="../charts/morris.html"><i class="fa fa-angle-double-right"></i> Morris</a></li>
				<li><a href="../charts/flot.html"><i class="fa fa-angle-double-right"></i> Flot</a></li>
				<li><a href="../charts/inline.html"><i class="fa fa-angle-double-right"></i> Inline charts</a></li>
			</ul>
		</li>
		<li class="treeview">
			<a href="#">
				<i class="fa fa-laptop"></i>
				<span>UI Elements</span>
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li><a href="../UI/general.html"><i class="fa fa-angle-double-right"></i> General</a></li>
				<li><a href="../UI/icons.html"><i class="fa fa-angle-double-right"></i> Icons</a></li>
				<li><a href="../UI/buttons.html"><i class="fa fa-angle-double-right"></i> Buttons</a></li>
				<li><a href="../UI/sliders.html"><i class="fa fa-angle-double-right"></i> Sliders</a></li>
				<li><a href="../UI/timeline.html"><i class="fa fa-angle-double-right"></i> Timeline</a></li>
			</ul>
		</li>
		<li class="treeview active">
			<a href="#">
				<i class="fa fa-edit"></i> <span>Forms</span>
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li class="active"><a href="general.html"><i class="fa fa-angle-double-right"></i> General Elements</a></li>
				<li><a href="advanced.html"><i class="fa fa-angle-double-right"></i> Advanced Elements</a></li>
				<li><a href="editors.html"><i class="fa fa-angle-double-right"></i> Editors</a></li>
			</ul>
		</li>
		<li class="treeview">
			<a href="#">
				<i class="fa fa-table"></i> <span>Tables</span>
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li><a href="../tables/simple.html"><i class="fa fa-angle-double-right"></i> Simple tables</a></li>
				<li><a href="../tables/data.html"><i class="fa fa-angle-double-right"></i> Data tables</a></li>
			</ul>
		</li>
		<li>
			<a href="../calendar.html">
				<i class="fa fa-calendar"></i> <span>Calendar</span>
				<small class="badge pull-right bg-red">3</small>
			</a>
		</li>
		<li>
			<a href="../mailbox.html">
				<i class="fa fa-envelope"></i> <span>Mailbox</span>
				<small class="badge pull-right bg-yellow">12</small>
			</a>
		</li>
		<li class="treeview">
			<a href="#">
				<i class="fa fa-folder"></i> <span>Examples</span>
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li><a href="../examples/invoice.html"><i class="fa fa-angle-double-right"></i> Invoice</a></li>
				<li><a href="../examples/login.html"><i class="fa fa-angle-double-right"></i> Login</a></li>
				<li><a href="../examples/register.html"><i class="fa fa-angle-double-right"></i> Register</a></li>
				<li><a href="../examples/lockscreen.html"><i class="fa fa-angle-double-right"></i> Lockscreen</a></li>
				<li><a href="../examples/404.html"><i class="fa fa-angle-double-right"></i> 404 Error</a></li>
				<li><a href="../examples/500.html"><i class="fa fa-angle-double-right"></i> 500 Error</a></li>
				<li><a href="../examples/blank.html"><i class="fa fa-angle-double-right"></i> Blank Page</a></li>
			</ul>
		</li> -->
	</ul>
</section>
<!-- /.sidebar -->
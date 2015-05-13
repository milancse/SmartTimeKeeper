@extends('layouts.master')
@section('page_title') Dashboard @endsection
@section('page_head') Dashboard @endsection
@section('page_summery') This is dashboard @endsection
@section('content')
<div class="row">
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3>
					123456
				</h3>
				<p>
					Patients
				</p>
			</div>
			<div class="icon">
				<i class="ion ion-person"></i>
			</div>
			<a href="#" class="small-box-footer">
				More info <i class="fa fa-arrow-circle-right"></i>
			</a>
		</div>
	</div><!-- ./col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-yellow">
			<div class="inner">
				<h3>
					123456
				</h3>
				<p>
					Doctors
				</p>
			</div>
			<div class="icon">
				<i class="ion ion-person-add"></i>
			</div>
			<a href="3" class="small-box-footer">
				More info <i class="fa fa-arrow-circle-right"></i>
			</a>
		</div>
	</div><!-- ./col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-green">
			<div class="inner">
				<h3>
					123456<sup style="font-size: 20px"></sup>
				</h3>
				<p>
					Garments
				</p>
			</div>
			<div class="icon">
				<i class="ion ion-stats-bars"></i>
			</div>
			<a href="#" class="small-box-footer">
				More info <i class="fa fa-arrow-circle-right"></i>
			</a>
		</div>
	</div><!-- ./col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-red">
			<div class="inner">
				<h3>
					123456
				</h3>
				<p>
					Factories
				</p>
			</div>
			<div class="icon">
				<i class="ion ion-pie-graph"></i>
			</div>
			<a href="#" class="small-box-footer">
				More info <i class="fa fa-arrow-circle-right"></i>
			</a>
		</div>
	</div><!-- ./col -->
</div>
<div class="row">
	<div class="col-md-6">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Recent Patients</h3>
				<div class="box-tools pull-right">
					<a href="#" class="btn btn-default btn-sm"><i class="fa fa-list"></i> View More</a>
				</div>
			</div><!-- /.box-header -->
			<div class="box-body">
				<table class="table table-bordered">
					<tbody>
					<tr>
						<th>Name</th>
						<th>Phone</th>
						<th>Actions</th>
					</tr>
					
					<tr>
						<td></td>
						<td></td>
						<td><a href="#" class="btn btn-sm btn-default"><i class="fa fa-eye"></i></a></td>
					</tr>
				
					<tr><td class="empty_row" colspan='3'>No Patient(s) Found!</td></tr>
					
					</tbody>
				</table>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div><!-- /.col -->
	<div class="col-md-6">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Recent Supervisors</h3>
				<div class="box-tools pull-right">
					<a href="#" class="btn btn-default btn-sm"><i class="fa fa-list"></i> View More</a>
				</div>
			</div><!-- /.box-header -->
			<div class="box-body">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th>Name</th>
							<th>Phone</th>
						</tr>
						
						<tr>
							<td></td>
							<td>{</td>
						</tr>
						
						<tr><td class="empty_row" colspan='2'>No Supervisor(s) Found!</td></tr>
						
					</tbody>
				</table>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div><!-- /.col -->
</div>
<!--resource found: http://laravelcollective.com/docs/5.0/html-->

@endsection
@yield('comment_modal')
@section('custom_style')

@endsection

@section('custom_script')


@endsection
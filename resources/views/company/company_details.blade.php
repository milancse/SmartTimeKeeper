@extends('layouts.master')
@section('page_title') Dashboard @endsection
@section('page_head') Company @endsection
@section('page_summery') Company Details @endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-body">
				<div class="row">
					<div class="col-md-4">
						<h4>Title:{!!$company['title']!!}</h4>
					</div>
					<div class="col-md-4">
						<h4>Office Time Zone:{!!$company['office_time_zone']!!}</h4>
					</div>
					<div class="col-md-4">
						<h4>Address:{!!$company['address']!!}</h4>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<h4>Office Start Time:{!!$company['office_start_time']!!}</h4>
					</div>
					<div class="col-md-4">
						<h4>Office End Time:{!!$company['office_end_time']!!}</h4>
					</div>
					<div class="col-md-4">
						<h4>Phone:{!!$company['phone']!!}</h4>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<h4>Mobile:{!!$company['mobile']!!}</h4>
					</div>
					<div class="col-md-4">
						<h4>Email:{!!$company['email']!!}</h4>
					</div>
					<div class="col-md-4">
						<h4>Fax:{!!$company['fax']!!}</h4>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<h4>Web:{!!$company['web']!!}</h4>
					</div>
					<div class="col-md-4">
						<h4>Logo:{!!$company['logo']!!}</h4>
					</div>
					<div class="col-md-4">
						<div class="checkbox">
							<label>
							<input type="checkbox" name="active" <?= $company['active']==1?"checked":"" ?>
							>Active
							</label>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('custom_style')
@endsection

@section('custom_script')

@endsection
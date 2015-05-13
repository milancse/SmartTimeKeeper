@extends('layouts.master')
@section('page_title') User @endsection
@section('page_head') User @endsection
@section('page_summery') User Details @endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-body">
				<div class="row">
					<div class="col-md-4">
						<h4>Name:{!!$user->employee->first_name!!}<?=" "?>{!!$user->employee->last_name!!}</h4>
					</div>
					<div class="col-md-4">
						<h4>Email:{!!$user->email!!}</h4>
					</div>
					<div class="col-md-4">
						<h4>Role:{!!$user->role->name!!}</h4>
					</div>	
				</div>
				<div class="row">
					<div class="col-md-4">
						<h4>Company:{!!$user->employee->company->title!!}</h4>
					</div>
					<div class="col-md-4">
						<h4>Department:{!!$user->employee->department->title!!}</h4>
					</div>
					<div class="col-md-4">
						<h4>Designation:{!!$user->employee->designation->title!!}</h4>
					</div>		
				</div>	
				<div class="row">
					<div class="col-md-4">
						<h4>Joining Date:{!!date(' d M Y', strtotime($user->employee->joining_date))!!}</h4>
					</div>
					<div class="col-md-4">
						<h4>Employee ID:{!!$user->employee->employee_identifier!!}</h4>
					</div>
					<div class="col-md-4">
						<h4>Status:@if($user->active==1)
								Active
								@else
								Inactive
								@endif
							</h4>
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
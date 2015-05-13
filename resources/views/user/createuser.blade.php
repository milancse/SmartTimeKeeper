@extends('layouts.master')
@section('page_title') Dashboard @endsection
@section('page_head')Users @endsection
@section('page_summery')Create New user @endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-info">	
			@if($data['count']==0)
    			{!! Form::open(array('url' => 'user/saveuser')) !!}
    		@else
    			{!!Form::model($data,array('url' =>'user/updateuser/'.$data['id'],$data['id']))!!}
    		@endif
			<div class="box-body">
				<div class="row">	
					<div class="form-group col-md-6">
						{!!Form::label('Company','Company')!!}
						{!!Form::select('company_id',$data['company_list'],null,array('class'=>'form-control'))!!}
					</div>
					<div class="form-group col-md-6">
						{!!Form::label('Role','Role')!!}
						{!!Form::select('role_id',$data['role_list'],null,array('class'=>'form-control'))!!}
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-6">
						{!!Form::label('Designation','Designation')!!}
						{!!Form::select('designation_id',$data['designation_list'],null,array('class'=>'form-control'))!!}
					</div>
					<div class="form-group col-md-6">
						{!!Form::label('Department','Department')!!}
						{!!Form::select('department_id',$data['department_list'],null,array('class'=>'form-control'))!!}
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-4 <?= $errors->first('first_name') ? "has-error" : "" ?>">
						{!!Form::label('First Name','First Name')!!}
						{!!Form::text('first_name',Input::old('first_name'),array('class'=>'form-control'))!!}
						{!! $errors->first('first_name', '<p class="text-danger">:message</p>') !!}
					</div>
					<div class="form-group col-md-4 <?= $errors->first('last_name') ? "has-error" : "" ?>">
						{!!Form::label('Last Name','Last Name')!!}
						{!!Form::text('last_name',Input::old('last_name'),array('class'=>'form-control'))!!}
						{!! $errors->first('last_name', '<p class="text-danger">:message</p>') !!}
					</div>
					<div class="form-group col-md-4 <?= $errors->first('last_name') ? "has-error" : "" ?>">
						{!!Form::label('Jopining Date','Joining Date')!!}
						{!!Form::text('joining_date',Input::old('joining_date'),array('class'=>'form-control datepicker'))!!}
						{!! $errors->first('last_name', '<p class="text-danger">:message</p>') !!}
					</div>	
				</div>
				<div class="row">
					@if($data['count']==1)
						<div class="form-group col-md-6 <?= $errors->first('email') ? "has-error" : "" ?>">
							{!!Form::label('Email','Email')!!}
							{!!Form::email('email',Input::old('email'),array('class'=>'form-control','disabled'=>''))!!}
							{!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
						</div>
						<div class="col-md-6  ?>">
							{!!Form::label('Employee ID','Employee Id')!!}
							{!!Form::text('employee_identifier',Input::old('employee_identifier'),array('class'=>'form-control','disabled'=>''))!!}
							
						</div>
					@else
						<div class="form-group col-md-6 <?= $errors->first('email') ? "has-error" : "" ?>">
							{!!Form::label('Email','Email')!!}
							{!!Form::email('email',null,array('class'=>'form-control'))!!}
							{!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
						</div>
						<div class="form-group col-md-6 <?= $errors->first('password') ? "has-error" : "" ?>">
						{!!Form::label('Password','Password')!!}
						{!!Form::password('password',array('class'=>'form-control'))!!}
						{!! $errors->first('password', '<p class="text-danger">:message</p>') !!}
						</div>
					@endif			
				</div>
				<div class="row">
						<div class="col-md-6">
							<div class="checkbox">
								<label>
								{!! Form::checkbox('active', '1') !!} Active.
								</label>
							</div>
						</div>
						@if($data['count']==0)
						<div class="col-md-6 <?= $errors->first('employee_identifier') ? "has-error" : "" ?>">
							{!!Form::label('Employee ID','Employee Id')!!}
							{!!Form::text('employee_identifier',Input::old('employee_identifier'),array('class'=>'form-control'))!!}
							{!! $errors->first('employee_identifier', '<p class="text-danger">:message</p>') !!}
						</div>
						@endif
					</div>	
			</div>
			<div class="box-footer">
				<button class="btn btn-info" name="btn_save_user"><i class="fa fa-save"></i> Save</button>
			</div>
			{!!Form::close()!!}
		</div>
	</div>
</div>
@endsection
@section('custom_style')
<link href="{{ URL::asset('css/datepicker/datepicker3.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('custom_script')
<script src="{{ URL::asset('js/plugins/datepicker/bootstrap-datepicker.js')}}" type="text/javascript"></script>
<script>
	$(document).ready(function(){
	$(".datepicker").datepicker({format:'yyyy-mm-dd'});
	
    });
</script>
@endsection
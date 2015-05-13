@extends('layouts.master')
@section('page_title') Company @endsection
@section('page_head') Company @endsection
@section('page_summery')Create New Company @endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
		@if(!isset($company))		
		{!!Form::open(array('url'=>'company','files'=>'true'))!!}
		@else
		{!!Form::model($company,array('route'=>array('company.update',$company->id),'files'=>'true','method' => 'PUT'))!!}	
		@endif
			<div class="box-body">
				
				<div class="row">
					<div class="form-group col-md-6 <?= $errors->first('title') ? "has-error" : "" ?>">
						{!!Form::label('title','Title')!!}
						{!!Form::text('title',Input::old('title'),array('class'=>'form-control'))!!}
						{!! $errors->first('title', '<p class="text-danger">:message</p>') !!}
					</div>
					<div class="form-group col-md-6 <?= $errors->first('office_time_zone') ? "has-error" : "" ?>">
						{!!Form::label('office_time _zone','Office Time Zone')!!}
						{!!Form::select('office_time_zone',config('constants.office_time_zone'),null,array('class'=>'form-control'))!!}
						{!! $errors->first('office_time_zone', '<p class="text-danger">:message</p>') !!}
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-3 <?= $errors->first('office_start_time') ? "has-error" : "" ?>">
						{!!Form::label('office_start_time','Office Start Time')!!}
						<div class="input-group ">
							{!!Form::text('office_start_time',Input::old('office_start_time'),array('class'=>'form-control timepicker1'))!!}  
							<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
						</div>
						{!! $errors->first('office_start_time', '<p class="text-danger">:message</p>') !!}
					</div>
					<div class="form-group col-md-3 <?= $errors->first('office_end_time') ? "has-error" : "" ?>">
						{!!Form::label('office_end_time','Office End Time')!!}
						<div class="input-group ">
						 {!!Form::text('office_end_time',Input::old('office_end_time'),array('class'=>'form-control timepicker2'))!!} 
						<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
						</div>
						{!! $errors->first('office_end_time', '<p class="text-danger">:message</p>') !!}
					</div>
					<div class="form-group col-md-6">
						{!!Form::label('phone','Phone')!!}
						{!!Form::text('phone',Input::old('phone'),array('class'=>'form-control'))!!}
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-6 <?= $errors->first('mobile') ? "has-error" : "" ?>">
						{!!Form::label('mobile','Mobile')!!}
						{!!Form::text('mobile',Input::old('mobile'),array('class'=>'form-control'))!!}
						{!! $errors->first('mobile', '<p class="text-danger">:message</p>') !!}
					</div>
					<div class="form-group col-md-6 <?= $errors->first('mobile') ? "has-error" : "" ?>">
						{!!Form::label('email','Email')!!}
						{!!Form::text('email',Input::old('email'),array('class'=>'form-control'))!!}
						{!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-6">
						{!!Form::label('fax','Fax')!!}
						{!!Form::text('fax',Input::old('fax'),array('class'=>'form-control'))!!}
					</div>
					<div class="form-group col-md-6">
						{!!Form::label('web','Web')!!}
						{!!Form::text('web',Input::old('web'),array('class'=>'form-control'))!!}
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group <?= $errors->first('logo') ? "has-error" : "" ?>">
							{!! Form::label('','Company Logo')!!}<br>
								@if(isset($company) && $company->logo)
									<div class="fileinput fileinput-exists" data-provides="fileinput">
								@else
									<div class="fileinput fileinput-new" data-provides="fileinput">
								@endif		
									<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
									@if(isset($company)){!!$company->logo!!}
									@endif
									</div>
									<div>
										<span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists ">Change</span>
										<input type="file" name="logo"></span>
										<a href="#" class=" btn btn-default fileinput-exists " data-dismiss="fileinput" id="remove_photo">Remove</a>
									</div>

									<input type="hidden" name="photo_id" id="hidden_photo_id" value="Hidden input value"/>
								</div>
							</div>
							{!! $errors->first('logo', '<p class="text-danger">:message</p>') !!}
					</div>
					<div class="form-group col-md-6 <?= $errors->first('address') ? "has-error" : "" ?>">
						{!!Form::label('address','Address')!!}
						{!!Form::textarea('address',Input::old('address'),array('class'=>'form-control','placeholder'=>'Company Address'))!!}
						{!! $errors->first('address', '<p class="text-danger">:message</p>') !!}	
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="checkbox">
							<label>
							{!! Form::checkbox('active', '1') !!} Active.
							</label>
						</div>
					</div>
				</div>
				
			</div><!-- /.box-body -->
			<div class="box-footer">
				<button class="btn btn-info" name="btn_save_user"><i class="fa fa-save"></i> Save</button>
			</div>
			{!!Form::close()!!}
		</div><!-- /.box -->
	</div><!-- /.col -->
</div>
<!--resource found: http://laravelcollective.com/docs/5.0/html-->
@endsection
@section('custom_style')
<link href="{{ URL::asset('bootstrap_timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('jasny_bootstrap/jasny-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('custom_script')
<script src="{{ URL::asset('jasny_bootstrap/fileinput.js')}}"></script>
<script src="{{ URL::asset('bootstrap_timepicker/js/bootstrap-timepicker.min.js')}}"></script>
<script>
$(document).ready(function(){
	$('#hidden_photo_id').val("set hidden input value");
	$('.timepicker1').timepicker();
	$('.timepicker2').timepicker();
	$('.fileinput').fileinput();
	$('#remove_photo').on('click',function(){

		$('#hidden_photo_id').val("");
	});
	

});

</script>
@endsection
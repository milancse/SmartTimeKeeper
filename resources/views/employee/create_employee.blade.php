@extends('layouts.master')
@section('page_title') Employee@endsection
@section('page_head') Employee @endsection
@section('page_summery')Create New Employee @endsection
@section('content')
<div class="row">
    <div class="col-md-12">
     	<!-- {!! Form::model($employee_info, array('url' => 'employee/update-profile/'.$employee_info->id)) !!} -->
		<div class="box box-info">
			@if(!isset($employee))		
			{!!Form::open(array('url'=>'employee','files'=>'true'))!!}
			@else
			{!!Form::model($employee,array('route'=>array('employee.update',$employee->id),'files'=>'true','method' => 'PUT'))!!}	
			@endif
			<div class="box-body">
				<div class="row">
					<div class="form-group col-md-6 <?= $errors->first('first_name') ? "has-error" : "" ?>">
						{!!Form::label('First Name','First Name')!!}
						{!!Form::text('first_name',Input::old('first_name'),array('class'=>'form-control'))!!}
						{!! $errors->first('first_name', '<p class="text-danger">:message</p>') !!}
					</div>
					<div class="form-group col-md-6 <?= $errors->first('last_name') ? "has-error" : "" ?>">
						{!!Form::label('Last Name','Last Name')!!}
						{!!Form::text('last_name',Input::old('last_name'),array('class'=>'form-control'))!!}
						{!! $errors->first('last_name', '<p class="text-danger">:message</p>') !!}
					</div>		
				</div>
				<div class="row">
					<div class="form-group col-md-6 <?= $errors->first('email') ? "has-error" : "" ?>">
						{!!Form::label('Email','Email')!!}
						{!!Form::email('email',Input::old('email'),array('class'=>'form-control','disabled'=>''))!!}
						{!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
					</div>
					<div class="form-group col-md-6 <?= $errors->first('phone') ? "has-error" : "" ?>">
						{!!Form::label('Phone','Phone')!!}
						{!!Form::email('phone',null,array('class'=>'form-control'))!!}
						{!! $errors->first('phone', '<p class="text-danger">:message</p>') !!}
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-3 <?= $errors->first('national_id') ? "has-error" : "" ?>">
						{!!Form::label('National ID','National Id')!!}
						{!!Form::email('national_id',Input::old('national_id'),array('class'=>'form-control','disabled'=>''))!!}
						{!! $errors->first('national_id', '<p class="text-danger">:message</p>') !!}
					</div>
					<div class="form-group col-md-3">
						{!!Form::label('Date of birth','Date of Birth')!!}
						{!!Form:text('dob',Input::old('dob'),array('class'=>'form-control datepicker'))!!}
					</div>
					<div class="form-group col-md-3<?= $errors->first('gender') ? "has-error" : "" ?>">
                        <label class="control-label" for="gender">Gender</label>
                                                <!--{!! Form::text('gender', Input::old('gender'), array('class'=>'form-control', 'placeholder'=>'Gender')) !!}-->
                            <div class="row">
                                <div class="col-xs-3">
                                    <div class="radio">
                                    	{!!Form::radio('gender', 'male', true)!!} Male
                                    </div>
                              	</div>
                                <div class="col-xs-4">
                                   	<div class="radio">
                                        {!!Form::radio('gender', 'female', true)!!} Female
                                    </div>
                                </div>
                            </div>
                    {!! $errors->first('gender', '<p class="text-danger">:message</p>') !!}
                    </div>
				</div>
				<div class="row">
					<div class="form-group col-md-3 <?= $errors->first('joining_date') ? "has-error" : "" ?>">
						{!!Form::label('Joining Date','Joining Date')!!}
						{!!Form::text('joining_date',Input::old('joining_date'),array('class'=>'form-control')!!}
						{!! $errors->first('joining_date', '<p class="text-danger">:message</p>') !!}
					</div>
					<div class="form-group col-md-3">
						{!!Form::label('Department','Department')!!}
						{!!Form::select('department_id',$employee['department_list'],null,array('class'=>'form-control'))!!}
					</div>
					<div class="form-group col-md-3">
						{!!Form::label('Designation','Designation')!!}
						{!!Form::select('designation_id',$employee['designation_list'],null,array('class'=>'form-control'))!!}
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-6">
						{!!Form::label('Present address','Present Address')!!}
						{!!Form::textarea('present_address',Input::old('present_address'),array('class'=>'form-control'))!!}
					</div>
					<div class="form-group col-md-6">
						<div class="form-group col-md-6">
						{!!Form::label('Permanent address','Permanent Address')!!}
						{!!Form::textarea('permanent_address',Input::old('permanent_address'),array('class'=>'form-control'))!!}
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group <?= $errors->first('photo') ? "has-error" : "" ?>">
							{!! Form::label('','Employee Photograph')!!}<br>
								<div class="fileinput fileinput-exists" data-provides="fileinput">
									<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
										<!-- @if(isset($userprofile->photo)){!!$userprofile->photo!!}
										@endif  -->
									</div>
									<div>
										<span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists ">Change</span>
											<input type="file" name="photo"></span>
											<a href="#" class=" btn btn-default fileinput-exists " data-dismiss="fileinput" id="remove_photo">Remove</a>
									</div>

										<input type="hidden" name="photo_id" id="hidden_photo_id" value="Hidden input value"/>
								</div>
							{!! $errors->first('photo', '<p class="text-danger">:message</p>') !!}	
						</div>
					</div>
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
<link href="{{ URL::asset('bootstrap_timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('jasny_bootstrap/jasny-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('custom_script')
<script src="{{ URL::asset('jasny_bootstrap/fileinput.js')}}"></script>
<script src="{{ URL::asset('bootstrap_timepicker/js/bootstrap-timepicker.min.js')}}"></script>
<script>
// $(document).ready(function(){
// 	$('#hidden_photo_id').val("set hidden input value");
// 	$('.timepicker1').timepicker();
// 	$('.timepicker2').timepicker();
// 	$('.fileinput').fileinput();
// 	$('#remove_photo').on('click',function(){

// 		$('#hidden_photo_id').val("");
// 	});
	

// });

</script>
@endsection
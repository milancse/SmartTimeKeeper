@extends('layouts.master')
@section('page_title') Employee @endsection
@section('page_head')Employee @endsection
@section('page_summery')Create Employeeprofile @endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			{!!Form::model($employee,array('url'=>'user/saveemployeeprofile',$employee->id,'files'=>'true'))!!}
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
					<div class="form-group col-md-6 <?= $errors->first('dob') ? "has-error" : "" ?>">
						{!!Form::label('Date of birth','Date of Birth')!!}
						{!!Form::text('dob',Input::old('dob'),array('class'=>'form-control datepicker'))!!}
						{!! $errors->first('dob', '<p class="text-danger">:message</p>') !!}
					</div>
					<div class="form-group col-md-6 <?= $errors->first('national_id') ? "has-error" : "" ?>">
						{!!Form::label('National Id','National ID')!!}
						{!!Form::text('national_id',Input::old('national_id'),array('class'=>'form-control'))!!}
						{!! $errors->first('national_id', '<p class="text-danger">:message</p>') !!}
					</div>
				</div>
				<div class="row">	
					<div class="form-group col-md-6 <?= $errors->first('phone') ? "has-error" : "" ?>">
						{!!Form::label('Phone','phone')!!}
						{!!Form::text('phone',Input::old('phone'),array('class'=>'form-control'))!!}
						{!! $errors->first('phone', '<p class="text-danger">:message</p>') !!}
					</div>
					<div class="form-group col-md-6">
						{!!Form::label('Password','Password')!!}
						{!!Form::password('password',array('class'=>'form-control'))!!}
					</div>		
				</div>
				<div class="row">
					<div class="form-group col-md-6">
						{!!Form::label('Email','Email')!!}
						{!!Form::email('email',Auth::user()->email,array('class'=>'form-control','disabled'=>''))!!}
					</div>
					<div class="form-group col-md-6 <?= $errors->first('email') ? "has-error" : "" ?>">
						{!!Form::label('Secondary Email','Secondary Email')!!}
						{!!Form::email('email',Input::old('email'),array('class'=>'form-control'))!!}
						{!! $errors->first('email', '<p class="text-danger">:message</p>') !!}	
					</div>	
				</div>
				<div class="row">
					<div class="form-group col-md-6">
						{!!Form::label('Present Address','Present Address')!!}
						{!!Form::textarea('present_address',Input::old('present_address'),array('class'=>'form-control '))!!}
					</div>
					<div class="form-group col-md-6 ">
						{!!Form::label('Permanent Address','Permanent Address')!!}
						{!!Form::textarea('permanent_address',Input::old('permanent_address'),array('class'=>'form-control '))!!}
					</div>
					
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group <?= $errors->first('photo') ? "has-error" : "" ?>">
							{!! Form::label('','Employee Photograph')!!}<br>
								<div class="fileinput fileinput-<?= $employee->photo != "" ? "exists" : "new" ?>" data-provides="fileinput">
									<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
										@if(isset($employee->photo)){!!$employee->photo!!}
										@endif 
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
					<div class="col-md-6">
						<div class="form-group col-md-6 <?php echo $errors->first('gender') ? "has-error" : ""; ?> has-feedback">
	                        <label  for="gender">Gender</label>                    
	                            <div class="radio">
	                                {!!Form::radio('gender', 'male', true)!!} Male
	                            </div>                                 
	                      		 <div class="radio">
	           				        {!!Form::radio('gender', 'female', true)!!} Female
	                            </div>                    
	                            <?php echo $errors->first('gender');?>
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
<link href="{{ URL::asset('jasny_bootstrap/jasny-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('css/datepicker/datepicker3.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('custom_script')
<script src="{{ URL::asset('jasny_bootstrap/fileinput.js')}}"></script>
<script src="{{ URL::asset('js/plugins/datepicker/bootstrap-datepicker.js')}}" type="text/javascript"></script>
<script>
$(document).ready(function(){
	$('#hidden_photo_id').val("set hidden input value");
	$('.fileinput').fileinput();
	$(".datepicker").datepicker({format:'yyyy-mm-dd'});
	$('#remove_photo').on('click',function(){

		$('#hidden_photo_id').val("");
	});
	

});

</script>
@endsection
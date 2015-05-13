@extends('layouts.master')
@section('page_title') Dashboard @endsection
@section('page_head') Company @endsection
@section('page_summery')Create New Company @endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			{!!Form::open(array('url'=>'department/create'))!!}
			<div class="box-body">
				<div class="row">
					<fieldset>
						<div class="form-group col-md-6">
							{!!Form::label('title','Title')!!}
							{!!Form::text('title',null,array('class'=>'form-control'))!!}
						</div>
						<div class="form-group col-md-6">
							{!!Form::label('Company','Company')!!}
							{!!Form::select('company_id',$data['company_list'],null,array('class'=>'form-control'))!!}
						</div>
					</fieldset>	
					<fieldset>
						<div class="form-group col-md-6">
							{!!Form::label('Details','Details')!!}
							{!!Form::textarea('details',null,array('class'=>'form-control'))!!}
						</div>
					</fieldset>
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
@endsection
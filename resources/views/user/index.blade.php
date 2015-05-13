@extends('layouts.master')
@section('page_title') User @endsection
@section('page_head') Users @endsection
@section('page_summery') This is user @endsection
@section('content')
<div class="row">
    <div class="col-md-12">
    	<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title"></h3>
				<div class="box-tools pull-right">
					<a href="{!!URL::to('user/createuser')!!}"><button id="btn_add_new_factory" type="button" class="btn btn-danger"><i class="fa fa-plus-circle"></i> Add New user</button></a>
				</div>
			</div>
			<div class="box-body">
				<table class="table table-bordered">
					<tr>
						
						<th>Name</th>
						<th>Company</th>
						<th>Department</th>
						<th>Designation</th>
						<th width="20%">Actions</th>
					</tr>
					@forelse($users as $user)
					<tr>	
						<td>{{$user->employee->first_name}}<?= " "?>{!!$user->employee->lastname!!}</td>
						<td>{{$user->employee->company->title}}</td>
						<td>{{$user->employee->department->title}}</td>
						<td>{{$user->employee->designation->title}}</td>
						<td>
							<a href="{!!URL::to('user/show/'.$user->id)!!}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> View</a>
                            <a href="{!!URL::to('user/edituser/'.$user->id)!!}" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i> Edit</a>
                            
                        </td>
                    </tr>
                    @empty
					<tr><td class="empty_row" colspan='5'>No Data Found!</td></tr>
					@endforelse
                </table>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
    </div>
</div>

@endsection

@section('custom_style')
@endsection

@section('custom_script')

@endsection
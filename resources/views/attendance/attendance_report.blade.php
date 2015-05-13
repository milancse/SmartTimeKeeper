@extends('layouts.master')
@section('page_title') Attendance @endsection
@section('page_head') Attendance @endsection
@section('page_summery') This is attendance report @endsection
@section('content')
<div class="row">
    <div class="col-md-12">
      {!!Form::open(array('url'=>'attendance/attendance-report','id'=>'attendanceReportForm'))!!}
    	<div class="box box-info">
			<div class="box-header with-border">
			  <h3 class="box-title">Attendance Report</h3>
			  <div class="box-tools pull-right">
				<div class="form-inline">
				  <div class="form-group ">
				  {!!Form::select('employee_id',$employee_list,Input::get('employee_id'),array('class'=>'form-control select2','placeholder'=>'Employee Name','id'=>'employee_id'))!!}
				  </div>  
				  <div class="form-group"> 

					<div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
						<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
						<span  id="datevalue"></span > <b class="caret"></b>
						<input type="hidden" name="start_date" id="start_date"/>
						<input type="hidden" name="end_date" id="end_date"/>
					</div>
				  </div>
				</div>
			  </div>
			</div>  
			<div id="attendance_report">
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover">
						<tr>  
							<th>Date</th>
							<th>In Time</th>
							<th>Out Time</th>
							<th>Comment</th>
						</tr>
						{!!$tbody!!}
					</table>
				</div>
			</div>
		</div>
      {!!Form::close()!!}
    </div>
</div>
@endsection

@section('custom_style')
<link href="{{ URL::asset('select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('bootstrap_daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('custom_script')
<script src="{{ URL::asset('select2/select2.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('bootstrap_daterangepicker/moment.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('bootstrap_daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>

<script >
$(document).ready(function(){

 $(".select2").select2();
    var start_date="<?= date('F d,  Y',strtotime(Input::get('start_date')))?>";
    var end_date="<?= date('F d,  Y',strtotime(Input::get('end_date')))?>";
    var input_date=start_date+'-'+end_date;
    $('#reportrange #datevalue').html(input_date);
    $('#reportrange').daterangepicker({
        format: 'MM/DD/YYYY',
        startDate: start_date,
        endDate: end_date,
        minDate: '01/01/2012',
        maxDate: '12/31/2015',
        dateLimit: { days: 60 },
        showDropdowns: true,
        showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        opens: 'left',
        drops: 'down',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-primary',
        cancelClass: 'btn-default',
        separator: ' to ',
        locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Cancel',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
        }
    }, function(start, end, label) {
        $('#reportrange #datevalue').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        $('#reportrange #start_date').val(start.format('YYYY-MM-DD'));
        $('#reportrange #end_date').val(end.format('YYYY-MM-DD'));
        $('#attendanceReportForm').submit();
    });
 
});
</script>
@endsection
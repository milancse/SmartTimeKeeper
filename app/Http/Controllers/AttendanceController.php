<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Company;
use Illuminate\Http\Request;
use App\User;
use App\Attendance;
use App\Employee;
use App\Public_Holiday;
use Session;
use Redirect;
use Input;
use DB;
class AttendanceController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function getIndex()
	{
		
		$user=User::find(Auth::user()->id);
		$employee_id=$user->employee->id;
		$attendance=DB::select(DB::raw("SELECT * FROM attendances WHERE employee_id=$employee_id AND DATE_FORMAT(in_time,'%Y-%m')=DATE_FORMAT(now(),'%Y-%m') ORDER BY created_at DESC"));
		return view('attendance.index')->with('attendances',$attendance);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	
	public function postPunchin()
	{
		 
		
		$ip=self::get_client_ip();
		$attendance=new Attendance;
		$employee=User::find(Auth::user()->id)->employee;
		$attendance->employee_id=$employee->id;
		$attendance->in_time=date("Y-m-d H:i:s");
		$attendance->network_ip=$ip;
		if(Input::get('comment')){
			$attendance->comments=Input::get('comment');
		}
		$employee_id=$employee->id;
		$attendance_employee=DB::select(DB::raw("SELECT * FROM attendances WHERE employee_id=$employee_id AND DATE_FORMAT(in_time,'%Y-%m')=DATE_FORMAT(now(),'%Y-%m-%d')"));
		if(isset($attendance_employee[0]->in_time)){
			$message="<div class='alert alert-danger alert-dismissible' role='alert'>
						 <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
						You are already punch in for today.</div>";
		}
		else{
			if($attendance->save()){
				Session::forget('in_time');
				$message="<div class='alert alert-success alert-dismissible' role='alert'>
							 <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
							Operation success!.</div>";
			}
			else{
				$message="<div class='alert alert-danger alert-dismissible' role='alert'>
							 <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
							Operation not success!.</div>";	
			}
		}
		
		Session::flash('message',$message);
		return Redirect::to('attendance');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function getComment(){
		$id = Input::get('id');
		$in_time=Input::get('in_time');
		$comment= Attendance::where('id','=',$id)->where('in_time','=','$in_time','OR')->get();
		exit(json_encode($comment[0]->comments));
	}
	public function postPunchout()
	{
		
		date_default_timezone_set('Asia/Dhaka');
		$user=User::find(Auth::user()->id);
		$employee_id=$user->employee->id;
		$affectedRows=0;
		$out_time=date("Y-m-d H:i:s");
		$attendance=DB::select(DB::raw("SELECT * FROM attendances WHERE employee_id=$employee_id AND DATE_FORMAT(in_time,'%Y-%m-%d')=DATE_FORMAT(now(),'%Y-%m-%d')"));
		if(isset($attendance[0]->out_time)){
			$message="<div class='alert alert-success alert-dismissible' role='alert'>
								 <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
								You are already punch out for today!.</div>";
		}
		else{
			if(Input::get('comment')){
				$affectedRows = Attendance::where('id', '=',$attendance[0]->id)->update(['out_time' =>$out_time,'comments'=>Input::get('comment')]);
			}

			else{
				$affectedRows = Attendance::where('id', '=',$attendance[0]->id)->update(['out_time' =>$out_time]);
			}

			if($affectedRows>0){
				$message="<div class='alert alert-success alert-dismissible' role='alert'>
								 <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
								Operation success!.</div>";
			}
			else{
				$message="<div class='alert alert-danger alert-dismissible' role='alert'>
								 <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
								Operation not success!.</div>";	
			}
			
		}
		Session::flash('message',$message);
		return Redirect::to('attendance');
		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function get_client_ip() {
	    $ipaddress = '';
	    if (getenv('HTTP_CLIENT_IP'))
	        $ipaddress = getenv('HTTP_CLIENT_IP');
	    else if(getenv('HTTP_X_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	    else if(getenv('HTTP_X_FORWARDED'))
	        $ipaddress = getenv('HTTP_X_FORWARDED');
	    else if(getenv('HTTP_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_FORWARDED_FOR');
	    else if(getenv('HTTP_FORWARDED'))
	       $ipaddress = getenv('HTTP_FORWARDED');
	    else if(getenv('REMOTE_ADDR'))
	        $ipaddress = getenv('REMOTE_ADDR');
	    else
	        $ipaddress = 'UNKNOWN';
	    return $ipaddress;
	}
	
	function getAttendanceReport(){
		$users = User::where('active', '=', 1)->get();
		$employee_list = array();
		foreach($users as $user){
			$employee_list[$user->employee->id] = $user->employee->first_name.' '.$user->employee->last_name;
		}
		$tbody = "<tr><td colspan='4'>No record(s) found</td></tr>";
		$data = array(
			'employee_list' => $employee_list,
			'tbody' => $tbody
		);
		
		Input::replace(array('start_date' => date('F d,Y'),'end_date'=>date('F d,Y')));
		return view('attendance.attendance_report')->with($data)->withInput(Input::all());
	}
	
	function postAttendanceReport(){

		$holiday=Public_Holiday::all();
		echo "<pre>";
		print_r($holiday);
		exit();
		
		/*Getting employee list*/
		$users = User::where('active', '=', 1)->get();
		$employee_list = array();
		foreach($users as $user){
			$employee_list[$user->employee->id] = $user->employee->first_name.' '.$user->employee->last_name;
		}
		/*end*/		
		
		
		$employee_id= Input::get('employee_id');
		$start_date=Input::get('start_date');
		$end_date=Input::get('end_date');
		$attendance = DB::select(DB::raw("SELECT * FROM attendances WHERE employee_id=$employee_id AND DATE_FORMAT(in_time,'%Y-%m-%d') BETWEEN '$start_date' AND '$end_date'"));
		
		$tbody = "";
		if(count($attendance) > 0){
			$count=count($attendance);
			$day=$start_date;
			$date1 = new \DateTime($start_date);
			$date2 = new \DateTime($end_date);
			$date_difference=$date1->diff($date2)->days;
			$j=0;
			for($i=1;$i<=$date_difference+1;$i++)
			{
				
				if(date('Y-m-d',strtotime($attendance[$j]->in_time))==$day)
				{
					
					if(isset($attendance[$j]->out_time))
					{
						$out_time=date('h:i:s a',strtotime($attendance[$j]->out_time));
					}
					else
					{
						$out_time="";
					}
					$tbody.="<tr><td>".date('d M,Y',strtotime($attendance[$j]->in_time))."</td><td>".date('h:i:s a',strtotime($attendance[$j]->in_time))."</td><td>".$out_time."</td><td>".$attendance[$j]->comments."</td></tr>";
					
				}
				else
				{
					if(date('w',strtotime($day))==5)
					{
						$tbody.="<tr class='warning'><td>".date('d M,Y',strtotime($day))."</td><td></td><td></td><td></td></tr>";
					}
					else
					{
						$tbody.="<tr><td>".date('d M,Y',strtotime($day))."</td><td></td><td></td><td></td></tr>";
					}
					$j++;
					if($j==$count)
					{	
						$j=0;
					}
				}
				$day=date('Y-m-d',strtotime("+$i day", strtotime($start_date)));
				
			}
		}
		else{
			$tbody .= "<tr><td colspan='4'>No record(s) found</td></tr>";
		}
		$data = array(
			'employee_list' => $employee_list,
			'tbody' => $tbody
		);

		return view('attendance.attendance_report')->with($data)->withInput(Input::all());
	}
	
	

}

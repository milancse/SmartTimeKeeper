<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use File;
use Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Session;
use Redirect;
use App\UserProfile;
use App\Company;
use App\Role;
use App\Designation;
use App\Depertment;
use App\User;
use App\Employee;
class UserController extends Controller {

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
		
		$user=User::all(); 
		return view('user.index')->with('users',$user);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreateuser()
	{
		$company_list=Company::lists('title','id');
		$role_list=Role::lists('name','id');
		$designation_list=Designation::lists('title','id');
		$department_list=Depertment::lists('title','id');
		$data=array(
			'company_list'=>$company_list,
			'role_list'=>$role_list,
			'designation_list'=>$designation_list,
			'department_list'=>$department_list,
			'count'=>0
			);
		return view('user.createuser')->with('data',$data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postSaveuser()
	{
		
		$rules=array(
			'email'=>'required|email|unique:users',
			'password' =>'required|min:8|alpha_num',
			'first_name'=>'required',
			'last_name'=>'required',
			'joining_date'=>'required',
			'employee_identifier'=>'required|unique:employees'
			);
		$validator=validator::make(Input::all(),$rules);
		if($validator->fails()){
			return Redirect::to('user/createuser')
                ->withErrors($validator)->withInput ();
		}
		else{
			$user=new User;
			$user->role_id=Input::get('role_id');
			$user->email=Input::get('email');
			$user->active=Input::get('active');
			$user->password=Hash::make(Input::get('password'));
			if($user->save())
			{
				$employee=new Employee();
				$employee->user_id=$user->id;
				$employee->company_id=Input::get('company_id');
				$employee->designation_id=Input::get('designation_id');
				$employee->department_id=Input::get('department_id');
				$employee->employee_identifier=Input::get('employee_identifier');
				$employee->joining_date=Input::get('joining_date');
				$employee->first_name=Input::get('first_name');	
				$employee->last_name=Input::get('last_name');
				$employee->save();
				$message="<div class='alert alert-success alert-dismissible' role='alert'>
						 <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
						 User has been created Successfully!.</div>";	
			}
			else{
				$message="<div class='alert alert-danger alert-dismissible' role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
						 Company has not created successfully!.</div>";	
			}
			
			Session::flash('message', $message);
			$user=User::all(); 
			//exit($user->employee->first_name);
			return Redirect::to('user');;
		}

	}

	public function getUserprofile(){ 
		$employee = User::find(Auth::user()->id)->employee; 
		$photo="";
		if($employee->photo)
		{
			$photo_path='uploads/'.$employee->photo;
			$photo = "<img src='" . asset ( $photo_path ) . "'/>";
			Session::put('profile_pic',asset($photo_path));
		}
		
		$employee->dob=date('Y-m-d',strtotime($employee->dob));
		$employee->photo=$photo;
		
		return view('user.employeeprofile')->with('employee',$employee);
	}

	public function postSaveemployeeprofile(){
		$employee= User::find(Auth::user()->id)->employee; 
		$rules=array(
				'phone'=> 'required|unique:employees,phone,' . $employee->id . ',',
				'photo'=>'mimes:jpeg,jpg,png|max:1024',
				'national_id'=>'required|unique:employees,national_id,'. $employee->id. ',',
				'email'=>'required|email|unique:employees,email,'. $employee->id. ',',
				'dob'=>'required'

			);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){
				return Redirect::to('user/userprofile')
                ->withErrors($validator)->withInput ();
		}
		else
		{		
			$employee->first_name=Input::get('first_name');
			$employee->last_name=Input::get('last_name');
			$employee->phone=Input::get('phone');
			$employee->email=Input::get('email');
			$employee->national_id=Input::get('national_id');
			$employee->dob=Input::get('dob');
			$employee->gender=Input::get('gender');
			$employee->present_address=Input::get('present_address');
			$employee->permanent_address=Input::get('permanent_address');
			$employee->user_id=Auth::user()->id;
			if(Input::get('password')){
				$user=User::find(Auth::user()->id);
				$user->password=Hash::make(Input::get('password'));
				$user->save();
			}

			$filename="";
				if(Input::file('photo'))
				{
					$logo_name=Input::file('photo');
					$destinationPath='uploads/';
					$filename = date ( 'ymdhis' ) . '.' . $logo_name->guessClientExtension ();
					Input::file ( 'photo' )->move ( $destinationPath, $filename );
					if ($employee->photo) {
						$photo_name = $employee->photo;
						$path = 'uploads/' . $photo_name;
						if (File::exists ( $path )) {
							unlink ( $path );
						}
					}
				}

				else {
					if(Input::get('photo_id')=="")
					{
						if ($employee->photo) {
							$photo_name = $employee->photo;
							$path = 'uploads/' . $photo_name;
							if (File::exists ( $path )) {
								unlink ( $path );
							}
						}
					}
					else{
						$filename=$employee->photo;
					}

				}	
				$employee->photo=$filename;
				if($employee->save())
				{
					
					$message="<div class='alert alert-success alert-dismissible' role='alert'>
							 <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
							 Userprofile has been updated Successfully!.</div>";
							
				}
				else{

					$message="<div class='alert alert-danger alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
							 Userprofile has not been updated!.</div>";

				}
				$photo="";
				if($employee->photo)
				{
					$photo_path='uploads/'.$employee->photo;
					$photo = "<img src='" . asset ( $photo_path ) . "'/>";
				}
				else{
					$photo_path= "http://www.gravatar.com/avatar/" . md5( strtolower( trim( Auth::user()->email ) ) ); 
					$photo=$photo_path;
				}
				
				$employee->photo=$photo;
				Session::put('profile_pic',asset($photo_path));
				Session::flash('message', $message);
			    return Redirect::to("user");
		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
	{
		$user=User::find($id);
		return view('user.showuser')->with('user',$user);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdituser($id)
	{
		$user=User::find($id);
		$company_list=Company::lists('title','id');
		$role_list=Role::lists('name','id');
		$designation_list=Designation::lists('title','id');
		$department_list=Depertment::lists('title','id');
		$data=array(
			'company_id'=>$user->employee->company_id,
			'department_id'=>$user->employee->department_id,
			'designation_id'=>$user->employee->designation_id,
			'role_id'=>$user->role_id,
			'first_name'=>$user->employee->first_name,
			'last_name'=>$user->employee->last_name,
			'email'=>$user->email,
			'company_list'=>$company_list,
			'role_list'=>$role_list,
			'designation_list'=>$designation_list,
			'department_list'=>$department_list,
			'employee_identifier'=>$user->employee->employee_identifier,
			'joining_date'=>date('Y-m-d',strtotime($user->employee->joining_date)),
			'id'=>$user->id,
			'active'=>$user->active,
			'count'=>1
			);
		return view('user.createuser')->with('data',$data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postUpdateuser($id)
	{
		//echo $id;
		$user=User::find($id);

		
		$user->role_id=Input::get('role_id');
		$user->active=Input::get('active');
		if($user->save())
		{
			$employee=User::find($id)->employee;
			$employee->first_name=Input::get('first_name');	
			$employee->last_name=Input::get('last_name');
			$employee->company_id=Input::get('company_id');
			$employee->joining_date=Input::get('joining_date');
			$employee->department_id=Input::get('department_id');
			$employee->designation_id=Input::get('designation_id');
			$employee->save();
			$message="<div class='alert alert-success alert-dismissible' role='alert'>
						 <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
						 User has been updated Successfully!.</div>";	
		}
		else{
			$message="<div class='alert alert-danger alert-dismissible' role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
						 Company has not been updated!.</div>";	
		}
		Session::flash('message', $message);
		return Redirect::to('user');
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

}

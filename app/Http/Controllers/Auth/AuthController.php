<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Validator;
use Input;
use Session;
use Auth;
use DB;
use Company;
use Redirect;
use App\User;
use App\UserProfile;
use App\Employee;
use App\Attendance;
use Illuminate\Support\Facades\File;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}
	function getLogin() {
		return view ( 'auth.login' );
	}
	
	function postLogin() {		
		$rules = array (
				'email' => 'required|email',
				'password' => 'required' 
		);
		
		$validator = Validator::make ( Input::all (), $rules );
		
		if ($validator->fails ()) {
			return redirect ( 'auth/login' )->withErrors ( $validator );
		}
		
		// set the remember me cookie if the user check the box
		$remember = (Input::has ( 'remember' )) ? true : false;
		$auth = Auth::attempt ( array (
				'email' => strtolower ( Input::get ( 'email' ) ),
				'password' => Input::get ( 'password' ),
				'active' => 1 
		), $remember );
		if ($auth) {
			$email =Auth::user()->email;
			$employee = User::find(Auth::user()->id)->employee; 
			Session::put ( 'first_name', $employee->first_name );
			Session::put ( 'last_name', $employee->last_name );
			Session::put ( 'email', Auth::user ()->email );
			// $photo = asset ( 'img/no_image.png' );
			if($employee->photo)
			{
				if ($employee->photo) {
					$path = 'uploads/' . $employee->photo;
			 		if (File::exists ( $path )) {
			 				$grav_url = asset ( $path );
			 		}
			 	}
			}
			else{
				$grav_url = SELF::get_gravatar( $email);
			}
			$user = User::find ( Auth::user ()->id );	
			Session::put ( 'profile_pic', $grav_url );
			if($employee->company->logo){
				$logo_path = 'uploads/' . $employee->company->logo;
						if (File::exists ( $logo_path)) {
							$company_logo = asset ( $logo_path);
							Session::put('company_logo',$company_logo);
						}
			}
			else{
				Session::put('company_name',$employee->company->title);
			}
			$date=date('Y-m-d');
			Session::put('in_time',1);
			$employee_id=$user->employee->id;
			$attendance=DB::select(DB::raw("SELECT * FROM attendances WHERE employee_id=$employee_id AND in_time LIKE '%".$date."%'"));
			if(isset($attendance[0]->in_time)){
				Session::forget('in_time');
			}
			$lastlogin = Auth::user ()->lastlogin != "" ? Auth::user ()->lastlogin : Auth::user ()->created_at;
			Session::put ( 'lastlogin', date ( 'd M, Y @ h:i:s a', strtotime ( $lastlogin ) ) );
			
			$user->lastlogin = date ( 'Y-m-d H:i:s' );
			$user->save ();
			return redirect ()->intended ( 'dashboard' );
		} else {
			$message = "<div class='alert alert-danger alert-dismissible' role='alert'>
						 <button type='button' class='close' data-dismiss='alert' ></button>
						 Wrong username or password!</div>";	
		}
		Session::flash ( 'flash_message', $message );
		return Redirect::to ( 'auth/login' )->withInput ( Input::except ( 'password' ) );
	}
	function getLogout() {
		Auth::logout ();
		return Redirect::to ( 'auth/login' );
	}
	
	function get_gravatar( $email ) {
    $url = 'http://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    return $url;
}

}

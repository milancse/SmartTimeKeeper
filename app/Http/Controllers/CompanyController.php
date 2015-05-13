<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Input;
use Redirect;
use Illuminate\Http\Request;
use App\Company;
use App\User;
use Session;
use File;
//use App\library\globalFunctions;
class CompanyController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct()
	{
		$this->middleware('auth');
	} 
	public function index()
	{
		$company=Company::all();
		
		return view('company.index')->with('company',$company);
		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$company=Company::all();
		return view('company.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//$globalObj=new globalFunctions();
		$rules=array(
			'title'=>'required',
			'mobile'=>'required|numeric',
			'office_start_time'=>'required',
			'office_end_time'=>'required',
			'office_time_zone'=>'required',
			'email'=>'required|email',
			'logo'=>'mimes:jpeg,jpg,png|max:800'
			
			);
		$validator = Validator::make(Input::all(), $rules);
		if($validator->fails()){
			return Redirect::to('company/create')
                ->withErrors($validator)->withInput ();
		}
		else{
			
			$company=new Company;
			$company->title=Input::get('title');
			$company->office_time_zone=Input::get('office_time_zone');
			$company->office_start_time=Input::get('office_start_time');
			$company->office_end_time=Input::get('office_end_time');
			$company->address=Input::get('address');
			$company->phone=Input::get('phone');
			$company->mobile=Input::get('mobile');
			$company->email=Input::get('email');
			$company->fax=Input::get('fax');
			$company->web=Input::get('web');
			$company->active=Input::get('active');
			$filename="";
			if(Input::file('logo'))
			{
				$logo_name=Input::file('logo');
				$destinationPath='uploads/';
				$filename = date ( 'ymdhis' ) . '.' . $logo_name->guessClientExtension ();
				Input::file ( 'logo' )->move ( $destinationPath, $filename );
				
			}

			$company->logo=$filename;
			if($company->save())
			{
					
				$user=User::find(Auth::user()->id);
				if($user->employee->company->logo)
				{
					$path='uploads/'.$company->logo;
					Session::put('company_logo',asset($path));
				}
				else{
					Session::put('company_name',$user->employee->company->title);
				}

				$message="<div class='alert alert-success alert-dismissible' role='alert'>
						 <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
						 Company Created Successfully!.</div>";	
					
			}
			else{
				$message="<div class='alert alert-danger alert-dismissible' role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
						 Company has not created successfully!.</div>";
			}
			Session::flash('message', $message);
		    return Redirect::to('company');
		}
		
		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$company=Company::find($id);
		return view('company.company_details')->with('company',$company);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$company=Company::find($id);

		if($company->logo)
		{
			
			$path='uploads/'.$company->logo;
			if (File::exists ( $path )) {
			$photo = "<img src='" . asset ( $path ) . "'/>";
			$company->logo=$photo;
			}

		}
		
		return view('company.create')->with('company',$company);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		
		$rules=array(
			'title'=>'required',
			'mobile'=>'required|numeric',
			'office_start_time'=>'required',
			'office_end_time'=>'required',
			'office_time_zone'=>'required',
			'email'=>'required|email',
			'logo'=>'mimes:jpeg,jpg,png|max:1024'
			
			);
		$validator = Validator::make(Input::all(), $rules);
		if($validator->fails()){
			return Redirect::to('company/create')
                ->withErrors($validator)->withInput ();
		}
		else{
			$company=Company::find($id);
			$company->title=Input::get('title');
			$company->office_time_zone=Input::get('office_time_zone');
			$company->office_start_time=Input::get('office_start_time');
			$company->office_end_time=Input::get('office_end_time');
			$company->address=Input::get('address');
			$company->phone=Input::get('phone');
			$company->mobile=Input::get('mobile');
			$company->email=Input::get('email');
			$company->fax=Input::get('fax');
			$company->web=Input::get('web');
			$company->active=Input::get('active');
			$filename="";
			if(Input::file('logo'))
			{
				$logo_name=Input::file('logo');
				$destinationPath='uploads/';
				$filename = date ( 'ymdhis' ) . '.' . $logo_name->guessClientExtension ();
				Input::file ( 'logo' )->move ( $destinationPath, $filename );
				if ($company->logo) {
					$photo_name = $company->logo;
					$path = 'uploads/' . $photo_name;
					if (File::exists ( $path )) {
						unlink ( $path );
					}
				}	
			}

			else {
				if(Input::get('photo_id')=="")
				{
					if ($company->logo) {
						$photo_name = $company->logo;
						$path = 'uploads/' . $photo_name;
						if (File::exists ( $path )) {
							unlink ( $path );
						}
					}

				}
				else{
					$filename=$company->logo;
				}

			}	
			$company->logo=$filename;
			if($company->save())
			{
				
				$user=User::find(Auth::user()->id);
				if($user->employee->company->logo)
				{
					$path='uploads/'.$user->employee->company->logo;
					Session::put('company_logo',asset($path));

				}
				else{
					Session::forget('company_logo');
					Session::put('company_name',$user->employee->company->title);

				}
				
				$message="<div class='alert alert-success alert-dismissible' role='alert'>
					 <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					 Company has benn updated Successfully!.</div>";	
					
				
			}
			else{
				$message="<div class='alert alert-danger alert-dismissible' role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					 Company has not been updated!.</div>";
			}
			Session::flash('message',$message);
		    return Redirect::to('company');
		}
		
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

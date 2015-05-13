<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model {

	public function employee(){

	}

	public function company(){
		return $this->belongsTo('App\Company');
	}
	public function department(){
		return $this->belongsTo('App\Depertment');
	}
	public function designation(){
		return $this->belongsTo('App\Designation');
	}

	public function attendance(){
		return $this->hasMany('App\Attendance');
	}
	

}

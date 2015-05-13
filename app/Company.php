<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {

	public function holiday(){
		return $this->hasMany('App\Public_Holiday');
	}

}

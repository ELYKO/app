<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model {

	public $timestamps = false;

	public function uv()
	{
		return $this->belongsTo('App\UV');
	}

	public function students()
	{
		return $this->belongsToMany('App\Student');
	}
}
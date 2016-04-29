<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uv extends Model {

	protected $table = 'uvs';
	public $timestamps = false;

	public function evaluations()
	{
		return $this->hasMany('App\Evaluation');
	}

	public function students()
	{
		return $this->belongsToMany('App\Student')->withPivot('grade');
	}
}
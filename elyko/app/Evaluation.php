<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model {

	public $timestamps = false;
	protected $hidden = ['pivot'];

	public function uv()
	{
		return $this->belongsTo('App\Uv');
	}

	public function students()
	{
		return $this->belongsToMany('App\Student')->withPivot('note');
	}
}
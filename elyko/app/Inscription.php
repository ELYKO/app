<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model {

	protected $table = 'student_uv';
	public $timestamps = false;
    protected $fillable = array('uv_id', 'student_id', 'grade');
    
}
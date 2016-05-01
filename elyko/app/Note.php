<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model {

	protected $table = 'evaluation_student';
	public $timestamps = false;
	protected $fillable = array('evaluation_id', 'student_id', 'note');

}
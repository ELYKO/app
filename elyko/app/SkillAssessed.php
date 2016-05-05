<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SkillAssessed extends Model {

	protected $table = 'skill_student';
	public $timestamps = false;
	protected $fillable = array('skill_id', 'student_id', 'value');

}
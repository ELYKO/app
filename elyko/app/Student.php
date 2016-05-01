<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model {

	// Pas de colonnes created_at and update_at (true par default)
	public $timestamps = false;
    // Permet de creer des students en une seule ligne
	protected $fillable = array('id', 'last_name', 'name', 'email', 'login');

	protected $hidden = ['pivot'];

	public function uvs()
	{
		// Declaration de la cle etrangere de inscription (student_uv)
		return $this->belongsToMany('App\Uv')->withPivot('grade');
	}

	public function evaluations()
	{
		// Declaration de la cle etrangere de note (student_evaluation)
		return $this->belongsToMany('App\Evaluation')->withPivot('note');
	}

	public function skill()
	{
		// Declaration de la cle etrangere de skillAssessed (skill_evaluation)
		return $this->belongsToMany('App\Skill');
	}
	
}
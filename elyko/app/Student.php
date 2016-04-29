<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model {
	
	public $timestamps = false; //pas de colonnes created_at and update_at
								//true par default
	protected $hidden = ['pivot'];

	public function uvs()
	{
		return $this->belongsToMany('App\Uv')->withPivot('grade'); //declaration de la cle etrangere de inscription=etudiant_uv
	}										//Un etudiant peut etre inscrit a plusieurs UV

    public function evaluations()
    {
        return $this->belongsToMany('App\Evaluation')->withPivot('note');//declaration de la cle etrangere de note=etudiant_evaluation
	}										//Un etudiant peut etre avoir articipe a plusieurs evaluations

}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model {
	
	public $timestamps = false; //pas de colonnes created_at and update_at
								//true par default

	public function uvs()
	{
		return $this->belongsToMany('App\UV'); //declaration de la cle etrangere de inscription=etudiant_uv
	}										//Un etudiant peut etre inscrit a plusieurs UV

    public function evalution()
    {
        return $this->belongsToMany('App\Evaluation');//declaration de la cle etrangere de note=etudiant_evaluation
	}										//Un etudiant peut etre avoir articipe a plusieurs evaluations

}
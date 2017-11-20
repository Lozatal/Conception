<?php

namespace application\model;

class Simulation extends \Illuminate\Database\Eloquent\Model{

	protected 	$table		= 'simulation';
	protected 	$primaryKey	= 'id';
	public		$timestamps	= false;

	public function historiques(){
		return $this->hasMany('application\model\Historique', 'simu_id');
	}
	public function user(){
		return $this->belongsTo('application\model\User', 'user_id');
	}
}

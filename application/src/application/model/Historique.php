<?php

namespace application\model;

class Historique extends \Illuminate\Database\Eloquent\Model{

	protected 	$table		= 'historique';
	protected 	$primaryKey	= 'id';
	public		$timestamps	= false;

	public function simulation(){
		return $this->belongsTo('application\model\Simulation', 'simu_id');
	}
}

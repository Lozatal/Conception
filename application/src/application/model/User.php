<?php

namespace application\model;

class User extends \Illuminate\Database\Eloquent\Model{

	protected 	$table		= 'user';
	protected 	$primaryKey	= 'id';
	public		$timestamps	= false;

	public function simulations(){
		return $this->hasMany('application\model\Simulation', 'user_id');
	}
}

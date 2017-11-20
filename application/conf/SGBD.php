<?php

class SGBD{
	private static $config, $db;

	public static function setConfig($nomFichier){
		self::$config=parse_ini_file("config.ini");
	}

	public static function makeConnection(){
		if(!isset($db)){
			$host=self::$config['host'];
			$base=self::$config['base'];
			$user=self::$config['user'];
			$pass=self::$config['pass'];
			$dsn = "mysql:host=$host;dbname=$base";
			self::$db=new PDO($dsn, $user, $pass);
			return self::$db;
		}else{
			return self::$db;
		}
	}
}

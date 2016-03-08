<?php

namespace phpeffi\database;

use phpeffi\conf\DatabaseConfiguration;
abstract class PdoDialect extends \PDO {
	public static function getPdo($config){
		if(is_array($config)){
			$config = new DatabaseConfiguration('runtime');
		}else{
			
		}
	}
	public abstract function getConditionInstance();
}
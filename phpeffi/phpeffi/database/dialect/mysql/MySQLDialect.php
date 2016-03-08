<?php

namespace phpeffi\database\dialect\mysql;

use phpeffi\database\PdoDialect;

class MySQLDialect extends PdoDialect {
	public function getConditionInstance() {
		return new MySQLCondition ();
	}
}
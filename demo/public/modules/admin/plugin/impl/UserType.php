<?php

namespace admin\plugin\impl;

use admin\plugin\IUserTypeAlter;
use phpeffi\plugin\Hook;

class UserType extends Hook implements IUserTypeAlter {
	public function alter($type) {
		return $type.' UserType';
	}
	public function getPriority($method) {
		return 1;
	}
}

?>
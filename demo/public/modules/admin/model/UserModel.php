<?php

namespace admin\model;

use phpeffi\plugin\Trigger;
use admin\plugin\IUserTypeAlter;

class UserModel extends Trigger implements IUserTypeAlter {
	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \admin\plugin\IUserTypeAlter::alter()
	 */
	public function alter($type) {
		$type = $this->delegateAlter ( 'alter', array ($type ) );
		return $type;
	}
}

?>
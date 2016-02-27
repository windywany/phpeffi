<?php

namespace admin\model;

use admin\plugin\IUserTypeAlter;
use phpeffi\plugin\Trigger;
use admin\plugin\IAdminTypeAlter;

class UserTypeModel extends Trigger implements IUserTypeAlter, IAdminTypeAlter {
	public function alter($type) {
		return $this->delegateAlter ( 'alter', array ($type ) );
	}
	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \admin\plugin\impl\IAdminTypeAlter::alterAdminType()
	 */
	public function alterAdminType($type) {
		return $this->delegateAlter ( __FUNCTION__, array ($type ) );
	}
}

?>
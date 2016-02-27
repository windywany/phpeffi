<?php

namespace admin\others;

use admin\plugin\IUserTypeAlter;
use admin\plugin\IAdminTypeAlter;
use phpeffi\plugin\Hook;

class OthersClass extends Hook implements IUserTypeAlter, IAdminTypeAlter {
	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \admin\plugin\IUserTypeAlter::alter()
	 */
	public function alter($type) {
		return $type . ' OthersClass';
	}
	
	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \admin\plugin\impl\IAdminTypeAlter::alterAdminType()
	 */
	public function alterAdminType($type) {
		return $type . ' OthersClass';
	}
}
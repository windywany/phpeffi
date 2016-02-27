<?php

namespace admin\plugin;

interface IUserTypeAlter {
	/**
	 * 数据变更器.
	 *
	 * @param array $type        	
	 * @return array
	 */
	function alter($type);
}
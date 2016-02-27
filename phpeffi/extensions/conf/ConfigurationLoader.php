<?php

namespace extensions\conf;

use phpeffi\conf\BaseConfigurationLoader;
use phpeffi\conf\Configuration;

/**
 * 系统默认配置加载器.
 *
 * @author leo
 *        
 */
class ConfigurationLoader extends BaseConfigurationLoader {
	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \phpeffi\conf\BaseConfigurationLoader::loadConfig()
	 */
	public function loadConfig($name = 'default') {
		$config = new Configuration ( $name );
		if ($name == 'default') {
			$__phpeffi_config_file = APPROOT . CONF_DIR . '/config.php';
		} else {
			$__phpeffi_config_file = APPROOT . CONF_DIR . '/' . $name . '_config.php';
		}
		if (is_file ( $__phpeffi_config_file )) {
			include $__phpeffi_config_file;
		}
		return $config;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \phpeffi\conf\BaseConfigurationLoader::loadDatabaseConfig()
	 */
	public function loadDatabaseConfig($name = '') {
		// TODO Auto-generated method stub
	}
}
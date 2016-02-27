<?php

namespace extensions\app;

use phpeffi\app\IModuleLoader;

class ModuleLoader implements IModuleLoader {
	public function load() {
		$it = new \DirectoryIterator ( MODULE_ROOT );
		foreach ( $it as $dir ) {
			if ($dir->isDot ()) {
				continue;
			}
			if ($dir->isDir ()) {
				$boot = MODULE_ROOT . $dir->getFilename () . '/bootstrap.php';
				if (is_file ( $boot )) {
					include $boot;
				}
			}
		}
	}
	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \phpeffi\app\IModuleLoader::loadClass()
	 */
	public function loadClass($module, $file) {
		$clf = MODULE_ROOT . $file;
		if (is_file ( $clf )) {
			return $clf;
		}
		return null;
	}
}
<?php

namespace phpeffi\mvc;

abstract class Controller {
	public function __construct() {
	}
	protected function beforeRun($method) {
	}
	protected function postRun($mehtod, $view) {
		return $view;
	}
}
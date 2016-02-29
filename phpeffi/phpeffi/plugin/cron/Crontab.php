<?php

namespace phpeffi\plugin\cron;

use phpeffi\plugin\Trigger;

class Crontab extends Trigger implements ICronjob {
	public function run($time) {
		$this->delegateFire ( 'run', array ($time ) );
	}
}

<?php

namespace phpeffi\plugin\cron;

interface ICronjob {
	function run($time);
}
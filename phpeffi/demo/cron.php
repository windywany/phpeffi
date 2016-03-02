<?php
/**
 * CRONTAB SCRIPT.
 */
require __DIR__ . '/bootstrap.php';

$crontab = new phpeffi\plugin\cron\Crontab ();

$crontab->run ( time () );

//that's all.
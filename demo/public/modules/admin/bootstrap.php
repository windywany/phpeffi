<?php
use phpeffi\plugin\Trigger;

// admin module bootstrap.php
phpeffi\app\App::register ( 'admin' );
// 注册插件.
Trigger::bind ( 'admin\plugin\impl\UserType' );
Trigger::bind ( 'admin\others\OthersClass' );


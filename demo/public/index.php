<?php
use phpeffi\app\App;
// web 入口路由
define ( 'WWWROOT', __DIR__ . '/' );
require WWWROOT . '../bootstrap.php';
App::route ();
//就这么多了
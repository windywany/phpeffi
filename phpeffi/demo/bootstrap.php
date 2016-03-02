<?php
/**
 * 应用ID,多个应用ID不能重复.
 * @var string
 */
define ( 'APPID', 1 );
// /////////////////////////////////////////////////////
// 以下配置选择性修改
/* 如果你想改modules目录名，请取消下一行注释并修改其值. */
// define ( 'MODULE_DIR', 'modules' );
/* 如果你想改conf目录名，请取消下一行注释并修改其值. */
// define ( 'CONF_DIR', 'conf' );
/* 如果你想改libs目录名，请取消下一行注释并修改其值. */
// define ( 'LIBS_DIR', 'libs' );
/* 如果你想改APPNAME值，请取消下一行注释并修改其值. */
// define ( 'APPNAME', 'appname' )
/* 重新定义运行时内存限制 */
// define ( 'RUNTIME_MEMORY_LIMIT', '128M' );
// 以上配置选择性修改
// ///////////////////////////////////////////////////////
//
//
// ///////////////////////////////////////////////////////
// !!!!!!!!!!!!!以下内容不可修改!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
/**
 * 应用根目录.
 *
 * @var string
 */
define ( 'APPROOT', __DIR__ . '/' );
// 加载composer的autoload.
require APPROOT . 'phpeffi/bootstrap.php';
// end of bootstrap.php
//////////////////////////////////////////////////////////
<?php
use phpeffi\app\App;
/**
 * bootstrap file of phpeffi framework.
 *
 * @author leo
 */
defined ( 'WWWROOT' ) or die ( 'please define WWWROOT' );
/**
 * 版本号.
 *
 * @var string
 */
define ( 'PHPEFFI_VERSION', 'O.1.0' );
/**
 * 发行标记.
 *
 * @var string
 */
define ( 'PHPEFFI_RELEASE', 'dev' );
/* 常用目录定义 */
defined ( 'PHPEFFI_ROOT' ) or define ( 'PHPEFFI_ROOT', __DIR__ . '/' );
defined ( 'MODULE_DIR' ) or define ( 'MODULE_DIR', 'modules' );
defined ( 'CONF_DIR' ) or define ( 'CONF_DIR', 'conf' );
defined ( 'LIBS_DIR' ) or define ( 'LIBS_DIR', 'libs' );
defined ( 'VENDORS_DIR' ) or define ( 'VENDORS_DIR', 'vendor' );
defined ( 'PLUGINS_DIR' ) or define ( 'PLUGINS_DIR', 'plugins' );
defined ( 'APPNAME' ) or define ( 'APPNAME', basename ( APPROOT ) );

define ( 'MODULE_ROOT', WWWROOT . MODULE_DIR . '/' );
/* 定义日志级别 */
define ( 'DEBUG_OFF', 5 );
define ( 'DEBUG_ERROR', 4 );
define ( 'DEBUG_INFO', 3 );
define ( 'DEBUG_WARN', 2 );
define ( 'DEBUG_DEBUG', 1 );

// 过滤输入
if (@ini_get ( 'register_globals' )) {
	die ( 'please close "register_globals" in php.ini file.' );
}
if (version_compare ( '5.3.9', phpversion (), '>' )) {
	die ( sprintf ( 'Your php version is %s,but PHPEffi required  PHP 5.3.9 or higher', phpversion () ) );
}
// 运行时间
if (defined ( 'MAX_RUNTIME_LIMIT' )) {
	set_time_limit ( intval ( MAX_RUNTIME_LIMIT ) );
}
// 运行内存
if (! defined ( 'RUNTIME_MEMORY_LIMIT' )) {
	define ( 'RUNTIME_MEMORY_LIMIT', '128M' );
}
if (function_exists ( 'memory_get_usage' ) && (( int ) @ini_get ( 'memory_limit' ) < abs ( intval ( RUNTIME_MEMORY_LIMIT ) ))) {
	@ini_set ( 'memory_limit', RUNTIME_MEMORY_LIMIT );
}
// 必须安装 mb_string
if (! function_exists ( 'mb_internal_encoding' )) {
	die ( 'mb_string extension is required!' );
}
// 必须安装 json
if (! function_exists ( 'json_decode' )) {
	die ( 'json extension is required!' );
}
// 必须安装 SPL
if (! function_exists ( 'spl_autoload_register' )) {
	die ( 'SPL extension is required!' );
}
/* 开启缓冲区 (特别重要) */
@ob_start ();

/* 应用编码只支持UTF8 */
mb_internal_encoding ( 'UTF-8' );
mb_regex_encoding ( 'UTF-8' );
/* 关掉session以下二个特性 */
@ini_set ( 'session.bug_compat_warn', 0 );
@ini_set ( 'session.bug_compat_42', 0 );
/* 类自动加载与注册类自动加载函数. */
$_phpeffi_classpath = array ();
$_phpeffi_namespace_classpath = array ();
$_phpeffi_namespace_classpath [] = APPROOT;
$_phpeffi_namespace_classpath [] = PHPEFFI_ROOT;
if (is_dir ( APPROOT . VENDORS_DIR )) {
	$_phpeffi_namespace_classpath [] = APPROOT . VENDORS_DIR . '/';
}
$_phpeffi_namespace_classpath [] = PHPEFFI_ROOT . 'vendors/';

unset ( $app_vendors );
/* 自定义类路径 */
include PHPEFFI_ROOT . 'vendors/classpath.php';
/* 加载运行时缓存 */
include PHPEFFI_ROOT . 'phpeffi/cache/RtCache.php';
/* 注册类自定义加载函数 */
spl_autoload_register ( function ($clz) {
	if (strpos ( $clz, '\\' ) > 0) {
		global $_phpeffi_namespace_classpath;
		if (defined ( 'PHPEFFI_BOOTSTRAPPED' )) {
			$clz_file = App::loadClass ( $clz );
			if ($clz_file) {
				include $clz_file;
				return;
			}
		}
		$clzf = str_replace ( '\\', '/', $clz );
		foreach ( $_phpeffi_namespace_classpath as $cp ) {
			$clz_file = $cp . $clzf . '.php';
			if (is_file ( $clz_file )) {
				include $clz_file;
				return;
			}
		}
	}
	global $_phpeffi_classpath;
	foreach ( $_phpeffi_classpath as $path ) {
		$clz_file = $path . '/' . $clz . '.php';
		if (is_file ( $clz_file )) {
			include $clz_file;
			return;
		}
	}
	// 处理未找到类情况.
} );
$app_vendors = APPROOT . VENDORS_DIR . '/autoload.php';
if (is_file ( $app_vendors )) {
	include $app_vendors;
}
/* 加载第三方函数库 */
if (is_file ( APPROOT . LIBS_DIR . '/common.php' )) {
	require APPROOT . LIBS_DIR . '/common.php';
}
require PHPEFFI_ROOT . 'libs/common.php';

App::run ();
define ( 'PHPEFFI_BOOTSTRAPPED', time () );

<?php

namespace phpeffi\app;

/**
 * 模块管理器.
 *
 * @author leo
 *        
 */
class App {
	private $dbConfigs = array ();
	private $configs = array ();
	private $router;
	private $configLoader;
	private $moduleLoader;
	private static $maps = array ('dir2id' => array (),'id2dir' => array () );
	private static $modules = array ();
	private static $app = false;
	private function __construct() {
		/* 加载配置文件 */
		$configLoader = new \extensions\conf\ConfigurationLoader ();
		if ($configLoader instanceof \phpeffi\conf\BaseConfigurationLoader) {
			$configLoader->beforeLoad ();
		} else {
			trigger_error ( 'wrong configuration loader provided~', E_USER_ERROR );
		}
		$this->configs ['default'] = $configLoader->loadConfig ();
		$configLoader->postLoad ();
		$this->configLoader = $configLoader;
		// 加载模块
		$moduleLoader = new \extensions\app\ModuleLoader ();
		
		$moduleLoader->load ( $this );
		
		$this->moduleLoader = $moduleLoader;
		
		self::$app = $this;
	}
	/**
	 * 启动App.
	 *
	 * @return App
	 */
	public static function run() {
		if (! self::$app) {
			self::$app = new App ();
		}
		return self::$app;
	}
	/**
	 * 加载数据库.
	 *
	 * @param string $name
	 *        	数据库配置,默认为default.
	 */
	public static function db($name = 'default') {
	}
	/**
	 * 读取配置.
	 *
	 * @param string $name
	 *        	配置项名.
	 * @param string $config
	 *        	配置.
	 * @return mixed 配置值.
	 */
	public static function cfg($name, $config = 'default') {
		$app = self::$app;
		if (isset ( $app->configs [$config] )) {
			$confObj = $app->configs [$config];
		} else {
			$confObj = $app->configLoader->loadConfig ( $config );
			$app->configs [$config] = $confObj;
		}
		return $confObj->get ( $name );
	}
	/**
	 * 注册模块.
	 *
	 * @param string $name
	 *        	模块名,只能是英文字母.
	 * @param unknown $file        	
	 */
	public static function register($name, $file = null) {
		$name = strtolower ( $name );
		if ($name == 'phpeffi') {
			trigger_error ( 'the name of module cannot be phpeffi!', E_USER_ERROR );
		}
		if (! preg_match ( '/^[a-z]+$/', $name )) {
			trigger_error ( 'the name of module must be made of "a-z"' );
		}
		if (! $file) {
			$file = debug_backtrace ( ~ DEBUG_BACKTRACE_IGNORE_ARGS, 1 );
			$file = $file [0] ['file'];
		}
		$path = dirname ( $file );
		$dir = basename ( $path );
		if ($dir != $name) {
			self::$maps ['dir2id'] [$dir] = $name;
			self::$maps ['id2dir'] [$name] = $dir;
		}
		self::$modules [$dir] = $path;
	}
	
	/**
	 * 加载模块中定义的类.
	 *
	 * @param string $cls        	
	 * @return mixed 类文件全路径.
	 */
	public static function loadClass($cls) {
		$pkg = explode ( '\\', $cls );
		if (count ( $pkg ) > 1) {
			$module = $pkg [0];
			if (isset ( self::$maps ['id2dir'] [$module] )) {
				$pkg [0] = self::$maps ['id2dir'] [$module];
				echo 'map';
			}
			$file = implode ( '/', $pkg ) . '.php';
			return self::$app->moduleLoader->loadClass ( $module, $file );
		} else {
			return null;
		}
	}
	/**
	 * 路由
	 */
	public static function cli($url, $context = '') {
	}
	public static function route($content = '') {
		if (! isset ( $_SERVER ['REQUEST_URI'] )) {
			trigger_error ( 'Your web server did not provide REQUEST_URI, stop route request.', E_USER_ERROR );
		}
		if (! self::$app->router) {
			self::$app->router = new Router ( $content, self::$modules );
		}
		self::$app->router->route ( $_SERVER ['REQUEST_URI'] );
	}
}
<?php

namespace phpeffi\app;

/**
 * 路由器.
 *
 * @author leo
 *        
 */
class Router {
	private $modules;
	private $contextPath;
	private $url;
	private $parsedURL;
	private $uri;
	private $args = array ();
	private $xssCleaner;
	public function __construct($contextPath = '', $modules = null) {
		$this->contextPath = $contextPath;
		$this->modules = $modules;
		$this->xssCleaner = new \ci\XssCleaner ();
	}
	/**
	 * 将URL路由到module/controller/action.
	 *
	 * @param string $url        	
	 */
	public function route($uri) {
		$this->uri = $uri;
		$this->url = parse_url ( $uri, PHP_URL_PATH );
		$args = parse_url ( $uri, PHP_URL_QUERY );
		if ($args) {
			parse_str ( $args, $this->args );
			$this->xssCleaner->xss_clean ( $this->args );
		}
		if ($this->url) {
			$url = trim ( $this->url, '/' );
			$this->parse ( $url );
		} else {
			return 404;
		}
	}
	private function parse($url) {
		if (empty ( $url )) {
			$this->parsedURL ['url'] = 'index.html';
			$this->parsedURL ['page'] = 1;
		} else {
		}
	}
}
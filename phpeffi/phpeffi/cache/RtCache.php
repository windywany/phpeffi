<?php

namespace phpeffi\cache;

/* 运行时缓存 */
class RtCache {
	private static $SUFFIX = false;
	public static function initialize($appid) {
		if (self::$SUFFIX == false) {
			self::$SUFFIX = '@' . $appid;
		}
	}
}
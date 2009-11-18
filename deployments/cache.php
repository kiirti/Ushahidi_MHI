<?php defined('SYSPATH') or die('No direct script access.');

/**
* CACHE CONFIGURATION
*/

$site = array_shift(explode(".", $_SERVER['HTTP_X_FORWARDED_HOST']));
// make the cache dir, if its not already present.
$cache_location = APPPATH.'cache'."/$site";
if (!is_dir($cache_location)){
  mkdir($cache_location);
}

/**
 * Enable or disable file caching. This makes pages display faster
 * but can take a large amount of storage space on larger sites
 */
$config['cache_pages'] = TRUE;



/**
 * CONFIGURATION
 * 'file' driver can be substituted for:
 *  -> Memcache - Memcache is very high performance, but prevents cache tags from being used.
 *  -> APC - Alternative Php Cache
 *  -> Eaccelerator
 *  -> Xcache
 */
$config['default'] = array(
	'driver' => 'file',
	'params' => $cache_location,
	'lifetime' => 1800,
	'requests' => 1000
);

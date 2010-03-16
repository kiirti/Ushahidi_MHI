<?php defined('SYSPATH') or die('No direct script access.');

/**
* CACHE CONFIGURATION
*/

/**
 * Enable or disable file caching. This makes pages display faster
 * but can take a large amount of storage space on larger sites
 */
$config['cache_pages'] = TRUE;

if (@!is_writable(APPPATH.'cache')) {
	$config["cache_pages"] = FALSE;
}

// MHI: cache each instance seperatly.
$site = array_shift(explode(".", $_SERVER['HTTP_HOST']));
$cache_location = APPPATH.'cache'."/$site";
if ($config['cache_pages'] && !is_dir($cache_location)){
    mkdir($cache_location);
}

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

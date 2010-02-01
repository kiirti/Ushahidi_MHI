<?php defined('SYSPATH') or die('No direct script access.');

/**
* SITE CONFIGURATIONS
*/

$config = array
(
	'site_name' => 'Ushahidi MHI',
    'base_subdomain' => 'development',
    'base_replace' => '.development',
    'hosting_domain' => '.development.kiirti.org',
    'deployments' => '/root/kiirti/multiple/deployments',
    'instance_dbhost' => 'localhost',
    'create_db' => '/scripts/create_instance.sh',
    'create_db_log' => '/tmp/kiirti.log',
	'site_email' => '',
	'default_map' => '',
	'api_google' => '',
	'api_yahoo' => '',
	'default_city' => '',
	'default_country' => '',
	'default_lat' => '',
	'default_lon' => '',
	'default_zoom' => '',
	'items_per_page' => '20',
	'items_per_page_admin' => '20',
	'api_url' => '<script src="http://maps.google.com/maps?file=api&v=2&key=" type="text/javascript"></script>',
	'api_url_all' => ''
);

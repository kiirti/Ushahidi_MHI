<?php defined('SYSPATH') or die('No direct script access.');

/**
* SITE CONFIGURATIONS
*/

$config = array
(
    'site_name' => 'Ushahidi MHI',
    'base_subdomain' => 'www',
    'base_replace' => '',
    'hosting_domain' => '.kiirti.org',
    'deployments' => '/root/kiirti/multiple/deployments',
    'instance_dbhost' => 'kiirtidb.c4iuunoxp2j3.us-east-1.rds.amazonaws.com',
    'create_db' => '/scripts/create_instance.sh',
    'create_db_log' => '/mnt/kiirti/logs/kiirti_create_db.log',
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

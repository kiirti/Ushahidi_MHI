<?php defined('SYSPATH') or die('No direct script access.');

/**
* SITE CONFIGURATIONS
*/

$config = array
(
	'site_name' => 'Ushahidi MHI',
    'audio_storage' => 'audio/',
    'audio_mturk_script' => 'scripts/post_hit.pl',
    'audio_mturk_url' => 'http://mechanicalturk.sandbox.amazonaws.com/?Service=AWSMechanicalTurkRequester',
    'audio_mturk_preview_url' => 'https://workersandbox.mturk.com/mturk/preview?groupId=',
    'aws_id' => '00CZG39W7HKJJ455FGR2',
    'aws_sec_id' => 'eDpg/25S+8SBHiLpVmsCBgMfo2lcBwlsr131vdoa',
    'audio_question' => 'scripts/questions/incident_1-0.question',
    'hosting_domain' => '.kiirti.org',
    'deployments' => '/root/kiirti/multiple/deployments',
    'instance_dbhost' => 'kiirtidb.c4iuunoxp2j3.us-east-1.rds.amazonaws.com',
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

<?php defined('SYSPATH') or die('No direct script access.');

/**
* SITE CONFIGURATIONS
*/

$config = array
(
    'hosting_domain' => '.kiirti.org',
    'deployments' => '/root/kiirti/multiple/deployments',
    'instance_dbhost' => 'kiirtidb.c4iuunoxp2j3.us-east-1.rds.amazonaws.com',
    'create_db' => '/scripts/create_instance.sh',
    'create_db_log' => '/mnt/kiirti/logs/kiirti.log',
    'audio_err_log' => '/mnt/kiirti/logs/kiirti_audio.err',
    'base_subdomain' => 'www',
    'base_replace' => '',
    'user'     => 'emoksha',
    'password' => 'em0ksh2',
    'host'     => 'kiirtidb.c4iuunoxp2j3.us-east-1.rds.amazonaws.com',
    'port'     => '3306',
    'database' => 'mhidb'
);

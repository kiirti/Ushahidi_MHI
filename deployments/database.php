<?php defined('SYSPATH') or die('No direct script access.');
/**

Sets the db, if the db is setup for the right MHI instance.

*/

$site = array_shift(explode(".", $_SERVER['HTTP_X_FORWARDED_HOST']));

$mhi_db = array(
  'user'     => 'mhiuser',
  'password' => 'mhiword',
  'host'     => 'localhost',
  'port'     => '3306',
  'database' => 'mhi'
);

$mhi_link = mysql_connect($mhi_db['host'].':'.$mhi_db['port'], $mhi_db['user'], $mhi_db['password']);
mysql_select_db($mhi_db['database']);

## get the current instance
#$db = Database::instance();
#$res = $db->getwhere('sites', array('sitename' => $site));

$settings = array
(
  'benchmark'     => TRUE,
  'persistent'    => FALSE,
  'connection'    => array
    (
    'type'     => 'mysql',
    'user'     => 'user',
    'pass'     => 'word',
    'host'     => 'localhost',
    'port'     => FALSE,
    'socket'   => FALSE,
    'database' => ''
    ),
  'character_set' => 'utf8',
  'table_prefix'  => '',
  'object'        => TRUE,
  'cache'         => FALSE,
  'escape'        => TRUE
);
$good = false;
$approved = false;

// Get the settings for this site.
$query = sprintf ("SELECT * FROM `sites` WHERE subdomain = '%s'", mysql_real_escape_string($site));
$result = mysql_query($query);

if (!$result){
  print (mysql_error());
  exit;
}

while($row = mysql_fetch_assoc($result)){
  $settings['connection']['type'] = $row['dbtype'];
  $settings['connection']['user'] = $row['dbuser'];
  $settings['connection']['pass'] = $row['dbpass'];
  $settings['connection']['host'] = $row['dbhost'];
  $settings['connection']['port'] = $row['dbport'];
  $settings['connection']['socket'] = $row['dbsocket'];
  $settings['connection']['database'] = $row['dbdatabase'];
  $approved = $row['is_approved'];
  $good = true;
}

mysql_close($mhi_link);

if (!$good){
  url::redirect('http://www.kiirti.org');
} else if (!$approved) {
  print("This site is not yet approved. Check back soon.");  
  exit;
} else {
  $config['default'] = $settings;
}

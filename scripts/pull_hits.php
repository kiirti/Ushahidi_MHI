<?php

// Pulls the finished hits down for each db.

$mhi_db = array(
  'user'     => 'emoksha',
  'password' => 'em0ksh2',
  'host'     => 'kiirtidb.c4iuunoxp2j3.us-east-1.rds.amazonaws.com',
  'port'     => '3306',
  'database' => 'mhidb'
);

$mhi_link = mysql_connect($mhi_db['host'].':'.$mhi_db['port'], $mhi_db['user'], $mhi_db['password']);
mysql_select_db($mhi_db['database']);

$query = sprintf ("SELECT id,dbdatabase,subdomain FROM `sites` WHERE is_approved AND is_public");
$result = mysql_query($query);

if (!$result){
  print (mysql_error());
  exit;
}

while($row = mysql_fetch_assoc($result)){

  // Iterate and get all of the hits which are done:

  // Then, post the result via the api into an incident.
  $url = "http://".$row['subdomain'].".kiirti.org/api";

  $date_raw = strtotime($argv[3]);
  $date_fm = date("m/d/Y", $date_raw);

  $data = array();
  $data['incident_title'] = $argv[1];
  $data['incident_description'] = $argv[2];
  $data['incident_date'] = $date_fm;
  $data['incident_hour'] = $argv[4];
  $data['incident_minute'] = $argv[5];
  $data['incident_ampm'] = $argv[6];
  $data['latitude'] = $argv[7];
  $data['longitude'] = $argv[8];
  $data['location_name'] = $argv[9];
  #$data['country_id'] = $argv[9];
  $data['incident_category'] = strtoupper($argv[10]);
  $data['task'] = "audio_mkurk";

  $ch = curl_init();
  //curl_setopt($ch, CURLOPT_VERBOSE, 1); 
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POST, 1 );
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data );

  $http_result = curl_exec($ch);
  $error = curl_error($ch);
  $http_code = curl_getinfo($ch ,CURLINFO_HTTP_CODE);
  curl_close($ch);
  print $http_code."\n";
  print "$http_result\n\n";
  if ($error) {
        print "Error: $error\n";
  } else {
     // print $http_result;
     // $json = json_decode($http_result, true);
     // printf("Success: Hit ID %s.\nSee the result at %s\n", $json['hit_id'], $json['preview']);
  }
}

mysql_free_result($result);
mysql_close($mhi_link);


?>

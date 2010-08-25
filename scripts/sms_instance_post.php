<?php

// Change DB values before deploying in production
$mhi_db = array(
  'user'     => 'emoksha',
  'password' => 'em0ksh2',
  'host'     => 'kiirtidb.c4iuunoxp2j3.us-east-1.rds.amazonaws.com',
  'port'     => '3306',
  'database' => 'mhidb'
);

// Change the value below before deploying in production
$mainSite = ".kiirti.org/frontlinesms/";


$mult = 1000;
$mhi_link = mysql_connect($mhi_db['host'].':'.$mhi_db['port'], $mhi_db['user'], $mhi_db['password']);
mysql_select_db($mhi_db['database']);

$query = sprintf ("select id, message_from, message from message where message_detail is null;");
$result = mysql_query($query);

print "==============================================================\n";
print "Number of records : ". mysql_num_rows($result) ."\n";

if (!$result){
  print (mysql_error());
  exit;
}

while($row = mysql_fetch_assoc($result)){
  print "\nMessage: ". $row['message']."\n";
  $q2 = sprintf ("select SUBSTRING_INDEX('%s',' ',1)", mysql_real_escape_string($row['message']));
  $rcat1 = mysql_query($q2);
  $rcat = mysql_fetch_row($rcat1);
  print "Instance SMS ID: ". $rcat[0]."\n";
  $qS = sprintf ("select subdomain, InstanceFrontlineSMS_Key from sites where InstanceSMS_ID = lower('%s')", mysql_real_escape_string($rcat[0]));
  $qSit = mysql_query($qS);
  $numResults = mysql_num_rows($qSit);
  if ($numResults > 0) {
        $qSites = mysql_fetch_row($qSit);
	$url = "http://".$qSites[0].$mainSite;
        $postData = "key=".urlencode($qSites['1'])."&s=".urlencode($row['message_from'])."&m=".urlencode($row['message']);
	$url = $url."?".$postData;
	print "URL: ".$url."\n";
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
	$http_result = curl_exec($ch);

	$error = curl_error($ch);
	$http_code = curl_getinfo($ch ,CURLINFO_HTTP_CODE);
	print "HTTP Code: ".$http_code."\n";
	curl_close($ch);
	sleep(2);
	if ($error) {
		print "Error: $error\n";
	}
	else {
  		$q3 = sprintf ("update message set message_detail = 'processed' where id = %s", mysql_real_escape_string($row['id']));
  		mysql_query($q3);
	}
   } else {
   	print "No instance associated with this ID: ".$rcat[0]."\n";
        $q4 = sprintf ("update message set message_detail = 'error' where id = %s", mysql_real_escape_string($row['id']));
        mysql_query($q4);
   }
   mysql_free_result($qSit);
   mysql_free_result($rcat1); 
}
print "==============================================================";
print "\n";
mysql_free_result($result);
mysql_close($mhi_link);
?>

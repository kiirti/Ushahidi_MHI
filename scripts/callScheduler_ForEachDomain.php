<?php

// Change DB values before deploying in production
$mhi_db = array(
  'user'     => 'root',
  'password' => 'em0ksh2',
  'host'     => 'localhost',
  'port'     => '3306',
  'database' => 'mhidb'
);

// Change the value below before deploying in production
$mainSite = ".development.kiirti.org/scheduler";

$mult = 1000;
$mhi_link = mysql_connect($mhi_db['host'].':'.$mhi_db['port'], $mhi_db['user'], $mhi_db['password']);
mysql_select_db($mhi_db['database']);

$query = sprintf ("select subdomain from sites where is_approved=1;");
$result = mysql_query($query);

print "==============================================================\n";
print "Number of subdomains : ". mysql_num_rows($result) ."\n";

if (!$result){
  print (mysql_error());
  exit;
}

while($row = mysql_fetch_assoc($result)){
	print "\nMessage: ". $row['message']."\n";
	$url = "http://".$row['subdomain'].$mainSite;
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
}
print "==============================================================";
print "\n";
mysql_free_result($result);
mysql_close($mhi_link);
?>

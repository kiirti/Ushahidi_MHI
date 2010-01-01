<?php

// Pulls the finished hits down for each db.
define(SYSPATH, "");
require("application/config/settings.php");

// Get the hits
$cmd = sprintf("%s %s %s %s 2>> /tmp/kiirti_review_hits.err",
    $config['audio_mturk_results_script'],
    $config['audio_mturk_url'],
    $config['aws_id'],
    $config['aws_sec_id']
    );

$output;
$retval;

#print $cmd."\n";
$line = exec($cmd, $output, $retval);

foreach ($output as $answer){

  $answers = explode("|", $answer);    
  $hit_id = $answers[0];
  $dir = $answers[1];

  if ($hit_id){
  // Default info
  $lat = 0;
  $lon = 0;
  $date_raw = strtotime(trim(file_get_contents($dir."/date.txt")));
  $date_fm = date("m/d/Y", $date_raw);
  $hour = "12";
  $min = "00";
  $ampm = "pm";
  $title = "MTURK UPLOAD";
  $cat = 99; // No cat

//while($row = mysql_fetch_assoc($result)){
    
  // Then, post the result via the api into an incident.
  //$url = "http://".$row['subdomain'].".kiirti.org/api";
  $url = "http://www.kiirti.org/api";
  $person_name = explode(" ", trim(file_get_contents($dir."/name.txt")), 2);
  $data = array();
  $data['task'] = "audio_mkurk";
  $data['location_name'] = trim(file_get_contents($dir."/location.txt"));
  $data['incident_description'] = trim(file_get_contents($dir."/problem.txt"));
  $data['latitude'] = $lat;
  $data['longitude'] = $lon;
  $data['incident_title'] = $title;
  $data['incident_category'] = $cat;
  $data['incident_date'] = $date_fm;
  $data['incident_hour'] = $hour;
  $data['incident_minute'] = $min;
  $data['incident_ampm'] = $ampm;
  $data['person_first'] = $person_name[0];
  $data['person_last'] = $person_name[1]; 
  $data['person_email'] = trim(file_get_contents($dir."/email.txt"));
  $data['hit_id'] = $hit_id;
  $data['tmp_dir'] = $dir;
  $data['instance'] = trim(file_get_contents($dir."/instance.txt"));

  //unlink($desc);
  //print_r($data);
  //die;

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
  print "$http_result\n\n";
  rmdir($dir);
  if ($error) {
        print "Error: $error\n";
  } else {
     // print $http_result;
     // $json = json_decode($http_result, true);
     // printf("Success: Hit ID %s.\nSee the result at %s\n", $json['hit_id'], $json['preview']);
  }
  }
//}
}

//}

?>

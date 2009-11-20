<?php

$mhi_db = array(
  'user'     => 'root',
  'password' => 'em0ksh2',
  'host'     => 'localhost',
  'port'     => '3306',
  'database' => 'mhidb'
);

$mult = 1000;
$mhi_link = mysql_connect($mhi_db['host'].':'.$mhi_db['port'], $mhi_db['user'], $mhi_db['password']);
mysql_select_db($mhi_db['database']);

$query = sprintf ("SELECT id,dbdatabase FROM `sites` WHERE is_approved AND is_public");
$result = mysql_query($query);

if (!$result){
  print (mysql_error());
  exit;
}

// Idea -- delete all from incident*
// Then, get top cat list for each site
// Copy incidents only in this cat
while($row = mysql_fetch_assoc($result)){
  $q1 = sprintf ("BEGIN");
  mysql_query($q1);
  $q2 = sprintf ("DELETE FROM incident WHERE site_id = %s", mysql_real_escape_string($row['id']));
  mysql_query($q2);
  $q3 = sprintf ("SELECT category_id FROM %s.incident_category GROUP BY category_id ORDER BY count(id) DESC LIMIT 1", mysql_real_escape_string($row['dbdatabase']));
  $rcat = mysql_query($q3);
  if (!$result){
    print (mysql_error());
    exit;
  }
  while($cat = mysql_fetch_assoc($rcat)){
    $q4 = sprintf ("INSERT INTO incident SELECT id+(%s*$mult),location_id+(%s*$mult),form_id,locale,user_id,%s,incident_title,incident_description,incident_date,incident_mode,incident_active,incident_verified,incident_source,incident_information,incident_rating,incident_dateadd,incident_dateadd_gmt,incident_datemodify, id FROM %s.incident WHERE id IN (SELECT incident_id FROM %s.incident AS A JOIN %s.incident_category ON incident_id = A.id WHERE category_id = %s AND incident_active)"
        , mysql_real_escape_string($row['id'])
        , mysql_real_escape_string($row['id'])
        , mysql_real_escape_string($row['id'])
        , mysql_real_escape_string($row['dbdatabase'])
        , mysql_real_escape_string($row['dbdatabase'])
        , mysql_real_escape_string($row['dbdatabase'])
        , mysql_real_escape_string($cat['category_id'])
    );
    mysql_query($q4);
  }
  mysql_free_result($rcat);
  /**
  $q5 = sprintf ("REPLACE INTO incident_category SELECT FROM %s.incident_category",
      mysql_real_escape_string($row['dbdatabase']));
  mysql_query($q5);
  $q6 = sprintf ("REPLACE INTO incident_lang SELECT * FROM %s.incident_lang",
      mysql_real_escape_string($row['dbdatabase']));
  mysql_query($q6);
  $q7 = sprintf ("REPLACE INTO incident_person SELECT * FROM %s.incident_person",
      mysql_real_escape_string($row['dbdatabase']));
  mysql_query($q7);
  */
  $q8 = sprintf ("REPLACE INTO location SELECT id+(%s*$mult),location_name,country_id,latitude,longitude,location_visible,location_date FROM %s.location"
       , mysql_real_escape_string($row['id'])   
       , mysql_real_escape_string($row['dbdatabase']));
  mysql_query($q8);
  $q9 = "COMMIT";
  mysql_query($q9);
}

mysql_free_result($result);
mysql_close($mhi_link);


?>

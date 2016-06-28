<?php
DEFINE ('DB_USER', 'demoUser');
DEFINE ('DB_PASSWORD', 'passdemouser');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'demoIdb');
$dbcon = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
         OR die ('could not connect to MySQL: ' . mysqli_connect_error ());
mysqli_set_charset($dbcon, 'utf8');
?>

<?php
DEFINE ('DB_USER', 'loginAdmin');
DEFINE ('DB_PASSWORD', 'passadmin');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'loginidb');

$dbcon = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
  OR die ('could not connect to mysql: ' . mysqli_connect_error());
mysqli_set_charset($dbcon, 'utf8');
?>

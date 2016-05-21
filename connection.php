<?php


$dbhost = 'db446302585.db.1and1.com';
$dbuser = 'dbo446302585';
$dbpass = 'joriz21';
$con = mysql_connect($dbhost, $dbuser, $dbpass);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

$dbname = 'db446302585';
mysql_select_db($dbname, $con);


?>
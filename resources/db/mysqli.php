<?php 

DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'task4');




$dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


if ($dbc->connect_error) {
  die("Connection failed: " . $dbc->connect_error);
}

if (!$dbc) {
	trigger_error ('Could not connect to MySQL: ' . mysqli_connect_error() );
} 
else 
{ 
	mysqli_set_charset($dbc, 'utf8');
}
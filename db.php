<?php
// Connection information for the DB
$db_username = 'root';
$db_pass = '';
$db_name = 'tsarbucks';
$db_host = 'localhost';

$con = new mysqli($db_host, $db_username, $db_pass, $db_name);

//Error information
if ($con->connect_error) {
  die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}

?>

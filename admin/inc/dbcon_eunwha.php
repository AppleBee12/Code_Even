<?php
$hostname = 'localhost';
$username = 'ehosting';
$password = 'dmsghk0136!';
$dbname = 'ehosting';

$mysqli = new mysqli($hostname, $username, $password, $dbname);
if ($mysqli->connect_errno) {
  throw new RuntimeException('연결에러' . $mysqli->connect_error);
}

$mysqli->set_charset('utf8mb4');
if ($mysqli->errno) {
  throw new RuntimeException('연결 후 에러' . $mysqli->error);
}

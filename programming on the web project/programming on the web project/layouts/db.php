<?php
  // variable data the database
  $host = 'localhost';
  $username = 'root';
  $pass = '';
  $dbname = 'project_exam';

  // connection database mysqli
  $connection = new mysqli($host, $username, '', $dbname);

  // condition from connection database
	if ($connection->connect_error) { // if $connection->connect_error == null => false
		die("Unable to Connect database: " . $connection->connect_error);
  }
  

?>
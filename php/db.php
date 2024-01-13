<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "transportation";
  $db = new mysqli($servername, $username, $password, $dbname);

  if ($db->connect_error) {
    die("Ошибка подлкючения: " . $db->connect_error);
}
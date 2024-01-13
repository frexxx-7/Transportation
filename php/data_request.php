<?php
include "db.php";

$carName = $_POST['carName'];

$sql = "SELECT id FROM cars WHERE name = '$carName'";
$result = $db->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc()) {
    echo $row["id"];
  }
} else {
  echo "0 результатов";
}

$db->close();


?>
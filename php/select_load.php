<?php
include "db.php";


$sql = "SELECT name FROM cars";
$result = $db->query($sql);

$data = array();

if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
} else {
  echo "0 результатов";
}
echo json_encode($data);

$db->close();
?>
<?php
session_start();
include "db.php";

// Выполняем запрос к базе данных


$idCar = $_POST['id'];
$name = $_POST['name'];
$priceKM = $_POST['price'];
$engines = $_POST['engines'];
$year = $_POST['year'];
$height = $_POST['height'];
$liftingCapacity = $_POST['liftingCapacity'];
$length = $_POST['length'];
$compartmentLength = $_POST['compartmentLength'];

// Выполняем запрос к базе данных
$result = $db->query("UPDATE cars SET name = '$name', priceKM = '$priceKM', engines = '$engines', year='$year', height = '$height' WHERE id = '$idCar'");

if ($result) {
  echo "Запись обновлена";
} else {
  echo "Ошибка обновления: " . $db->error;
}
?>
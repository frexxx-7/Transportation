<?php
session_start();
// подключение к базе данных
include "db.php";

// Получение значения параметра nameCar из URL-адреса
$nameCar = $_GET["nameCar"];

$sql = "SELECT id FROM cars WHERE name = '$nameCar'";
$result = $db->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $idCar = $row["id"];
  }
} else {
  echo "0 результатов";
}

// Получение значения параметра ordersName из URL-адреса
$ordersName = $_GET["ordersName"];
// Выполняем запрос к базе данных
$result = $db->query("DELETE FROM orders WHERE idCar = '$idCar' AND name = '$ordersName'");

if ($result) {
  header('Location: ../pages/profile.php');
} else {
  echo "Ошибка удаления записи: " . $db->error;
}

$db->close();
?>
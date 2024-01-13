<?php
session_start();
include "db.php";

header('Content-Type: application/json; charset=utf-8');
$id = $_POST['idCar'];
// Выполняем запрос к базе данных
$result = $db->query("SELECT `name`,`priceKM`,`engines`,`year`,`height`,`liftingCapacity`,`length`,`compartmentLength` FROM cars WHERE cars.id = '$id'");
// Если результат не пуст, выводим данные
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  echo json_encode($row);
} else {
  http_response_code(500); // Устанавливаем статус 500
  $response = array('error' => 'Ошибка редактирования записи: ' . $db->error);
  echo json_encode($response);
}
?>
<?php
session_start();

include "db.php";


$name = $_POST['name'];
$numberPhone = $_POST['numberPhone'];
$idCar = $_POST['idCar'];
$idUser = $_SESSION['id'];

$sql = "INSERT INTO orders (name,numberPhone, idCar, idUser) VALUES ('$name','$numberPhone', '$idCar', '$idUser')";

if ($db->query($sql) === TRUE) {
  echo "Заявка создана!";
} else {
  echo "Error: " . $sql . "<br>" . $db->error;
}

$db->close();
?>
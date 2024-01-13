<?php
include "db.php";

if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}

if (isset($_FILES['image']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['engines']) && isset($_POST['year']) && isset($_POST['height']) && isset($_POST['liftingCapacity']) && isset($_POST['lenght']) && isset($_POST['compartmentLenght'])) {
  $price = $_POST['price'];
  $name = $_POST['name'];
  $engines = $_POST['engines'];
  $year = $_POST['year'];
  $height = $_POST['height'];
  $liftingCapacity = $_POST['liftingCapacity'];
  $lenght = $_POST['lenght'];
  $compartmentLenght = $_POST['compartmentLenght'];
  $image = addslashes(file_get_contents($_FILES['image']['tmp_name'])); //SQL Injection defence!
  $image_name = addslashes($_FILES['image']['name']);
  $sql = "INSERT INTO `cars` (`name`, `priceKM`, `engines`, `year`, `height`, `liftingCapacity`, `length`, `compartmentLength`, `image`) VALUES ('$name', '$price', '$engines','$year', '$height', '$liftingCapacity', '$lenght', '$compartmentLenght', '{$image}');";
  if ($db->query($sql) === TRUE) {
    echo "Новая запись создана!";
  } else {
    echo "Error: " . $sql . "<br>" . $db->error;
  }
} else {
  echo "Пожалуйста заполните все поля!";
}
?>
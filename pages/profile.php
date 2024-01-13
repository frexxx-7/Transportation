<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <title>Профиль</title>
  <link rel="stylesheet" href="../styles/profile.css">
</head>

<body>
  <h1>Добро пожаловать,
    <?php echo $_SESSION['username']; ?>!
  </h1>
  <p>Это ваша панель управления.</p>
  <div class="profile-container">
    <a href="../index.php">Вернуться на главную страницу</a>
    <form action="logout.php" method="post">
      <input type="submit" value="Выйти">
    </form>
  </div>
  <?php
  if ($_SESSION['username'] == "Admin") {
    // Если пользователь - админ, показываем кнопки
    echo '<div class="add_info">';
    echo '<label for="name">Название:</label><br>';
    echo '<input id="name" type="text" name="name">';
    echo '<label for="price">Цена:</label><br>';
    echo '<input id="price" type="text" name="price">';
    echo '<label for="engines">Двигатель:</label><br>';
    echo '<input id="engines" type="text" name="engines">';
    echo '<label for="year">Год:</label><br>';
    echo '<input id="year" type="text" name="year">';
    echo '<label for="height">Высота:</label><br>';
    echo '<input id="height" type="text" name="height">';
    echo '<label for="liftingCapacity">Грузоподъемность:</label><br>';
    echo '<input id="liftingCapacity" type="text" name="liftingCapacity">';
    echo '<label for="lenght">Длина:</label><br>';
    echo '<input id="lenght" type="text" name="lenght">';
    echo '<label for="compartmentLenght">Длина грузового отсека(платформы):</label><br>';
    echo '<input id="compartmentLenght" type="text" name="compartmentLenght">';
    echo '<label for="image">Изображение:</label><br>';
    echo '<input id="uploadImage" type="file" name="image">';
    echo '<button id="uploadButton">Добавить</button>';
    echo '</div>';
  }
  // Если пользователь не админ, кнопки не будут отображаться
  ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    $("#uploadButton").click(function () {
      var formData = new FormData();
      formData.append('price', $('#price').val());
      formData.append('name', $('#name').val());
      formData.append('engines', $('#engines').val());
      formData.append('year', $('#year').val());
      formData.append('height', $('#height').val());
      formData.append('liftingCapacity', $('#liftingCapacity').val());
      formData.append('lenght', $('#lenght').val());
      formData.append('compartmentLenght', $('#compartmentLenght').val());
      formData.append('image', $('#uploadImage')[0].files[0]);

      $.ajax({
        url: '../php/upload.php',
        type: 'POST',
        data: formData,
        processData: false, // tell jQuery not to process the data
        contentType: false, // tell jQuery not to set contentType
        success: function (data) {
          console.log(data);
          alert('Данные загружены!');
        }
      });
    });
    
  </script>
</body>

</html>

<?php
if (!isset($_SESSION['username'])) {
  // Если пользователь не авторизован, перенаправляем его на страницу входа
  header("Location: login.php");
  exit;
}
include "../php/db.php";
$id = $_SESSION['id'];
if ($_SESSION['username'] == "Admin") {
  $result = $db->query("SELECT orders.*, orders.name as ordersName, cars.*, cars.name as nameCar, cars.id as carId FROM orders INNER JOIN cars ON cars.id = orders.idCar");
} else {
  $result = $db->query("SELECT orders.*, orders.name as ordersName, cars.*, cars.name as nameCar, cars.id as carId FROM orders INNER JOIN cars ON cars.id = orders.idCar WHERE orders.idUser = '$id'");
}
// Выполняем запрос к базе данных


if ($result->num_rows > 0) {
  echo "<table>";
  if ($_SESSION['username'] == "Admin") {
    echo "<tr><th>ФИО</th><th>Название</th><th>Цена(КМ)</th><th>Код пользователя</th><th>Фото</th></tr>";
  } else {
    echo "<tr><th>ФИО</th><th>Название</th><th>Цена(КМ)</th><th>Фото</th></tr>";
  }
  while ($row = $result->fetch_assoc()) {
    // Выводим данные из базы данных
    if ($_SESSION['username'] == "Admin") {
      echo "<tr><td>" . $row["ordersName"] . "</td><td>" . $row["name"] . "</td><td>" . $row["priceKM"] . "</td><td>" . $row["idUser"] . "</td>";
    } else {
      echo "<tr><td>" . $row["ordersName"] . "</td><td>" . $row["name"] . "</td><td>" . $row["priceKM"] . "</td>";
    }

    // Выводим изображение
    echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' /></td>";
    if ($_SESSION['username'] == "Admin") {
      echo "<td><a href='../php/delete.php?nameCar=" . $row["nameCar"] . "&ordersName=" . $row["ordersName"] . "'>Удалить</a></td>";
      echo "<td><a href='./editPage.php?carId=" . $row["carId"] . "'>Редактировать</a></td></tr>";
    } else {
      echo "<td><a href='../php/delete.php?name=" . $row["nameCar"] . "&fio=" . $row["ordersName"] . "'>Удалить</a></td>";
    }
  }
  echo "</table>";
} else {
  echo "0 результатов";
}
?>
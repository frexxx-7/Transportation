<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Редактировать</title>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <script src="../js/edit.js"></script>
  <link rel="stylesheet" href="../styles/edit.css">
</head>

<body>
  
  <?php
  $idCar = $_GET['carId'];
  if ($_SESSION['username'] == "Admin") {
    echo '<form id="editForm">';
    echo '<h1>Редактировать</h1>';
    echo '<input type="text" id="idCar" name="idCar" style="display:none" value="' . $idCar . '"><br>';
    echo '<label for="name">Название:</label><br>';
    echo '<input type="text" id="name" name="name"><br>';
    echo '<label for="price">Цена:</label><br>';
    echo '<input type="text" id="price" name="price"><br>';
    echo '<label for="engines">Двигатель:</label><br>';
    echo '<input type="text" id="engines" name="engines"><br>';
    echo '<label for="year">Год:</label><br>';
    echo '<input type="text" id="year" name="year"><br>';
    echo '<label for="height">Высота:</label><br>';
    echo '<input type="text" id="height" name="height"><br>';
    echo '<label for="liftingCapacity">Грузоподъемность:</label><br>';
    echo '<input type="text" id="liftingCapacity" name="liftingCapacity"><br>';
    echo '<label for="length">Длина:</label><br>';
    echo '<input type="text" id="length" name="length"><br>';
    echo '<label for="compartmentLength">Длина грузового отсека(платформы):</label><br>';
    echo '<input type="text" id="compartmentLength" name="compartmentLength"><br>';
    echo '<input type="submit" value="Сохранить">';
    echo '<a href="./profile.php" class="back">Вернуться в панель управления</a>';
    echo '</form>';
  }
  // Если пользователь не админ, кнопки не будут отображаться
  ?>
  <script>
    // Загрузка данных в форму
    $(document).ready(function () {
      $.ajax({
        url: '../php/load.php',
        type: 'POST',
        data: {
          idCar: $('#idCar').val()
        }, // передача параметров id и name
        dataType: 'json',
        success: function (response) {
          console.log(response);
          $('#price').val(response.priceKM);
          $('#name').val(response.name);
          $('#engines').val(response.engines);
          $('#year').val(response.year);
          $('#height').val(response.height);
          $('#liftingCapacity').val(response.liftingCapacity);
          $('#length').val(response.length);
          $('#compartmentLength').val(response.compartmentLength);
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
          console.log(jqXHR);
        }
      });

      $('#editForm').submit(function (e) {
        e.preventDefault();

        var formData = new FormData();
        formData.append('id', $('#idCar').val());
        formData.append('price', $('#price').val());
        formData.append('name', $('#name').val());
        formData.append('engines', $('#engines').val());
        formData.append('year', $('#year').val());
        formData.append('height', $('#height').val());
        formData.append('liftingCapacity', $('#liftingCapacity').val());
        formData.append('length', $('#length').val());
        formData.append('compartmentLength', $('#compartmentLength').val());

        $.ajax({
          url: '../php/edit.php',
          type: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
            console.log(response);
          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
          }
        });
      });
    });
  </script>

</body>

</html>
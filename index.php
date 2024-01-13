<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Перевозка габаритных грузов</title>
  <link rel="stylesheet" href="styles/index.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="js/loadData.js"></script>
  <script src="scripts/script.js"></script>
</head>

<body>

  <header class="header">
    <div class="container">
      <div class="logo">
        <img src="images/logo.png" alt="log">
      </div>
      <div>
        <nav class="menu">
          <ul>
            <li class="menu-item">
              <a href="#">Главная</a>
            </li>
            <li class="menu-item">
              <a href="#cars">Автомобили</a>
            </li>
            <li class="menu-item">
              <a href="#price">Бронирование авто</a>
            </li>
            <li class="menu-item">
              <a href="<?php echo isset($_SESSION['username']) ? './pages/profile.php' : 'pages/login.php'; ?>">
                <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Войти'; ?>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </header>

  <section class="main">
    <div class="container">
      <div class="main-info">
        <h1 class="main-title">Перевозка габаритных грузов</h1>
        <div class="main-text">
          На рынке грузоперевозок мы уже БОЛЕЕ 20 ЛЕТ. Мы сотрудничаем с такими компаниями как ООО "ТИССА", Эком,
          Агрофирма "Молагро" и множество других
        </div>
        <div class="main-action">
          <button class="button" id="main-action">Посмотреть автомобили</button>
        </div>
      </div>
    </div>
  </section>

  <section class="car" id="cars">
    <div class="container">
      <h2 class="sub-title">Наш автопарк</h2>
      <div class="row">
        <script>
          $(document).ready(function () {
            $.ajax({
              url: './php/load_main_cars.php',
              type: 'POST',
              success: function (data) {
                $('.row').html(data);
              }
            });
          });
        </script>
      </div>
    </div>
  </section>

  <selection class="price" id="price">
    <div class="container">
      <h2 class="sub-title">Узнать цену и забронировать</h2>
      <div class="price-text">
        Заполните данные, и мы перезвоним вам для уточнения всех деталей бронирования
      </div>
      <form action="" class="price-form">
        <input type="text" class="price-input" id="name" placeholder="Ваше имя">
        <input type="text" class="price-input" id="phone" placeholder="Ваш телефон">
        <select class="form-control" name="whatCar" id="whatCar" required>
        </select>
        <button class="button" type="button" id="price-action" onclick="oform()">Забронировать</button>
      </form>
      <img src="images/iveco.png" alt="Rolls" class="price-image">
    </div>
  </selection>

  <footer class="footer">
    <div class="container">
      <div class="logo">
        <img src="images/logo.png" alt="logo">
      </div>
      <div class="rights">Все права защищены</div>
    </div>
  </footer>

</body>

</html>
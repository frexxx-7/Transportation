<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<html>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../styles/authorization.css">
  <title>Логин</title>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
</head>

<body>
  <div class="login-main">
    <div class="login-main-container">
      <form class="authorization" id="authorization" method="POST">
        <h1>Логин</h1>
        <input type="text" name="username" placeholder="Имя пользователя" required class="input-form">
        <input type="password" name="password" placeholder="Пароль" required class="input-form">
        <input type="submit" value="Авторизироваться" id="shoutbox-btn" class="authorization-btn">
        <input class="registration-btn" value="Регистрация" />
        <div class="back-container"><a href="../index.php" class="back">На главную</a></div>
      </form>
      <form class="registration" id="registration" method="POST">
        <h1>Регистрация</h1>
        <input type="text" name="reg-username" placeholder="Имя пользователя" required class="input-form">
        <input type="password" name="reg-password" placeholder="Пароль" required class="input-form">
        <input type="password" name="repeat-password" placeholder="Повторить пароль" required class="input-form">
        <input type="submit" value="Регистрация" id="shoutbox-btn" class="registration-btn-auth">
        <input class="registration-btn" value="Есть аккаунт? Авторизоваться" />
        <div class="message-box"></div>
      </form>

    </div>
  </div>
</body>
<script src="../js/autorization.js"></script>

</html>
<?php
session_start();
// подключение к базе данных
include "db.php";

header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // получение данных из формы
        $usernames = $db->real_escape_string($_POST['reg-username']);
        $passwords = $db->real_escape_string($_POST['reg-password']);
        $repeat_password = $db->real_escape_string($_POST['repeat-password']);

        // проверка совпадения паролей
        if ($passwords != $repeat_password) {
            echo json_encode(array('success' => 0));
            exit;
        }

        // хеширование пароля
        $hashed_password = password_hash($passwords, PASSWORD_DEFAULT);

        // создание нового пользователя
        $result = $db->query("INSERT INTO users (username, passwords) VALUES ('$usernames', '$hashed_password')");

        if ($result) {
            $_SESSION['username'] = $usernames;
            // Получение данных пользователя
            $result = $db->query("SELECT * FROM users WHERE username = '$usernames'");
            $user = $result->fetch_assoc();
            $_SESSION['id'] = $user['idUsers'];
            echo json_encode(array('success' => true));
        } else {
          echo json_encode(array("success" => $db->error));
        }
    }
} catch (Exception $e) {
    echo json_encode(array('success' => false, 'error' => $e->getMessage()));
}
?>

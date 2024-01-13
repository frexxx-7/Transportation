<?php
session_start();
include_once "db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // получение данных из формы
    $usernames = $db->real_escape_string($_POST['username']);
    $passwords = $db->real_escape_string($_POST['password']);

    // получение хеша пароля из базы данных
    $result = $db->query("SELECT * FROM users WHERE username='$usernames'");
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // проверка соответствия пароля и хеша
        if (password_verify($passwords, $user['passwords'])) {
            $_SESSION['username'] = $usernames;
            $_SESSION['id'] = $user['idUsers'];
            echo json_encode(array('success' => true));
        } else {
          echo json_encode(array("success" => $db->error));
        }
    } else {
      echo json_encode(array("success" => $db->error));
    }
}
?>

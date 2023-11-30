<?php
session_start();
include 'db_config.php';

function createUserPage($login) {
    $userDirectory = "users/$login";
    if (!file_exists($userDirectory)) {
        mkdir($userDirectory, 0755, true);
    }

    $userPage = "$userDirectory/$login.php";
    if (!file_exists($userPage)) {
        // Створення та запис в файл
        file_put_contents($userPage, "<!DOCTYPE html>
<html>
<head>
    <title>Ласкаво просимо, $login!</title>
</head>
<body>
    <h1>Ласкаво просимо, $login!</h1>
    <p>Це ваша особиста сторінка.</p>
</body>
</html>");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Перевірка, чи існує користувач з таким логіном
    $sql = "SELECT id FROM users WHERE login = '$login'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Користувач з таким логіном вже існує";
    } else {
        // Хешування паролю
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Додавання нового користувача в базу даних
        $sql = "INSERT INTO users (login, password) VALUES ('$login', '$hashedPassword')";
        if ($conn->query($sql) === TRUE) {
            // Створення файлу сторінки користувача
            createUserPage($login);

            // Авторизація і перенаправлення на сторінку користувача
            $_SESSION['user_id'] = $conn->insert_id;
            header("Location: users/$login/$login.php");
            exit();
        } else {
            echo "Помилка при реєстрації користувача: " . $conn->error;
        }
    }
}

$conn->close();
?>

<?php
session_start();
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $sql = "SELECT id, password FROM users WHERE login = '$login'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION['user_id'] = $row["id"];

            // Створюємо папку для користувача, якщо вона не існує
            $userDirectory = "users/$login";
            if (!file_exists($userDirectory)) {
                mkdir($userDirectory, 0755, true);
            }

            // Перевіряємо наявність файлу перед перенаправленням
            $userPage = "$userDirectory/$login.php";
            if (file_exists($userPage)) {
                header("Location: $userPage");
                exit();
            } else {
                echo "Помилка: Сторінка для користувача не знайдена";
            }
        } else {
            echo "Невірний логін або пароль";
        }
    } else {
        echo "Користувач не знайдений";
    }
}

$conn->close();
?>

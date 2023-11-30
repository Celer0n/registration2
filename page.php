<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // Якщо користувач не авторизований, перенаправляємо його на головну сторінку
    header("Location: index.php");
    exit();
}

// Отримуємо логін користувача з сесії
$login = $_SESSION['user_login'];

echo "Ласкаво просимо, $login, на безпечну сторінку!";
?>

<?php
session_start();

// Знищимо всі дані сесії та перенаправимо користувача на головну сторінку
session_destroy();
header("Location: index.php");
?>

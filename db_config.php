<?php
$servername = 'localhost';
$username = 'web';
$password = '1488';
$dbname = 'test';

// Створюємо з'єднання
$conn = new mysqli($servername, $username, $password, $dbname);

// Перевіряємо з'єднання
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

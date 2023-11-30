<?php
session_start();

// Перевірка, чи користувач авторизований
if (isset($_SESSION['user_id'])) {
    // Виводимо вітання для авторизованих користувачів
    echo "Вітаємо, ви авторизовані!<br>";
    echo '<a href="logout.php">Вийти</a>';
} else {
    // Якщо користувач не авторизований, показуємо форму входу та реєстрації
    echo '<h2>Форма входу</h2>';
    echo '<form action="login.php" method="post">';
    echo 'Логін: <input type="text" name="login"><br>';
    echo 'Пароль: <input type="password" name="password"><br>';
    echo '<input type="submit" value="Увійти">';
    echo '</form>';
    
    echo '<h2>Форма реєстрації</h2>';
    echo '<form action="register.php" method="post">';
    echo 'Логін: <input type="text" name="login"><br>';
    echo 'Пароль: <input type="password" name="password"><br>';
    echo '<input type="submit" value="Зареєструватися">';
    echo '</form>';
}
?>

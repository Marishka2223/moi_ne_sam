<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    if ($login === 'adminka' && $password === 'password') {
        $_SESSION['admin'] = true;
        header('Location: ../pages/admin_panel.html');
        exit();
    } else {
        echo "Неверный логин или пароль";
    }
}

if (isset($_SESSION['admin']) && $_SESSION['admin']) {
    $stmt = $pdo->query("SELECT * FROM requests");
    $requests = $stmt->fetchAll();

    echo "<h1>Заявки</h1>";
    echo "<table>";
    echo "<tr><th>ID</th><th>ФИО</th><th>Телефон</th><th>Адрес</th><th>Вид услуги</th><th>Статус</th><th>Действия</th></tr>";
    foreach ($requests as $request) {
        echo "<tr>";
        echo "<td>{$request['id']}</td>";
        echo "<td>{$request['full_name']}</td>";
        echo "<td>{$request['phone']}</td>";
        echo "<td>{$request['address']}</td>";
        echo "<td>{$request['service_type']}</td>";
        echo "<td>{$request['status']}</td>";
        echo "<td>";
        echo "<form action='../php/update_status.php' method='post'>";
        echo "<input type='hidden' name='request_id' value='{$request['id']}'>";
        echo "<select name='status'>";
        echo "<option value='in_progress'>В работе</option>";
        echo "<option value='completed'>Выполнено</option>";
        echo "<option value='cancelled'>Отменено</option>";
        echo "</select>";
        echo "<input type='text' name='cancellation_reason' placeholder='Причина отмены'>";
        echo "<button type='submit'>Обновить статус</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>

<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['admin']) && $_SESSION['admin']) {
    $request_id = $_POST['request_id'];
    $status = $_POST['status'];
    $cancellation_reason = $_POST['cancellation_reason'] ?? null;

    $stmt = $pdo->prepare("UPDATE requests SET status = ?, cancellation_reason = ? WHERE id = ?");
    $stmt->execute([$status, $cancellation_reason, $request_id]);

    header('Location: ../pages/admin_panel.html');
    exit();
}
?>

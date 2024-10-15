<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $service_type = $_POST['service_type'];
    $other_service_description = $_POST['other_service_description'] ?? null;
    $preferred_payment = $_POST['preferred_payment'];
    $requested_date = $_POST['requested_date'];
    $requested_time = $_POST['requested_time'];

    $stmt = $pdo->prepare("INSERT INTO requests (user_id, address, phone, service_type, other_service_description, preferred_payment, requested_date, requested_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$user_id, $address, $phone, $service_type, $other_service_description, $preferred_payment, $requested_date, $requested_time]);

    header('Location: ../pages/create_request.html');
    exit();
}
?>

<?php
include 'db_connect.php';

$status = $_POST['status'];
$totalAmount = $_POST['totalAmount'];
$ids = $_POST['ids'];

foreach ($ids as $id) {
    $conn->query("UPDATE payments SET status_payment = '$status', amount = '$totalAmount' WHERE id = '$id'");
}

echo 1; // Return success

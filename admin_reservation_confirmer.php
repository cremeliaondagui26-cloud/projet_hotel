<?php
session_start();
require 'config/db.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("UPDATE reservations SET statut = 'confirmee' WHERE id = ?");
$stmt->execute([$id]);

header("Location: admin_reservations.php");
exit;
?>
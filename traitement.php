<?php
session_start();
require 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: contact.php");
    exit;
}

$nom = trim($_POST['nom'] ?? '');
$email = trim($_POST['email'] ?? '');
$telephone = trim($_POST['telephone'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($nom === '' || $email === '' || $message === '') {
    header("Location: contact.php?error=1");
    exit;
}

// Insertion en BDD
$sql = "INSERT INTO contacts (nom, email, telephone, message)
        VALUES (?, ?, ?, ?)";

$stmt = $pdo->prepare($sql);
$stmt->execute([$nom, $email, $telephone, $message]);

// Message de succès
header("Location: contact.php?success=1");
exit;

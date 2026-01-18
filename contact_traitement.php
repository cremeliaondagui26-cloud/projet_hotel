<?php
session_start();
require 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.php');
    exit;
}

// Sécurisation des données
$nom = htmlspecialchars(trim($_POST['nom'] ?? ''));
$email = htmlspecialchars(trim($_POST['email'] ?? ''));
$telephone = htmlspecialchars(trim($_POST['telephone'] ?? ''));
$message = htmlspecialchars(trim($_POST['message'] ?? ''));

// Vérification
if (empty($nom) || empty($email) || empty($message)) {
    die("Tous les champs obligatoires doivent être remplis.");
}

// Insertion en base de données
$stmt = $pdo->prepare("
    INSERT INTO contacts (nom, email, telephone, message)
    VALUES (?, ?, ?, ?)
");
$stmt->execute([$nom, $email, $telephone, $message]);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Message envoyé</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container my-5">
    <div class="alert alert-success text-center">
        <h3>Merci <?= $nom ?> !</h3>
        <p>Votre message a bien été envoyé.</p>
        <a href="index.php" class="btn btn-primary mt-3">Retour à l'accueil</a>
    </div>
</div>

</body>
</html>

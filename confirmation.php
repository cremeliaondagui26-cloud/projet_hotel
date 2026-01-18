<?php
session_start();
require 'config/db.php';

// 1️⃣ Vérifier que le formulaire est bien envoyé
if (!isset($_POST['id_chambre'])) {
    die("Aucune réservation reçue.");
}

// 2️⃣ Récupération et sécurisation des données
$id_chambre   = (int) $_POST['id_chambre'];
$nom          = trim($_POST['nom']);
$email        = trim($_POST['email']);
$date_arrivee = $_POST['date_arrivee'];
$date_depart  = $_POST['date_depart'];
$personnes    = (int) $_POST['personnes'];

// 3️⃣ Vérification basique
if ($date_arrivee >= $date_depart) {
    die("Dates invalides.");
}

// 4️⃣ Vérifier que la chambre existe
$stmt = $pdo->prepare("SELECT * FROM rooms WHERE id = ?");
$stmt->execute([$id_chambre]);
$room = $stmt->fetch();

if (!$room) {
    die("Chambre introuvable.");
}

// 5️⃣ Vérification de disponibilité (LOGIQUE CORRECTE)
$check = $pdo->prepare("
    SELECT 1 FROM reservations
    WHERE id_chambre = ?
    AND NOT (
        date_depart <= ?
        OR date_arrivee >= ?
    )
");
$check->execute([
    $id_chambre,
    $date_arrivee,
    $date_depart
]);

if ($check->rowCount() > 0) {
    die("
        <h2 style='color:red;text-align:center;'>
            Cette chambre n'est pas disponible à ces dates.
        </h2>
        <p style='text-align:center;'>
            <a href='chambres.php'>Retour aux chambres</a>
        </p>
    ");
}

// 6️⃣ Enregistrer la réservation
$insert = $pdo->prepare("
    INSERT INTO reservations 
    (id_chambre, nom, email, date_arrivee, date_depart, personnes)
    VALUES (?, ?, ?, ?, ?, ?)
");
$insert->execute([
    $id_chambre,
    $nom,
    $email,
    $date_arrivee,
    $date_depart,
    $personnes
]);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Confirmation de réservation</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.container-box {
    background:white;
    padding:25px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
    max-width:600px;
    margin:auto;
}
</style>
</head>

<body>

<div class="container my-5">
    <div class="container-box">

        <h2 class="text-center mb-4 text-success">Réservation confirmée</h2>

        <p><strong>Merci :</strong> <?= htmlspecialchars($nom) ?></p>

        <hr>

        <h5>Détails de la chambre</h5>
        <p><strong>Chambre :</strong> <?= htmlspecialchars($room['numero']) ?></p>
        <p><strong>Type :</strong> <?= htmlspecialchars($room['type']) ?></p>
        <p><strong>Prix :</strong> <?= htmlspecialchars($room['prix']) ?> € / nuit</p>

        <hr>

        <h5>Séjour</h5>
        <p><strong>Arrivée :</strong> <?= $date_arrivee ?></p>
        <p><strong>Départ :</strong> <?= $date_depart ?></p>
        <p><strong>Personnes :</strong> <?= $personnes ?></p>

        <div class="text-center mt-4">
            <a href="paiement.php" class="btn btn-success">Payer maintenant</a>
            <a href="index.php" class="btn btn-outline-primary ms-2">Accueil</a>
        </div>

    </div>
</div>

</body>
</html>

<?php
session_start();
require 'config/db.php';

// Vérifier et sécuriser l'ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Aucune chambre sélectionnée.");
}

$id = (int) $_GET['id'];

// Récupérer les infos de la chambre
$stmt = $pdo->prepare("SELECT * FROM rooms WHERE id = ?");
$stmt->execute([$id]);
$room = $stmt->fetch();

if (!$room) {
    die("Chambre introuvable.");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Réserver la chambre <?= htmlspecialchars($room['numero']) ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.container-box {
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    max-width: 600px;
    margin: auto;
}

.room-img {
    width: 100%;
    height: 260px;
    object-fit: cover;
    border-radius: 12px;
}
</style>
</head>

<body>

<div class="container my-5">
    <div class="container-box">

        <h2 class="text-center mb-4">
            Réserver la chambre <?= htmlspecialchars($room['numero']) ?>
        </h2>

        <!-- Image de la chambre -->
        <img
            src="image_hotel/<?= htmlspecialchars($room['image'] ?? 'default.jpg') ?>"
            alt="<?= htmlspecialchars($room['type']) ?>"
            class="room-img mb-3"
            onerror="this.src='image_hotel/default.jpg';"
        >

        <p><strong>Type :</strong> <?= htmlspecialchars($room['type']) ?></p>
        <p><strong>Prix :</strong> <?= htmlspecialchars($room['prix']) ?> € / nuit</p>

        <hr>

        <h4 class="mb-3">Formulaire de réservation</h4>

        <form action="confirmation.php" method="POST">

            <!-- ID chambre -->
            <input type="hidden" name="id_chambre" value="<?= $room['id'] ?>">

            <label class="form-label">Nom complet :</label>
            <input type="text" name="nom" class="form-control mb-3" required>

            <label class="form-label">Email :</label>
            <input type="email" name="email" class="form-control mb-3" required>

            <label class="form-label">Date d'arrivée :</label>
            <input
                type="date"
                name="date_arrivee"
                class="form-control mb-3"
                min="<?= date('Y-m-d') ?>"
                required
            >

            <label class="form-label">Date de départ :</label>
            <input
                type="date"
                name="date_depart"
                class="form-control mb-3"
                min="<?= date('Y-m-d') ?>"
                required
            >

            <label class="form-label">Nombre de personnes :</label>
            <select name="personnes" class="form-select mb-4" required>
                <option value="">-- Choisir --</option>
                <option value="1">1 personne</option>
                <option value="2">2 personnes</option>
                <option value="3">3 personnes</option>
                <option value="4">4 personnes</option>
            </select>

            <button type="submit" class="btn btn-primary w-100 btn-lg">
                Confirmer la réservation
            </button>
        </form>

    </div>
</div>

</body>
</html>

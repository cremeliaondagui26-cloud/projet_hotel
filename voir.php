<?php
session_start();
require 'config/db.php';

// Sécuriser l’ID
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Récupérer la chambre
$stmt = $pdo->prepare("SELECT * FROM rooms WHERE id = ?");
$stmt->execute([$id]);
$room = $stmt->fetch();

if (!$room) {
    die("Chambre introuvable.");
}

// Récupérer les images de la galerie
$stmt2 = $pdo->prepare("SELECT * FROM room_images WHERE room_id = ?");
$stmt2->execute([$room['id']]);
$images = $stmt2->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title><?= htmlspecialchars($room['type']) ?> | Hôtel</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.hero {
    background: url('image_hotel/<?= htmlspecialchars($room['image'] ?? 'default.jpg') ?>') center/cover no-repeat;
    height: 60vh;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-shadow: 0 0 10px black;
}

.main-image {
    width: 100%;
    max-height: 450px;
    object-fit: cover;
}

.gallery-img {
    width: 100%;
    height: 280px;
    object-fit: cover;
}
</style>
</head>

<body>

<!-- HERO -->
<div class="hero">
    <h1 class="text-center">
        <?= htmlspecialchars($room['type']) ?> — Chambre <?= htmlspecialchars($room['numero']) ?>
    </h1>
</div>

<div class="container section py-5">

    <!-- CONTENU PRINCIPAL -->
    <div class="row align-items-center">
        <div class="col-md-6 mb-4">
            <img
                src="image_hotel/<?= htmlspecialchars($room['image'] ?? 'default.jpg') ?>"
                alt="<?= htmlspecialchars($room['type']) ?>"
                class="main-image rounded shadow img-fluid"
                onerror="this.src='image_hotel/default.jpg';"
            >
        </div>

        <div class="col-md-6">
            <h2 class="text-teal"><?= htmlspecialchars($room['type']) ?></h2>

            <p><?= nl2br(htmlspecialchars($room['description'])) ?></p>

            <ul class="list-unstyled">
                <li><strong>Prix :</strong> <?= htmlspecialchars($room['prix']) ?> € / nuit</li>
                <li><strong>Capacité :</strong> <?= htmlspecialchars($room['capacite']) ?> personnes</li>
                <li><strong>Statut :</strong> <?= htmlspecialchars($room['statut']) ?></li>
            </ul>

            <a href="reserver.php?id=<?= $room['id'] ?>" class="btn btn-primary btn-lg mt-3">
                Réserver cette chambre
            </a>
        </div>
    </div>

    <hr class="my-5">

    <!-- GALERIE -->
    <?php if (!empty($images)): ?>
        <h3 class="text-teal mb-4">Galerie photos</h3>

        <div class="row">
            <?php foreach ($images as $img): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <img
                        src="image_hotel/<?= htmlspecialchars($img['image']) ?>"
                        class="gallery-img rounded shadow img-fluid"
                        alt="Photo chambre"
                        onerror="this.src='image_hotel/default.jpg';"
                    >
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-muted">Aucune image disponible pour cette chambre.</p>
    <?php endif; ?>

</div>

</body>
</html>

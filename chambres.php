<?php
session_start();
require 'config/db.php';

// Récupérer toutes les chambres triées par type
$stmt = $pdo->query("SELECT * FROM rooms ORDER BY type");
$rooms = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Nos Chambres | Hôtel</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.room-card {
    background:white;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 4px 15px rgba(0,0,0,0.1);
    transition:0.3s;
}
.room-card:hover {
    transform:translateY(-8px);
}
.room-card img {
    width:100%;
    height:200px;
    object-fit:cover;
}
</style>
</head>

<body>

<div class="container my-5">
    <h1 class="text-center mb-4">Nos Chambres</h1>

    <?php
    $currentType = "";
    foreach ($rooms as $room):

        // Si on change de type, on ferme la row précédente
        if ($room['type'] !== $currentType):

            if ($currentType !== "") {
                echo "</div><hr>";
            }

            $currentType = $room['type'];

            echo "<h2 class='mt-4 mb-3 text-primary'>$currentType</h2>";
            echo "<div class='row g-4'>";
        endif;
    ?>

        <div class="col-md-4">
            <div class="room-card">
                
<img 
  src="image_hotel/<?= htmlspecialchars($room['image'] ?? 'default.jpg') ?>"
  alt="<?= htmlspecialchars($room['type']) ?>"
  class="img-fluid"
  onerror="this.src='image_hotel/default.jpg';"
>






                <div class="p-3">
                    <h4>Chambre <?= htmlspecialchars($room['numero']) ?></h4>
                    <p><?= htmlspecialchars($room['prix']) ?> € / nuit</p>

                    <a href="voir.php?id=<?= $room['id'] ?>" class="btn btn-outline-primary btn-sm">Voir</a>

                    <!-- Bouton Réserver qui envoie vers reserver.php -->
                    <a href="reserver.php?id=<?= $room['id'] ?>" class="btn btn-primary btn-sm">Réserver</a>
                </div>
            </div>
        </div>

    <?php endforeach; ?>

    </div> <!-- fermeture de la dernière row -->
</div>

</body>
</html>

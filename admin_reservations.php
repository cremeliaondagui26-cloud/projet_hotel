<?php
session_start();
require 'config/db.php';

$stmt = $pdo->query("
    SELECT r.*, rooms.numero, rooms.type 
    FROM reservations r
    JOIN rooms ON rooms.id = r.id_chambre
    ORDER BY r.date_reservation DESC
");
$reservations = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Réservations</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container my-5">
    <h1 class="mb-4">Liste des réservations</h1>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Chambre</th>
                <th>Client</th>
                <th>Email</th>
                <th>Arrivée</th>
                <th>Départ</th>
                <th>Personnes</th>
                <th>Date réservation</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservations as $r): ?>
            <tr>
                <td><?= $r['id'] ?></td>
                <td><?= $r['numero'] ?> (<?= $r['type'] ?>)</td>
                <td><?= $r['nom'] ?></td>
                <td><?= $r['email'] ?></td>
                <td><?= $r['date_arrivee'] ?></td>
                <td><?= $r['date_depart'] ?></td>
                <td><?= $r['personnes'] ?></td>
                <td><?= $r['date_reservation'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

</body>
</html>

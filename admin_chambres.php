<?php
session_start();
require 'config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

$stmt = $pdo->query("SELECT * FROM rooms ORDER BY id DESC");
$rooms = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Admin - Chambres</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container my-5">
    <h1 class="mb-4">Gestion des chambres</h1>

    <a href="admin_chambre_add.php" class="btn btn-primary mb-3">➕ Ajouter une chambre</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Numéro</th>
                <th>Type</th>
                <th>Prix</th>
                <th>Capacité</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($rooms as $room): ?>
            <tr>
                <td><?= $room['id'] ?></td>
                <td><?= $room['numero'] ?></td>
                <td><?= $room['type'] ?></td>
                <td><?= $room['prix'] ?> €</td>
                <td><?= $room['capacite'] ?></td>
                <td><?= $room['statut'] ?></td>
                <td>
                    <a href="admin_chambre_edit.php?id=<?= $room['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                    <a href="admin_chambre_delete.php?id=<?= $room['id'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <a href="admin_dashboard.php" class="btn btn-secondary">Retour</a>
</div>

</body>
</html>

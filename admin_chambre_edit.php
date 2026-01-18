<?php
session_start();
require 'config/db.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM rooms WHERE id = ?");
$stmt->execute([$id]);
$room = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $stmt = $pdo->prepare("
        UPDATE rooms SET numero=?, type=?, description=?, prix=?, capacite=?, image=?, statut=?
        WHERE id=?
    ");

    $stmt->execute([
        $_POST['numero'],
        $_POST['type'],
        $_POST['description'],
        $_POST['prix'],
        $_POST['capacite'],
        $_POST['image'],
        $_POST['statut'],
        $id
    ]);

    header("Location: admin_chambres.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Modifier une chambre</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container my-5">
    <h1>Modifier la chambre <?= $room['numero'] ?></h1>

    <form method="POST">

        <label>Numéro</label>
        <input type="text" name="numero" class="form-control" value="<?= $room['numero'] ?>" required>

        <label>Type</label>
        <input type="text" name="type" class="form-control" value="<?= $room['type'] ?>" required>

        <label>Description</label>
        <textarea name="description" class="form-control"><?= $room['description'] ?></textarea>

        <label>Prix</label>
        <input type="number" name="prix" class="form-control" value="<?= $room['prix'] ?>" required>

        <label>Capacité</label>
        <input type="number" name="capacite" class="form-control" value="<?= $room['capacite'] ?>" required>

        <label>Image</label>
        <input type="text" name="image" class="form-control" value="<?= $room['image'] ?>">

        <label>Statut</label>
        <select name="statut" class="form-select">
            <option value="disponible" <?= $room['statut']=='disponible'?'selected':'' ?>>Disponible</option>
            <option value="reservee" <?= $room['statut']=='reservee'?'selected':'' ?>>Réservée</option>
            <option value="maintenance" <?= $room['statut']=='maintenance'?'selected':'' ?>>Maintenance</option>
        </select>

        <button class="btn btn-primary mt-3">Enregistrer</button>
    </form>

</div>

</body>
</html>

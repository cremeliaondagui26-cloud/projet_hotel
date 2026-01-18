<?php
session_start();
require 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $stmt = $pdo->prepare("
        INSERT INTO rooms (numero, type, description, prix, capacite, image, statut)
        VALUES (?, ?, ?, ?, ?, ?, 'disponible')
    ");

    $stmt->execute([
        $_POST['numero'],
        $_POST['type'],
        $_POST['description'],
        $_POST['prix'],
        $_POST['capacite'],
        $_POST['image']
    ]);

    header("Location: admin_chambres.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Ajouter une chambre</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container my-5">
    <h1>Ajouter une chambre</h1>

    <form method="POST">

        <label>Numéro</label>
        <input type="text" name="numero" class="form-control" required>

        <label>Type</label>
        <input type="text" name="type" class="form-control" required>

        <label>Description</label>
        <textarea name="description" class="form-control"></textarea>

        <label>Prix</label>
        <input type="number" name="prix" class="form-control" required>

        <label>Capacité</label>
        <input type="number" name="capacite" class="form-control" required>

        <label>Image (nom du fichier)</label>
        <input type="text" name="image" class="form-control">

        <button class="btn btn-primary mt-3">Ajouter</button>
    </form>

</div>

</body>
</html>

<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Dashboard Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark px-3">
    <span class="navbar-brand">Admin Hôtel</span>
    <a href="admin_logout.php" class="btn btn-danger btn-sm">Déconnexion</a>
</nav>

<div class="container mt-5">
    <h2>Bienvenue Administrateur</h2>
    <ul>
        <li><a href="admin_chambres.php">Gérer les chambres</a></li>
        <li><a href="admin_reservations.php">Voir les réservations</a></li>
    </ul>
</div>

</body>
</html>


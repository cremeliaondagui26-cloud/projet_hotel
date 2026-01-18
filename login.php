<?php
session_start();
require 'config/db.php';

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Récupérer l'utilisateur
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Vérifier le mot de passe
    if ($user && password_verify($password, $user['password'])) {

        // ✅ STOCKAGE COMPLET EN SESSION
        $_SESSION['user_id'] = $user['id'];
$_SESSION['prenom']  = $user['prenom'];
$_SESSION['nom']     = $user['nom'];
$_SESSION['email']   = $user['email'];
$_SESSION['role']    = $user['role'];
$_SESSION['avatar']  = $user['avatar']; // 🔥 IMPORTANT


        // Avatar (par défaut si vide)
        $_SESSION['avatar']  = !empty($user['avatar']) 
                                ? $user['avatar'] 
                                : 'default.png';

        header("Location: index.php");
        exit;
    }

    // Erreur de connexion
    $_SESSION['error'] = "Email ou mot de passe incorrect";
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Hôtel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            background: linear-gradient(to right, #008080, #00bcd4);
            font-family: 'Segoe UI', sans-serif;
        }
        .navbar {
            padding: 1rem 2rem;
            background-color: #fff;
            border-bottom: 1px solid #ddd;
        }
        .logo img {
            width: 40px;
            border-radius: 50%;
        }
        .btn-primary {
            background-color: #008080;
            border: none;
        }
        .btn-outline-primary {
            border-color: #008080;
            color: #008080;
        }
        .btn-outline-primary:hover {
            background-color: #008080;
            color: #fff;
        }
        .card {
            border-radius: 15px;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <div class="logo">
            <img src="image_hotel/logo%20élégant%20et%20mode.png" alt="Logo Hôtel" style="width:40px;border-radius:50%;">
            <strong><a href="index.php">hotel</a></strong>
        </div>

        <ul class="navbar-nav ms-auto gap-3">
            <li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
            <li class="nav-item"><a class="nav-link" href="service.php">Services</a></li>
            <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
        </ul>

        <a href="reserver.php" class="btn btn-primary ms-3">Réserver</a>
    </div>
</nav>

<!-- FORMULAIRE DE CONNEXION -->
<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-5">
        <div class="card shadow p-4">

            <h2 class="text-center mb-4">
                <i class="fas fa-sign-in-alt"></i> Connexion
            </h2>

            <!-- Message d'erreur -->
            <?php if (!empty($_SESSION['error'])): ?>
                <div class="alert alert-danger text-center">
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <!-- FORMULAIRE -->
            <form action="login.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Se connecter
                </button>
            </form>

            <p class="text-center mt-3">
                Pas de compte ?
                <a href="register.php">Créer un compte</a>
            </p>

            <div class="text-center mt-3">
                <a href="index.php">← Retour à l’accueil</a>
            </div>

        </div>
    </div>
</div>

<!-- FOOTER -->
<footer class="footer mt-5">
    <div class="container text-center py-3">
        Tous droits réservés © 2025
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

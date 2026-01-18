<?php
session_start();
require 'config/db.php';

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom      = trim($_POST['nom']);
    $prenom   = trim($_POST['prenom']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm'];

    // Vérifier que les mots de passe correspondent
    if ($password !== $confirm) {
        $_SESSION['error'] = "Les mots de passe ne correspondent pas";
        header("Location: register.php");
        exit;
    }

    // Vérifier si l'email existe déjà
    $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $check->execute([$email]);

    if ($check->rowCount() > 0) {
        $_SESSION['error'] = "Cet email est déjà utilisé";
        header("Location: register.php");
        exit;
    }

    // Hash du mot de passe
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    // Insertion
    $stmt = $pdo->prepare("
        INSERT INTO users (nom, prenom, email, password, role)
        VALUES (?, ?, ?, ?, 'user')
    ");

    $stmt->execute([$nom, $prenom, $email, $hashed]);

    $_SESSION['success'] = "Compte créé avec succès ! Vous pouvez vous connecter.";
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Hôtel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            background: linear-gradient(to right, #00bcd4, #008080);
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

<!-- FORMULAIRE D'INSCRIPTION -->
<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-6">
        <div class="card shadow p-4">

            <h2 class="text-center mb-4">
                <i class="fas fa-user-plus"></i> Inscription
            </h2>

            <!-- Message d'erreur -->
            <?php if (!empty($_SESSION['error'])): ?>
                <div class="alert alert-danger text-center">
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <!-- FORMULAIRE -->
            <form action="register.php" method="POST">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Prénom</label>
                        <input type="text" name="prenom" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirmer mot de passe</label>
                    <input type="password" name="confirm" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Créer mon compte
                </button>
            </form>

            <p class="text-center mt-3">
                Déjà inscrit ?
                <a href="login.php">Se connecter</a>
            </p>

            <div class="text-center mt-3">
                <a href="index.php">← Retour à l’accueil</a>
            </div>
<div class="mb-3">
    <label class="form-label">Choisir un avatar</label>
    <select name="avatar" class="form-select" required>
        <option value="homme1.png">Homme 1</option>
        <option value="homme2.png">Homme 2</option>
        <option value="homme3.png">Homme 3</option>
        <option value="femme1.png">Femme 1</option>
        <option value="femme2.png">Femme 2</option>
        <option value="femme3.png">Femme 3</option>
    </select>
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

<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require 'config/db.php';

/* Récupération des infos utilisateur */
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

/* Avatar */
$avatar = !empty($user['avatar']) ? $user['avatar'] : 'homme1.png';
$photo = "image_hotel/avatars/" . $avatar;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Profil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #008080, #00bcd4);
            font-family: 'Segoe UI', sans-serif;
        }
        .card {
            border-radius: 15px;
        }
        .photo-profil {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
            border: 4px solid #008080;
        }
        .btn-primary {
            background-color: #008080;
            border: none;
        }
    </style>
</head>

<body>

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-6">
        <div class="card shadow p-4 text-center">

            <!-- PHOTO DE PROFIL -->
            <img src="<?= htmlspecialchars($photo) ?>" class="photo-profil" alt="Photo de profil">

            <!-- INFOS UTILISATEUR -->
            <h2 class="mb-3">
                <?= htmlspecialchars($user['prenom']) ?>
                <?= htmlspecialchars($user['nom']) ?>
            </h2>

            <p><strong>Email :</strong> <?= htmlspecialchars($user['email']) ?></p>
            <p><strong>Rôle :</strong> <?= htmlspecialchars($user['role']) ?></p>

            <!-- ACTIONS -->
            <div class="mt-4 d-grid gap-2">
                <a href="choisir_avatar.php" class="btn btn-outline-primary">
                    Changer ma photo
                </a>
                <a href="modifier_profil.php" class="btn btn-primary">
                    Modifier mes informations
                </a>
                <a href="logout.php" class="btn btn-danger"
                   onclick="return confirm('Êtes-vous sûr de vouloir vous déconnecter ?')">
                    Déconnexion
                </a>
                <a href="index.php" class="btn btn-secondary">
                    Accueil
                </a>
            </div>

        </div>
    </div>
</div>

</body>
</html>

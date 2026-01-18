<?php
session_start();
require 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $avatar = $_POST['avatar'];

    $stmt = $pdo->prepare("UPDATE users SET avatar = ? WHERE id = ?");
    $stmt->execute([$avatar, $_SESSION['user_id']]);

    header("Location: profil.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Choisir avatar</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="card p-4">
        <h3 class="mb-4 text-center">Choisissez votre avatar</h3>

        <form method="POST" class="row g-3 text-center">

            <?php
            $avatars = [
                'homme1.png','homme2.png',
                'femme1.png','femme2.png','femme3.png'
            ];

            foreach ($avatars as $a): ?>
                <div class="col-4">
                    <label>
                        <img src="image_hotel/avatars/<?= $a ?>" width="80" class="rounded-circle mb-2">
                        <br>
                        <input type="radio" name="avatar" value="<?= $a ?>" required>
                    </label>
                </div>
            <?php endforeach; ?>

            <div class="col-12 mt-4">
                <button class="btn btn-primary w-100">Enregistrer</button>
            </div>

        </form>
    </div>
</div>

</body>
</html>

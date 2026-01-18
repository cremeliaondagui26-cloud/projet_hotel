<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require 'config/db.php';

// Récupérer les infos actuelles
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom      = trim($_POST['nom']);
    $prenom   = trim($_POST['prenom']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm'];

    // Vérification email déjà utilisé par quelqu'un d'autre
    $check = $pdo->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
    $check->execute([$email, $_SESSION['user_id']]);

    if ($check->rowCount() > 0) {
        $_SESSION['error'] = "Cet email est déjà utilisé par un autre compte.";
        header("Location: modifier_profil.php");
        exit;
    }

    // Si l'utilisateur veut changer son mot de passe
    if (!empty($password)) {

        if ($password !== $confirm) {
            $_SESSION['error'] = "Les mots de passe ne correspondent pas.";
            header("Location: modifier_profil.php");
            exit;
        }

        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $update = $pdo->prepare("
            UPDATE users SET nom = ?, prenom = ?, email = ?, password = ?
            WHERE id = ?
        ");
        $update->execute([$nom, $prenom, $email, $hashed, $_SESSION['user_id']]);

    } else {
        // Mise à jour sans changer le mot de passe
        $update = $pdo->prepare("
            UPDATE users SET nom = ?, prenom = ?, email = ?
            WHERE id = ?
        ");
        $update->execute([$nom, $prenom, $email, $_SESSION['user_id']]);
    }

    $_SESSION['success'] = "Profil mis à jour avec succès.";
    header("Location: profil.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier mon profil</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #008080, #00bcd4);
            font-family: 'Segoe UI', sans-serif;
        }
        /* FORMULAIRE */
.card {
    border-radius:15px;
    padding:30px;
    box-shadow:0 4px 15px rgba(0,0,0,0.1);
}
.btn-primary {
    background:#008080;
    border:none;
}
.btn-primary:hover {
    background:#006666;
}
        
    </style>
</head>
<body>

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-6">
        <div class="card shadow p-4">

            <h2 class="text-center mb-4">Modifier mes informations</h2>

            <!-- Message d'erreur -->
            <?php if (!empty($_SESSION['error'])): ?>
                <div class="alert alert-danger text-center">
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

   
<main>
            <form action="modifier_profil.php" method="POST">

                <div class="mb-3">
                    <label class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($user['nom']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Prénom</label>
                    <input type="text" name="prenom" class="form-control" value="<?= htmlspecialchars($user['prenom']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
                </div>

                <hr>

                <h5 class="text-center">Changer le mot de passe (optionnel)</h5>

                <div class="mb-3">
                    <label class="form-label">Nouveau mot de passe</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirmer le mot de passe</label>
                    <input type="password" name="confirm" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary w-100">Enregistrer</button>

                <div class="text-center mt-3">
                    <a href="profil.php">← Retour au profil</a>
                </div>

            </form>

        </div>
    </div>
</div>
            </main>
</body>
</html>

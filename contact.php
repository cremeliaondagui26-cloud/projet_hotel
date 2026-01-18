<?php
session_start();
require 'config/db.php';

$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $telephone = trim($_POST['telephone']);
    $message = trim($_POST['message']);

    if ($nom && $email && $message) {
        $stmt = $pdo->prepare(
            "INSERT INTO contacts (nom, email, telephone, message)
             VALUES (?, ?, ?, ?)"
        );
        $stmt->execute([$nom, $email, $telephone, $message]);
        $success = true;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Contact | Hôtel</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<style>
body {
    background:#f8f9fa;
    font-family:'Segoe UI', sans-serif;
}
.hero {
    background: linear-gradient(to right, rgba(0,128,128,.7), rgba(0,188,212,.7)),
                url('image hotel/hotel-luxe.jpg') center/cover no-repeat;
    height:45vh;
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
    text-align:center;
}
.card, .info-box {
    border-radius:15px;
    box-shadow:0 4px 15px rgba(0,0,0,.1);
}
.btn-primary {
    background:#008080;
    border:none;
}
.btn-primary:hover {
    background:#006666;
}
.info-box i {
    color:#008080;
    margin-right:10px;
}
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg bg-white border-bottom">
    <div class="container">
        <strong><a href="index.php" class="navbar-brand">Hotel</a></strong>
        <ul class="navbar-nav ms-auto gap-3">
            <li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
            <li class="nav-item"><a class="nav-link" href="service.php">Services</a></li>
            <li class="nav-item"><a class="nav-link active" href="contact.php">Contact</a></li>
        </ul>
    </div>
</nav>

<!-- HERO -->
<div class="hero">
    <div>
        <h1>Contactez-nous</h1>
        <p>Nous sommes à votre écoute 7j/7</p>
    </div>
</div>

<!-- CONTACT -->
<div class="container my-5">
    <div class="row g-4">

        <!-- FORMULAIRE -->
        <div class="col-md-7">
            <div class="card p-4">
                <h3 class="mb-4">Envoyer un message</h3>

               <?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success">
        ✅ Message envoyé avec succès !
    </div>
<?php endif; ?>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger">
        ❌ Veuillez remplir tous les champs obligatoires.
    </div>
<?php endif; ?>


                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nom complet</label>
                        <input type="text" name="nom" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Téléphone</label>
                        <input type="text" name="telephone" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea name="message" class="form-control" rows="5" required></textarea>
                    </div>

                    <button class="btn btn-primary w-100">Envoyer</button>
                </form>
            </div>
        </div>

        <!-- INFOS -->
        <div class="col-md-5">
            <div class="info-box p-4 mb-3">
                <h5><i class="fas fa-map-marker-alt"></i> Adresse</h5>
                <p>123 Rue de l'Hôtel, Paris</p>
            </div>

            <div class="info-box p-4 mb-3">
                <h5><i class="fas fa-phone"></i> Téléphone</h5>
                <p>01 23 45 67 89</p>
            </div>

            <div class="info-box p-4 mb-3">
                <h5><i class="fas fa-envelope"></i> Email</h5>
                <p>contact@hotelbooking.com</p>
            </div>

            <div class="info-box p-4">
                <h5><i class="fas fa-clock"></i> Horaires</h5>
                <p>Lundi - Vendredi : 9h - 18h</p>
            </div>
        </div>

    </div>
</div>

<footer class="bg-dark text-white text-center py-3">
    © 2025 Hôtel — Tous droits réservés
</footer>

</body>
</html>

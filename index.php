<?php
session_start();
try {
    $pdo = new PDO(
        "mysql:host=localhost;dbname=projet_hotel;charset=utf8mb4",
        "root",
        "",
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("Erreur connexion DB : " . $e->getMessage());
}

// Gestion des avis
$avis_success = false;
$avis_error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $message = trim($_POST['message']);
    $note = filter_var($_POST['note'], FILTER_VALIDATE_INT, [
        'options' => ['min_range' => 1, 'max_range' => 5]
    ]);
    $user_id = $_SESSION['user_id'];

    if ($message && $note) {
        $stmt = $pdo->prepare("INSERT INTO avis (user_id, message, note) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $message, $note]);
        $avis_success = true;
    } else {
        $avis_error = "Veuillez remplir tous les champs correctement.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hôtel</title>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        .navbar .nav-item span {
    font-size: 14px;
}

        .navbar {
             padding: 1rem 2rem;
              background-color: #fff; 
              border-bottom: 1px solid #ddd;
             }
        .logo {
             display: flex;
              align-items: center;
               gap: 10px;
             }
        .logo img {
             width: 40px; 
             border-radius: 50%;
             }
        .btn-reserver { 
            background-color: #008080; 
            color: #fff;
            padding: 8px 16px; 
            border-radius: 5px;
             font-weight: bold; 
             text-decoration: none;
             }
        .hero-image { width: 100%; height: auto; object-fit: cover; }
        .card-overlay { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(255,255,255,0.9); padding: 2rem; border-radius: 10px; max-width: 500px; text-align: center; }
        .card-overlay h5 { font-size: 2rem; margin-bottom: 1rem; }
        .hero-container { position: relative; width: 100%; margin-bottom: 2rem; }
        .navbar .btn { border-radius: 20px; padding: 6px 14px; }
        .btn-outline-primary { border-color: #008080; color: #008080; }
        .btn-outline-primary:hover { background-color: #008080; color: #fff; }
        .btn-primary { background-color: #008080; border: none; }
        .image-row { display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; margin-bottom: 2rem; }
        .image-row img { width: 150px; height: auto; margin-bottom: 10px; }
        .main1 { font-family: Arial, sans-serif; background-color: #fff; margin: 0; padding: 40px; display: flex; justify-content: center; }
        .stats-container { display: flex; gap: 60px; text-align: center; }
        .stat { color: #00bcd4; font-size: 48px; font-weight: bold; }
        .label { color: #333; font-size: 18px; margin-top: 8px; }
        @media (max-width: 600px) { .stats-container { flex-direction: column; gap: 30px; } }
        .main3 { background-color: #fdf6f0; padding: 50px 0; }
        .btn-teal { background-color: #00bcd4; color: white; }
        .btn-teal:hover { background-color: #0097a7; }
        .main4 { background-color: #fdf6f0; padding: 50px 0; }
        .contact-box { background-color: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.05); padding: 20px; text-align: center; }
        .contact-title { font-weight: bold; font-size: 18px; margin-bottom: 8px; color: #333; }
        .contact-text { font-size: 16px; color: #555; }
        .footer { background-color: #000; color: #fff; padding: 20px 0; }
        .footer a { color: #fff; text-decoration: none; margin-left: 20px; }
        .footer a:hover { text-decoration: underline; }
        .social-icons { display: flex; justify-content: center; gap: 20px; margin-top: 20px; }
        .icon { width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 26px; text-decoration: none; }
        .facebook { background:#3b5998; } .twitter { background:#1da1f2; } .instagram { background:#d62976; } .tiktok { background:#000; }
    </style>
</head>
<body>

<!-- Navbar -->
<header>
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <div class="logo d-flex align-items-center gap-2">
            <img src="image_hotel/logo%20élégant%20et%20mode.png" alt="Logo Hôtel">
            <strong>Hôtel</strong>
        </div>

        <ul class="navbar-nav ms-auto gap-3">
            <li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
            <li class="nav-item"><a class="nav-link" href="service.php">Services</a></li>
            <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
            <li class="nav-item"><a href="chambres.php" class="btn btn-primary">Réserver</a></li>
<?php if (isset($_SESSION['user_id'])): ?>

    <li class="nav-item d-flex align-items-center">

        <img src="image_hotel/avatars/<?= htmlspecialchars($_SESSION['avatar'] ?? 'default.png') ?>"
             width="35"
             height="35"
             class="rounded-circle me-2"
             alt="Avatar">

        <span class="me-3 fw-semibold">
            <?= htmlspecialchars($_SESSION['prenom'] ?? '') ?>
            <?= htmlspecialchars($_SESSION['nom'] ?? '') ?>
        </span>

        <a href="profil.php" class="btn btn-outline-primary btn-sm me-2">
            Mon compte
        </a>

        <a href="logout.php"
           class="btn btn-danger btn-sm"
           onclick="return confirm('Êtes-vous sûr de vouloir vous déconnecter ?');">
            Déconnexion
        </a>

    </li>

<?php else: ?>

    <li class="nav-item">
        <a href="login.php" class="btn btn-outline-primary btn-sm">Connexion</a>
    </li>

    <li class="nav-item">
        <a href="register.php" class="btn btn-primary btn-sm">Inscription</a>
    </li>

<?php endif; ?>

        </ul>
    </div>
</nav>
</header>

<!-- Hero Section -->
<main>
    <div class="hero-container">
        <img src="image_hotel/pexels-pixabay-262048.jpg" alt="Chambre d'hôtel" class="hero-image">
        <div class="card-overlay">
            <h5>Évadez-vous</h5>
            <p>Votre prochaine aventure inoubliable commence ici, réservez maintenant</p>
            <a href="voir.php?id=1" class="btn btn-primary">Voir</a>
        </div>
    </div>

    <div class="hero-container">
        <img src="image_hotel/pexels-pixabay-210265.jpg" alt="Offre spéciale" class="hero-image">
        <div class="card-overlay">
            <h5>Offre Spéciale Limitée!</h5>
            <p>Réservez votre séjour de rêve et profitez dès maintenant des offres incroyables</p>
            <a href="reserver.php?id=4" class="btn btn-primary">Réserver maintenant</a>
        </div>
    </div>
</main>

<!-- Offres -->
<h1 class="text-center mt-5">Nos Offres</h1>
<div class="row row-cols-1 row-cols-md-2 g-4 mt-3">
    <!-- Exemples de chambres -->
    <div class="col">
        <div class="card">
            <img src="image_hotel/chambre_superieur.jpg" class="card-img-top" alt="Chambre standard">
            <div class="card-body">
                <h5 class="card-title">Standard 75€/nuit</h5>
                <p class="card-text">Confortable et adorable pour un séjour agréable.</p>
                <a href="reserver.php?id=1" class="btn btn-primary">Choisir</a>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <img src="image_hotel/chambre_standard.jpg" class="card-img-top" alt="Chambre supérieur">
            <div class="card-body">
                <h5 class="card-title">Supérieur 120€/nuit</h5>
                <p class="card-text">Plus d'espace et de services pour une expérience améliorée.</p>
                <a href="reserver.php?id=2" class="btn btn-primary">Choisir</a>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <img src="image_hotel/chambre_suite.jpg" class="card-img-top" alt="Suite">
            <div class="card-body">
                <h5 class="card-title">Suite 200€/nuit</h5>
                <p class="card-text">Luxe et exclusivité avec des équipements haut de gamme.</p>
                <a href="reserver.php?id=3" class="btn btn-primary">Choisir</a>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <img src="image_hotel/chambre_presidentielle.jpg" class="card-img-top" alt="Présidentielle">
            <div class="card-body">
                <h5 class="card-title">Présidentielle</h5>
                <p class="card-text">Le sommet du raffinement pour une occasion spéciale.</p>
                <a href="reserver.php?id=4" class="btn btn-primary">Choisir</a>
            </div>
        </div>
    </div>
</div>

<!-- Partenaires -->
<h1 class="text-center mt-5">Nos partenaires</h1>
<div class="image-row">
    <img src="image_hotel/cafe.jpg" alt="Café">
    <img src="image_hotel/plaid.jpg" alt="Plaid">
    <img src="image_hotel/voiture.jpg" alt="Voiture">
    <img src="image_hotel/prada.jpg" alt="Prada">
    <img src="image_hotel/orange.jpg" alt="Orange">
</div>

<!-- Stats -->
<div class="main1">
    <div class="stats-container">
        <div>
            <div class="stat">1000+</div>
            <div class="label">Clients satisfaits</div>
        </div>
        <div>
            <div class="stat">500+</div>
            <div class="label">Destinations</div>
        </div>
        <div>
            <div class="stat">10 000+</div>
            <div class="label">Réservations</div>
        </div>
    </div>
</div>

<!-- À propos -->
<main class="mt-5">
    <div class="clearfix">
        <img src="image_hotel/piscine.jpg" class="col-md-6 float-md-end mb-3 ms-md-3" alt="Piscine">
        <h1>A propos de nous</h1>
        <p> Bienvenue chez 'Voyages Éclatants', votre partenaire de confiance pour des réservations d'hôtels inoubliables. Nous nous engageons à vous offrir une expérience de réservation sans tracas et des séjours exceptionnels. Notre mission est de connecter les voyageurs avec des hébergements uniques qui correspondent à leurs désirs. Nous croyons que chaque voyage doit être une occasion spéciale, remplie de moments mémorables. </p> <p> Nous sommes passionnés par l'hospitalité et dévoués à fournir un service client hors pair. Votre satisfaction est notre priorité absolue, de la recherche de l'hôtel parfait à votre départ. </p>
</main>
</main> <h1 class="text-center">Nos questions fréquentes</h1> <div class="bg-light"> <div class="container py-5"> <div class="row justify-content-center"> <div class="col-md-8"> <div class="card shadow-sm border-0"> <div class="card-body"> <h2 class="card-title text-center mb-4">Comment réserver un hôtel ?</h2> <p class="card-text fs-5 text-muted"> Pour réserver un hôtel, naviguez sur notre site, choisissez votre destination et vos dates, puis sélectionnez l'hôtel qui vous convient. Cliquez sur <strong>'Réserver'</strong> et suivez les instructions. </p> </div> </div> </div> </div> </div> <div class="bg-light"> <div class="container py-5"> <div class="row justify-content-center"> <div class="col-md-8"> <div class="card shadow-sm border-0"> <div class="card-body"> <h2 class="card-title text-center mb-4">Quelles sont les options de paiement ?</h2> <p class="card-text fs-5 text-muted"> Nous acceptons les principales cartes de crédit <strong>(Visa, MasterCard, American Express)</strong> ainsi que PayPal pour un paiement sécurisé et pratique. </p> </div> </div> </div> </div> </div> <div class="bg-light"> <div class="container py-5"> <div class="row justify-content-center"> <div class="col-md-8"> <div class="card shadow-sm border-0"> <div class="card-body"> <h2 class="card-title text-center mb-4">Puis-je modifier ma réservation?</h2> <p class="card-text fs-5 text-muted"> Oui, vous pouvez modifier votre réservation <strong>en vous connectant à votre compte ou en contactant notre service client.</strong>Des frais peuvent s'appliquer selon les conditions de l'hôtel. </p> </div> </div> </div> </div> </div> <div class="bg-light"> <div class="container py-5"> <div class="row justify-content-center"> <div class="col-md-8"> <div class="card shadow-sm border-0"> <div class="card-body"> <h2 class="card-title text-center mb-4">Comment annuler ma réservation ?</h2> <p class="card-text fs-5 text-muted"> Pour annuler, accédez à la section <strong> 'Mes Réservations'</strong>de votre compte ou contactez-nous directement. Veuillez consulter la politique d'annulation de l'hôtel </p> </div> </div> </div> </div> </div> <div class="bg-light"> <div class="container py-5"> <div class="row justify-content-center"> <div class="col-md-8"> <div class="card shadow-sm border-0"> <div class="card-body"> <h2 class="card-title text-center mb-4">Offrez-vous des réductions ?</h2> <p class="card-text fs-5 text-muted"> Oui, nous proposons régulièrement <strong>des offres spéciales et des réductions sur une sélection d'hôtels.</strong> des offres spéciales et des réductions sur une sélection d'hôtels. </p> </div> </div> </div> </div> </div>
<!-- Avis -->
<div class="main3">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4 fw-bold">Laisser un avis</h2>
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <div class="alert alert-warning text-center">
                        ⚠️ Vous devez <a href="login.php">vous connecter</a> ou <a href="register.php">créer un compte</a> pour laisser un avis.
                    </div>
                <?php else: ?>
                    <?php if ($avis_success): ?>
                        <div class="alert alert-success">✅ Merci pour votre avis !</div>
                    <?php endif; ?>
                    <?php if ($avis_error): ?>
                        <div class="alert alert-danger"><?= $avis_error ?></div>
                    <?php endif; ?>
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Votre avis</label>
                            <textarea class="form-control" name="message" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Note</label>
                            <select name="note" class="form-control" required>
                                <option value="">Choisir une note</option>
                                <option value="5">⭐⭐⭐⭐⭐ (Excellent)</option>
                                <option value="4">⭐⭐⭐⭐ (Très bien)</option>
                                <option value="3">⭐⭐⭐ (Bien)</option>
                                <option value="2">⭐⭐ (Moyen)</option>
                                <option value="1">⭐ (Mauvais)</option>
                            </select>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-teal">Envoyer mon avis</button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Contact -->
<div class="main4">
    <div class="container py-5">
        <div class="row g-4 justify-content-center">
            <div class="col-md-3 col-sm-6">
                <div class="contact-box"><div class="contact-title">Tél</div><div class="contact-text">01 23 45 67 89</div></div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="contact-box"><div class="contact-title">Email</div><div class="contact-text">contact@hotelbooking.com</div></div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="contact-box"><div class="contact-title">Adresse</div><div class="contact-text">123 Rue de l'Hôtel<br>75001 Paris</div></div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="contact-box"><div class="contact-title">Horaires</div><div class="contact-text">Lundi - Vendredi<br>9h - 18h</div></div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">Tous droits réservés © 2025</div>
            <div class="col-md-6 text-center text-md-end">
                <a href="index.php">Accueil</a>
                <a href="service.php">Services</a>
                <a href="apropos.php">À Propos</a>
                <a href="contact.php">Contact</a>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
function confirmerDeconnexion(event) {
    event.preventDefault();
    if (confirm("Êtes-vous sûr de vouloir vous déconnecter ?")) {
        window.location.href = "logout.php";
    }
}
</script>

</body>
</html>

<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>À propos | Hôtel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { font-family:'Segoe UI',sans-serif; background:#f8f9fa; }
        .hero {
            background: linear-gradient(to right,#008080,#00bcd4);
            color:white; padding:60px 0; text-align:center;
        }
        .section { padding:60px 0; }
        .section h2 { color:#008080; margin-bottom:20px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-white border-bottom">
    <div class="container">
        <a class="navbar-brand" href="index.php">Hôtel</a>
        <ul class="navbar-nav ms-auto gap-3">
            <li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
            <li class="nav-item"><a class="nav-link" href="service.php">Services</a></li>
            <li class="nav-item"><a class="nav-link" href="chambres.php">Chambres</a></li>
            <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
        </ul>
    </div>
</nav>

<div class="hero">
    <div class="container">
        <h1>À propos de notre hôtel</h1>
        <p>Un lieu d’exception, où chaque détail compte</p>
    </div>
</div>

<div class="container section">
    <div class="row">
        <div class="col-md-6">
            <h2>Notre histoire</h2>
            <p>
                Situé au cœur de la ville, notre hôtel accueille des voyageurs du monde entier
                depuis plusieurs années. Nous avons fait de l’hospitalité, du confort et de
                l’élégance notre signature.
            </p>
        </div>
        <div class="col-md-6">
            <h2>Notre philosophie</h2>
            <p>
                Nous croyons qu’un séjour réussi est une expérience complète : une chambre agréable,
                un service attentionné, une gastronomie soignée et une ambiance chaleureuse.
            </p>
        </div>
    </div>
</div>

</body>
</html>

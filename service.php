<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Nos Services | Hôtel</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- BOOTSTRAP & ICONS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<style>
/* NAVBAR */
.navbar {
  background:#fff;
  border-bottom:1px solid #ddd;
  padding:15px;
}
.logo img { width:40px; border-radius:50%; }
.btn-reserver {
  background:#008080;
  color:#fff;
  padding:8px 16px;
  border-radius:5px;
  text-decoration:none;
  font-weight:bold;
}
.navbar .btn {
  border-radius:20px;
  padding:6px 14px;
}
.btn-outline-primary {
  border-color:#008080;
  color:#008080;
}
.btn-outline-primary:hover {
  background:#008080;
  color:#fff;
}
.btn-primary {
  background:#008080;
  border:none;
}

/* SECTION HERO */ 
.hero { 
  background: linear-gradient(to right,
   rgba(0,128,128,0.7), 
   rgba(0,188,212,0.7)), 
   url('image hotel/hotel-luxe.jpg') center/cover no-repeat;
  height: 60vh;
  display: flex;
  justify-content: center; 
  align-items: center;
  color: white;
  text-align: center;
} 
.hero h1 {
  font-size: 3.5rem;
  font-weight: bold;
}
.hero p { 
  font-size: 1.3rem;
}

/* CARTES DE SERVICES */ 
.service-card {
  background: white;
  border-radius: 15px; 
  padding: 30px; 
  text-align: center; 
  transition: 0.3s;
  box-shadow: 0 4px 15px rgba(0,0,0,0.1); 
} 
.service-card:hover {
  transform: translateY(-10px); 
  box-shadow: 0 8px 25px rgba(0,0,0,0.2);
}
.service-card i {
  font-size: 3rem; 
  color:#008080;
  margin-bottom: 15px;
}
.service-card h4 {
  font-weight: bold;
  margin-bottom: 10px;
}

/* SECTION TITRE */
.section-title { 
  text-align: center;
  margin: 60px 0 40px;
} 
.section-title h2 {
  font-size: 2.8rem;
  font-weight: bold;
  color: #008080;
} 
.section-title p { 
  font-size: 1.2rem;
  color: #555;
}

/* FOOTER */
footer {
  background:#000;
  color:#fff;
  padding:20px 0;
}
footer a {
  color:#fff;
  margin-left:15px;
  text-decoration:none;
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

         <a href="reserver.php?id=2" class="btn btn-primary">Réserver</a>

        <?php if (isset($_SESSION['user_id'])): ?>
            <li class="nav-item">
                <a class="btn btn-outline-primary btn-sm" href="profil.php">
                    <i class="fas fa-user"></i> Mon compte
                </a>
            </li>

            <li class="nav-item">
                <a class="btn btn-danger btn-sm" href="logout.php">
                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                </a>
            </li>

        <?php else: ?>
            <li class="nav-item">
                <a class="btn btn-outline-primary btn-sm" href="login.php">
                    <i class="fas fa-sign-in-alt"></i> Connexion
                </a>
            </li>

            <li class="nav-item">
                <a class="btn btn-primary btn-sm" href="register.php">
                    <i class="fas fa-user-plus"></i> Inscription
                </a>
            </li>
        <?php endif; ?>
    </div>
</nav>

<!-- HERO -->
<div class="hero">
   <div>
     <h1>Découvrez Nos Services</h1>
     <p>Un séjour d’exception, pensé pour votre confort et votre bien-être</p> 
   </div>
</div>

<!-- TITRE -->
<div class="section-title">
  <h2>Des prestations haut de gamme</h2>
  <p>Nous mettons tout en œuvre pour rendre votre séjour inoubliable</p>
</div>

<!-- SERVICES -->
<div class="container">
  <div class="row g-4">

    <div class="col-md-4">
      <div class="service-card">
        <i class="fas fa-spa"></i>
        <h4>Spa & Bien-être</h4>
        <p>Massages, sauna, hammam et soins relaxants pour une détente absolue.</p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="service-card">
        <i class="fas fa-utensils"></i>
        <h4>Restaurant Gastronomique</h4>
        <p>Une cuisine raffinée préparée par nos chefs étoilés, avec des produits frais.</p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="service-card">
        <i class="fas fa-swimming-pool"></i>
        <h4>Piscine Chauffée</h4>
        <p>Profitez d’une piscine intérieure chauffée avec vue panoramique.</p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="service-card">
        <i class="fas fa-dumbbell"></i>
        <h4>Salle de Sport</h4>
        <p>Un espace moderne équipé pour vos séances de fitness et cardio.</p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="service-card">
        <i class="fas fa-bed"></i>
        <h4>Chambres & Suites</h4>
        <p>Des chambres élégantes, spacieuses et parfaitement équipées.</p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="service-card">
        <i class="fas fa-bell-concierge"></i>
        <h4>Conciergerie 24/7</h4>
        <p>Notre équipe est disponible à toute heure pour répondre à vos besoins.</p>
      </div>
    </div>

  </div>
</div>

<br><br>

<!-- FOOTER -->
<footer>
  <div class="container d-flex justify-content-between">
    <span>© 2025 Hôtel</span>
    <div>
      <a href="index.php">Accueil</a>
      <a href="service.php">Services</a>
      <a href="contact.php">Contact</a>
    </div>
  </div>
</footer>

<!-- BOOTSTRAP JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

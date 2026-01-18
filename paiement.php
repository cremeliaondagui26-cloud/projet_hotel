<?php
// paiement.php
session_start();

// Exemple de données (tu peux les récupérer depuis la réservation)
$chambre = "Chambre Deluxe";
$prix = 75000; // FCFA
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Paiement | Hôtel</title>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * {
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
}

body {
    background: linear-gradient(120deg, #0f2027, #203a43, #2c5364);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0;
}

.payment-container {
    background: #fff;
    width: 400px;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.3);
}

h1 {
    text-align: center;
    color: #2c5364;
}

.resume {
    background: #f5f7fa;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.resume h2 {
    margin-top: 0;
    font-size: 18px;
}

.payment-form h2 {
    font-size: 18px;
    margin-bottom: 10px;
}

label {
    display: block;
    margin-top: 10px;
    font-weight: 600;
}

input {
    width: 100%;
    padding: 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
    margin-top: 5px;
}

.row {
    display: flex;
    gap: 10px;
}

button {
    margin-top: 20px;
    width: 100%;
    background: #2c5364;
    color: #fff;
    border: none;
    padding: 12px;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    background: #203a43;
}

.secure {
    text-align: center;
    margin-top: 10px;
    font-size: 13px;
    color: #555;
}

    </style>
</head>
<body>

<div class="payment-container">

    <h1>Paiement sécurisé</h1>

    <div class="resume">
        <h2>Résumé de la réservation</h2>
        <p><strong>Chambre :</strong> <?= $chambre ?></p>
        <p><strong>Montant :</strong> <?= number_format($prix, 0, ',', ' ') ?> FCFA</p>
    </div>

    <form action="confirmation.php" method="POST" class="payment-form">

        <h2>Informations de paiement</h2>

        <label>Nom sur la carte</label>
        <input type="text" name="nom" required>

        <label>Numéro de carte</label>
        <input type="text" placeholder="1234 5678 9012 3456" required>

        <div class="row">
            <div>
                <label>Date d'expiration</label>
                <input type="text" placeholder="MM/AA" required>
            </div>

            <div>
                <label>CVV</label>
                <input type="password" placeholder="123" required>
            </div>
        </div>

        <button type="submit">Payer maintenant</button>

        <p class="secure">🔒 Paiement sécurisé</p>
    </form>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$to = $email;
$subject = "Confirmation de paiement - Hôtel";
$message = "
Bonjour $nom,

Votre paiement a bien été reçu.
Montant : $prix FCFA
Chambre : $chambre

Votre facture est disponible après connexion.

Merci pour votre confiance.
";

$headers = "From: hotel@exemple.com";

mail($to, $subject, $message, $headers);
?>
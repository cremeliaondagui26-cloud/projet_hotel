<?php
require 'config/db.php';

$id = $_GET['id']; // id chambre

$stmt = $pdo->prepare("SELECT date_arrivee, date_depart FROM reservations WHERE id_chambre = ?");
$stmt->execute([$id]);
$reservations = $stmt->fetchAll();
?>

<h2>Calendrier des disponibilites</h2>

<table border="1" cellpadding="10">
<tr><th>Arrivee</th><th>Depart</th></tr>

<?php foreach ($reservations as $r): ?>
<tr>
    <td><?= $r['date_arrivee'] ?></td>
    <td><?= $r['date_depart'] ?></td>
</tr>
<?php endforeach; ?>

</table>

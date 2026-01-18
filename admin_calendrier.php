<?php
require 'config/db.php';
<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit;
}


$stmt = $pdo->query("
    SELECT r.*, rooms.numero 
    FROM reservations r
    JOIN rooms ON rooms.id = r.id_chambre
");
$res = $stmt->fetchAll();
?>

<h2>Calendrier Admin</h2>

<table border="1" cellpadding="10">
<tr>
    <th>Chambre</th>
    <th>Arrivee</th>
    <th>Depart</th>
</tr>

<?php foreach ($res as $r): ?>
<tr>
    <td><?= $r['numero'] ?></td>
    <td><?= $r['date_arrivee'] ?></td>
    <td><?= $r['date_depart'] ?></td>
</tr>
<?php endforeach; ?>

</table>

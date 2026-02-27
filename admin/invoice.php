<?php
include '../config/connect.php';

$db = (new database)->connection();
$id = $_GET['id'];

$q = $db->prepare("
SELECT 
a.id,
a.appointment_date,
a.paid_amount,
a.payment_method,
s.service_name,
s.price

FROM appointments a
JOIN appointment_services aps ON aps.appointment_id=a.id
JOIN services s ON s.id=aps.service_id
WHERE a.id=?
");

$q->execute([$id]);
$data = $q->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Invoice</h2>
<p>Appointment ID: <?= $id ?></p>

<table border="1">
<tr>
<th>Service</th>
<th>Price</th>
</tr>

<?php foreach($data as $row): ?>
<tr>
<td><?= $row['service_name'] ?></td>
<td><?= $row['price'] ?></td>
</tr>
<?php endforeach; ?>

</table>

<h3>Total Paid: Rs <?= $data[0]['paid_amount'] ?></h3>
<p>Method: <?= $data[0]['payment_method'] ?></p>
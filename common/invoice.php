<?php
session_start();
if($_SESSION['role'] != 2 && $_SESSION['role'] != 1){
    header("location:../auth/login.php");
}
include '../config/connect.php';
include '../classes/oppointment.php';

$db = (new database)->connection();
$sys = new SalonBookingSystem($db);
$id = $_GET['id'];

$sys->completeAfterPayment($id);
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

<!DOCTYPE html>
<html>
<head>
<title>Invoice</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.invoice-box{
    max-width:700px;
    margin:auto;
   
    background:white;
    padding:30px;
    border:1px solid #ddd;
}

@media print{
    .no-print{
        display:none;
    }
}
</style>

</head>

<body class="bg-light pt-5">

<div class="invoice-box shadow">

    <div class="text-center mb-4">
        <h2>Elegant Salon</h2>
        <h4 class="text-muted">Invoice</h4>
    </div>

    <p><strong>Appointment ID:</strong> <?= $id ?></p>
    <p><strong>Date:</strong> <?= $data[0]['appointment_date'] ?></p>

    <table class="table table-bordered mt-5 mb-5">
        <thead class="table-dark">
            <tr>
                <th>Service</th>
                <th class="text-end">Price (Rs)</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach($data as $row): ?>
        <tr>
            <td><?= $row['service_name'] ?></td>
            <td class="text-end"><?= $row['price'] ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <div class="text-start mt-3">
        <h4>Total Paid: <span class="text-success">Rs <?= $data[0]['paid_amount'] ?></span></h4>
        <p><strong>Payment Method:</strong> <?= $data[0]['payment_method'] ?></p>
    </div>

    <div class="text-center mt-4 no-print">
        <button onclick="window.print()" class="btn btn-danger">
            Print Invoice
        </button>
    </div>

</div>

</body>
</html>
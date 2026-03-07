<?php
session_start();
if($_SESSION['role'] != 2 && $_SESSION['role'] != 1){
    header("location:../auth/login.php");
}
include '../config/connect.php';
include '../classes/inventory.php';

$db = (new database)->connection();
$inv = new Inventory($db);

$data = $inv->getAll();

foreach($data as $row){
    if($row['quantity'] <= $row['min_limit']){
        echo "<script>alert('Low stock: {$row['product_name']}')</script>";
    }
}

/*
ROLE CONTROL
1 = admin
2 = receptionist
3 = staff
*/
$canEdit = ($_SESSION['role']==1 || $_SESSION['role']==2);

if(isset($_POST['reduce']) && $canEdit){
    $inv->reduceStock($_POST['product_id'],$_POST['qty']);
    header("Location: ../common/inventory.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ADMIN2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../asset/dashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../asset/dashboard/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body>

<div class="card shadow m-5 mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-danger">All Inventory</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                       
<tr>
<th>Product</th>
<th>Quantity</th>
<th>Status</th>
<?php if($canEdit): ?>
<th>Use Product</th>
<?php endif; ?>
</tr>

<?php foreach($data as $row): ?>

<tr>

<td><?= $row['product_name'] ?></td>

<td><?= $row['quantity'] ?></td>

<td>
<?php if($row['quantity'] <= $row['min_limit']): ?>
<span style="color:red;font-weight:bold">
LOW STOCK ⚠
</span>
<?php else: ?>
OK
<?php endif; ?>
</td>

<?php if($canEdit): ?>
<td>
<form method="post">
<input type="hidden" name="product_id" value="<?= $row['id'] ?>">
<input type="number" name="qty" required min="1" placeholder="Used">
<button name="reduce">Update</button>
</form>
</td>
<?php endif; ?>

</tr>

<?php endforeach; ?>

</table>
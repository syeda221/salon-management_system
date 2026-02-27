<?php
session_start();

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
    header("Location: inventory.php");
}
?>

<h2>Inventory</h2>

<table border="1" cellpadding="10">
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
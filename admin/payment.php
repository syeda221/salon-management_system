<?php
include '../config/connect.php';
include '../classes/pay.php';

$db = (new database)->connection();
$payment = new Payment($db);

$appointment_id = $_GET['id'];
$total = $payment->getTotalAmount($appointment_id);
?>

<h2>Payment</h2>

<p>Total Amount: <b>Rs <?= $total ?></b></p>

<form method="post">
    <select name="method">
        <option value="cash">Cash</option>
        <option value="card">Card</option>
        <!-- <option value="online">Online</option> -->
    </select>

    <button type="submit" name="pay">Pay Now</button>
</form>

<?php
if(isset($_POST['pay'])){
    $amount = $payment->makePayment($appointment_id,$_POST['method']);

    echo "<script>
        alert('Payment successful');
        window.location='invoice.php?id=$appointment_id';
    </script>";
}
?>
<?php
include '../config/connect.php';
include '../classes/oppointment.php';

$conn = (new database)->connection();
$sys  = new SalonBookingSystem($conn);

$data = $sys->getConfirmedAppointments();
?>

<h2>Confirmed Appointments</h2>

<table border="1" cellpadding="10">

<tr>
<th>Client</th>
<th>Email</th>
<th>Service</th>
<th>Date</th>
<th>Time</th>
<th>Stylist</th>

</tr>

<?php foreach($data as $row){ ?>

<tr>

<td><?php echo $row['client_name']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['services']; ?></td>
<td><?php echo $row['appointment_date']; ?></td>
<!-- <td>Rs <?php echo $row['price']; ?></td> -->

<td>
<?php echo date("h:i A", strtotime($row['slot_time'])); ?>
</td>

<td><?php echo $row['staff_name']; ?></td>
<td>
<?php if($row['payment_status'] == 'unpaid'): ?>
    <a href="payment.php?id=<?php echo $row['id']; ?>" 
       class="btn btn-success">Take Payment</a>
<?php else: ?>
    <a href="invoice.php?id=<?php echo $row['id']; ?>" 
       class="btn btn-primary">View Invoice</a>
<?php endif; ?>
</td>
</tr>

<?php } ?>

</table>
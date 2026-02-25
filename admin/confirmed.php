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
<td><?php echo $row['service_name']; ?></td>
<td><?php echo $row['appointment_date']; ?></td>

<td>
<?php echo date("h:i A", strtotime($row['slot_time'])); ?>
</td>

<td><?php echo $row['staff_name']; ?></td>

</tr>

<?php } ?>

</table>
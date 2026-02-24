<?php
include '../config/connect.php';
include '../classes/oppointment.php';

$conn=(new database)->connection();
$sys=new SalonBookingSystem($conn);

$sys->rejectAppointment($_GET['id']);

echo "Appointment rejected";
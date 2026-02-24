<?php
include '../config/connect.php';
include '../classes/SalonBookingSystem.php';

$sys=new SalonBookingSystem($conn);
$sys->rejectAppointment($_GET['id']);

echo "Appointment rejected";
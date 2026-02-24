<?php
include '../config/connect.php';
include '../classes/oppointment.php';

$sys=new SalonBookingSystem($conn);
$sys->confirmAppointment($_GET['id']);

echo "Appointment confirmed";
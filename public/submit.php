<?php
include '../config/connect.php';
include '../classes/oppointment.php';

$conn=(new database)->connection();
$sys=new SalonBookingSystem($conn);

$sys->createAppointment(
$_POST['name'],
$_POST['email'],
$_POST['phone'],
$_POST['date'],
$_POST['slot_id'],
$_POST['services']
);

echo "Booking request sent successfully";
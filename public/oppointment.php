<?php
include '../config/connect.php';
include '../classes/oppointment.php';
$conn = (new database)->connection();
$sys=new SalonBookingSystem($conn);

$result=$sys->createAppointment(
$_POST['name'],
$_POST['email'],
$_POST['phone'],
// $_POST['staff_id'],
$_POST['date'],
$_POST['slot_id'],
$_POST['services']
);

echo "Booking request sent. Waiting admin approval.";
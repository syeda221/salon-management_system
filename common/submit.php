<?php
session_start();
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

if(isset($_SESSION['role']) && $_SESSION['role'] == 2){
    header("Location: ../receptionist/index.php");
}else{
    header("Location: ../public/index.php");
}
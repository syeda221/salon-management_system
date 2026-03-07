<?php
require '../classes/oppointment.php';
require '../config/connect.php';
$conn = (new database)->connection();
$system = new SalonBookingSystem($conn);

$appointment_id = $_GET['id']; // or from POST

$system->completeAfterPayment($appointment_id);
$feedback_link = 
"http://localhost/try/common/feedback.php?appointment_id=".$appointment_id;
<?php
include '../config/connect.php';
$conn = (new database)->connection();

$id = $_GET['id'];

$query = "
SELECT 
    a.id,
    u.user_name,
    srv.name AS service,
    srv.price,
    a.payment_method,
    a.paid_at
FROM appointments a
JOIN users u ON a.user_id = u.id
JOIN services srv ON a.service_id = srv.id
WHERE a.id = $id
";

$invoice = $conn->query($query)->fetch(PDO::FETCH_ASSOC);
?>
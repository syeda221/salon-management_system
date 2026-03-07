<?php
require '../config/connect.php';
$conn = (new Database)->connect();

/* ==============================
   TOTAL REVENUE
==============================*/
$totalRevenue = $conn->query("
SELECT IFNULL(SUM(paid_amount),0) 
FROM appointments 
WHERE payment_status='paid'
")->fetchColumn();

/* ==============================
   TOTAL APPOINTMENTS
==============================*/
$totalAppointments = $conn->query("
SELECT COUNT(*) FROM appointments
")->fetchColumn();

/* ==============================
   APPOINTMENT STATUS
==============================*/
$statusData = $conn->query("
SELECT status, COUNT(*) total
FROM appointments
GROUP BY status
")->fetchAll(PDO::FETCH_KEY_PAIR);

/* ==============================
   DAILY REVENUE
==============================*/
$dailyRevenue = $conn->query("
SELECT DATE(paid_at) day, SUM(paid_amount) total
FROM appointments
WHERE payment_status='paid'
GROUP BY day
ORDER BY day
")->fetchAll(PDO::FETCH_ASSOC);

/* ==============================
   POPULAR SERVICES
==============================*/
$popularServices = $conn->query("
SELECT s.service_name, COUNT(*) total
FROM appointment_service aps
JOIN services s ON s.id = aps.service_id
GROUP BY aps.service_id
ORDER BY total DESC
LIMIT 5
")->fetchAll(PDO::FETCH_ASSOC);

/* ==============================
   STAFF PERFORMANCE
==============================*/
$staffPerformance = $conn->query("
SELECT st.name, COUNT(a.id) total, 
IFNULL(SUM(a.paid_amount),0) revenue
FROM staff st
LEFT JOIN appointments a 
ON a.staff_id = st.id 
AND a.status='completed'
GROUP BY st.id
")->fetchAll(PDO::FETCH_ASSOC);

/* ==============================
   PEAK HOURS
==============================*/
$peakHours = $conn->query("
SELECT slot_id, COUNT(*) total
FROM appointments
GROUP BY slot_id
ORDER BY total DESC
LIMIT 5
")->fetchAll(PDO::FETCH_ASSOC);

/* ==============================
   LOW STOCK
==============================*/
$lowStock = $conn->query("
SELECT * FROM inventory
WHERE quantity <= min_level
")->fetchAll(PDO::FETCH_ASSOC);
?>
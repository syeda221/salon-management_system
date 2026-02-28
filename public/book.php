<?php
include '../config/connect.php';
$conn = (new database)->connection();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Elegence Salon </title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="../asset/frontend/css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="../asset/frontend/css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="../asset/frontend/css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="../asset/frontend/images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="../asset/frontend/css/jquery.mCustomScrollbar.min.css">
      <style>
        /* ===== Background ===== */
body {
    background-color: #ffffff;
    color: #111;
    font-family: 'Segoe UI', sans-serif;
}

/* ===== Section spacing ===== */
.contact {
    padding: 60px 0;
}

/* ===== Title ===== */
.titlepage h2 {
    font-weight: 700;
    text-align: center;
    /* margin-bottom: 40px; */

    letter-spacing: 1px;
}
.titlepage{
    padding:0;
}

/* ===== Form card ===== */
.main_form {
    background: #fff;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

/* ===== Inputs ===== */
.main_form input,
.main_form select {
    border-radius: 8px;
    border: 1px solid #ddd;
    padding: 12px;
    width: 100%;
    transition: 0.3s;
}

.main_form input:focus,
.main_form select:focus {
    border-color: #000;
    box-shadow: none;
}

/* ===== Labels ===== */
.main_form label {
    font-weight: 600;
    margin-bottom: 6px;
}

/* ===== Services grid ===== */
.services-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 10px;
    margin-top: 15px;
}

.service-item {
    border: 1px solid #eee;
    padding: 10px 14px;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s;
}

.service-item:hover {
    background: #000;
    color: #fff;
}

/* ===== Divider ===== */
.divider {
    height: 1px;
    background: #eee;
    margin: 25px 0;
}

/* ===== Button ===== */
.main_form button {
    width: 100%;
    background: #000;
    color: #fff;
    border: none;
    padding: 14px;
    border-radius: 8px;
    font-weight: 600;
    margin-top: 20px;
    transition: 0.3s;
}

.main_form button:hover {
    background: #333;
}
      </style>
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>-->
</head>
<body>
    <div id="contact" class="contact  p-0" >
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage pt-5" >
                     <h2> <img src="../asset/frontend/images/head.h.png" alt="#"/> Request <span class="white"> A call Back</span></h2>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-10 m-auto">
                <form action="submit.php" class="main_form" method="POST">

<div class="row">
  <div class="col-md-6 mb-3">
    <label>Full Name</label>
    <input type="text" name="name" class="form-control" required>
  </div>

  <div class="col-md-6 mb-3">
    <label>Phone</label>
    <input type="tel" name="phone" class="form-control" required>
  </div>
</div>

<div class="mb-3">
  <label>Email Address</label>
  <input type="email" name="email" class="form-control" required>
</div>

<div class="row">
  <div class="col-md-6 mb-3">
    <label>Preferred Date</label>
    <input type="date" name="date" class="form-control" required>
  </div>

  <div class="col-md-6 mb-3">
    <label>Time Slot</label>
    <div class="select-wrapper">
          <select id="slot_id" name="slot_id">
            <?php foreach($conn->query("SELECT * FROM time_slots") as $t): ?>
              <option value="<?= $t['id'] ?>"><?= $t['slot_time'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>
  </div>
</div>

<div class="divider"></div>

<h5 class="fw-bold mb-3 text-center">Select Services</h5>

<div class="row g-3">

<?php foreach($conn->query("SELECT * FROM services") as $s): ?>
  
  <div class="col-md-4 col-sm-6">
    <div class="card h-100 border-0 shadow-sm">
      <div class="card-body d-flex align-items-center">

        <div class="form-check w-100">
          <input 
            class="form-check-input me-2" 
            type="checkbox" 
            name="services[]" 
            value="<?= $s['id'] ?>" 
            id="service<?= $s['id'] ?>"
          >

          <label class="form-check-label fw-semibold w-100" for="service<?= $s['id'] ?>">
            <?= htmlspecialchars($s['service_name']) ?>
          </label>
        </div>

      </div>
    </div>
  </div>

<?php endforeach; ?>

</div>

<div class="text-center mt-4">
  <button type="submit" class="btn btn-dark px-5 py-2 fw-semibold">
    Request Booking
  </button>
</div>
               </div>
</div>
</div>
</body>
</html>
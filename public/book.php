<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
       <link rel="stylesheet" href="../asset/frontend/css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="../asset/frontend/css/style.css">
</head>
<body>
    <?php
date_default_timezone_set("Asia/Karachi");
?>

<h2>Select Date</h2>
<div class="container">
<div class="row">
<?php
$today = date('Y-m-d');

for($i = 0; $i < 7; $i++){

$date = date('Y-m-d', strtotime("+$i days"));
$label = date('D d M', strtotime($date));

echo "<a href='available_slots.php?date=$date'><botton class='col-1'>$label<button></a><br>";
}
?>

</div>
</div>
</body>
</html>

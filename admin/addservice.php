<?php include '../config/connect.php'; 
include '../classes/services.php';
$conn = ( new database)->connection();
$table = new services($conn);


if(isset($_POST['add'])){
    $servicename = $_POST['name'];
    $serviceprice = $_POST['price'];
    $serviceimg = $_FILES['image']['name'];
    $imgtmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($imgtmp,"../asset/images/service/".$serviceimg);

    echo $servicename,$serviceimg,$serviceprice+1;
    if($table->addservices($servicename,$serviceimg,$serviceprice)){
        echo "<script>alert('added')</script>";
    }
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="../asset/css/style.css"> -->
</head>
<body>
    <div class="container" >
        <div class="row">
        <h1 class="m-auto mb-5 mt-5 col-5">Add New Service</h1>
        </div>
<div class="row">
    <form class="m-auto col-6" method="post" enctype="multipart/form-data">
  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="inputEmail4">Service Name</label>
      <input type="text"  class="form-control" id="inputEmail4" name="name" placeholder="service name">
    </div>
    <div class="form-group col-md-12">
      <label for="inputPassword4">Price</label>
      <input type="number" class="form-control" name="price" id="inputPassword4" >
    </div>
  </div>
  <div class="form-row">
     <div class="form-group col-md-12">
      <label for="inputPassword4">Related Image</label>
      <input type="file" class="form-control" name="image" id="inputPassword4" >
    </div>
  </div>
  <button type="submit" name="add" class="btn mt-4 btn-primary"> Add</button>
</form>
</div>
</div>
</body>
</html>

<?php include '../config/connect.php'; 
include '../classes/users.php';
$conn = ( new database)->connection();
$table = new users($conn);

$fetchrole = $table->allrole();
if(isset($_POST['add'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $role_id = $_POST['roleid'];
    $img = $_FILES['image']['name'];
    $imgtmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($imgtmp,"../asset/images/users/".$img);

    // echo $servicename,$serviceimg,$serviceprice+1;
    if($table->addusers($role_id,$img,$name,$email,$pass)){
        echo "<script>alert('added')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add user</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
        <div class="container" >
        <div class="row">
        <h1 class="m-auto mb-5 mt-5 col-5">Add New User</h1>
        </div>
<div class="row">
    <form class="m-auto col-6" method="post" enctype="multipart/form-data">
  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="inputEmail4">Name</label>
      <input type="text"  class="form-control" id="inputEmail4" name="name" placeholder="service name">
    </div>
    <div class="form-group col-md-12">
      <label for="inputPassword4">Email</label>
      <input type="email" class="form-control" name="email" id="inputPassword4" >
    </div>
  </div>
   <div class="form-row">
    <div class="form-group col-md-12">
      <label for="inputEmail4">password</label>
      <input type="password"  class="form-control" id="inputEmail4" name="password" placeholder="service name">
    </div>
    <div class="form-group col-md-12">
      <label for="inputPassword4">Role</label>
      <select name="roleid" id="">

      <?php
      foreach($fetchrole as $r){
      ?>
        <option value="<?= $r['id']  ?>"><?= $r['role_name'] ?></option>
        <?php  } ?>
      </select>
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
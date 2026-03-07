<?php
session_start();
include '../classes/auth.php';
include '../config/connect.php';

$database = (new database)->connection();
$table = new auth($database);

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = $table->login($email,$password);

    if($user){

        // IMPORTANT — store user id
        $_SESSION['user_id'] = $user['id'];

        $_SESSION['username'] = $user['user_name'];
        $_SESSION['email'] = $user['user_email'];
        $_SESSION['role'] = $user['role_id'];

        // redirect based on role
        if($user['role_id'] == 1){
            header("Location: ../admin/index.php");
            exit;
        }
        elseif($user['role_id'] == 2){
            header("Location: ../receptionist/index.php");
            exit;
        }
        elseif($user['role_id'] == 3){
            header("Location: ../staff/index.php");
            exit;
        }

    }else{
        echo "<script>alert('Email or password is incorrect')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login User</title>
    <link rel="stylesheet" href="../asset/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="../asset/images/logo.png"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-4   col-lg-6 col-xl-4 offset-xl-1">
        <form method="post" >
          
            <h1 class="lead fw-bold mb-0 mb-4 left-center">login in </h1>

          <!-- Email input -->
          <div data-mdb-input-init class="form-outline mb-4">
            <input type="email" name="email" id="form3Example3" class="form-control form-control-lg"
              placeholder="Enter a valid email address" />
            <label class="form-label" for="form3Example3">Email address</label>
          </div>

          <!-- Password input -->
          <div data-mdb-input-init class="form-outline mb-3">
            <input type="password" name="password" id="form3Example4" class="form-control form-control-lg"
              placeholder="Enter password" />
            <label class="form-label" for="form3Example4">Password</label>
          </div>

        

          <div class="text-center text-lg-start mt-4 pt-2">
            <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;background-color:#AA1529 ;color:white;" name="login">Login</button>
          
          </div>
</div>
        </form>
   
  </div>
</section>

  <div style="background-color:#AA1529 "
    class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 ">
    <!-- Copyright -->
    <div class="text-white mb-3 mb-md-0">
       © Elegent Salon 202. All rights reserved.
    </div>
    <!-- Copyright -->

    <!-- Right -->
    <div>
      <a href="#!" class="text-white me-4">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="#!" class="text-white me-4">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="#!" class="text-white me-4">
        <i class="fab fa-google"></i>
      </a>
      <a href="#!" class="text-white">
        <i class="fab fa-linkedin-in"></i>
      </a>
    </div>
    <!-- Right -->
  </div>
</body>
</html>




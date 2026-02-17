<?php
include '../config/connect.php';
include '../classes/auth.php';
$database = (new database)->connection();
$table = new auth($database);
function sanitize($data){
$data = stripslashes($data);
$data = trim($data);
$data = htmlspecialchars($data ,ENT_QUOTES);
return $data;
}
if(isset($_POST['signup'])){
    $name = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];
    if($pass==$cpass){
        $table->register(2,$name,$email,$password);
    }
    else{
        echo "<script>password and confirm password are not same!!</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="../asset/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>
<body>
    <!-- Section: Design Block -->
<section class="">
  <!-- Jumbotron -->
  <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
    <div class="container">
      <div class="row gx-lg-5 align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <h1 class="my-5 display-3 fw-bold ls-tight">
            The best offer <br />
            <span class="text-primary">for your business</span>
          </h1>
          <p style="color: hsl(217, 10%, 50.8%)">
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Eveniet, itaque accusantium odio, soluta, corrupti aliquam
            quibusdam tempora at cupiditate quis eum maiores libero
            veritatis? Dicta facilis sint aliquid ipsum atque?
          </p>
        </div>

        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="card">
            <div class="card-body py-5 px-md-5">
              <form method="post">
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="row">
                  <div class="col-md-12 mb-4">
                    <div data-mdb-input-init class="form-outline">
                      <input type="text" id="form3Example1" class="form-control" required />
                      <label class="form-label" name="name" for="form3Example1"> Name</label>
                    </div>
                  </div>
                  
                </div>

                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                  <input type="email" id="form3Example3" class="form-control" required />
                  <label class="form-label" name="email" for="form3Example3">Email address</label>
                </div>

                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                  <input type="password" id="form3Example4" class="form-control" required />
                  <label class="form-label" name="password" for="form3Example4">Password</label>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                  <input type="password" id="form3Example4" class="form-control" required />
                  <label class="form-label" name="cpassword" for="form3Example4">Confirm Password</label>
                </div>

                <!-- Checkbox -->
                <div class="form-check d-flex justify-content-center mb-4">
                             <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="login.php">login</a>

                </div>

                <!-- Submit button -->
                <button type="submit" name="signup" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">
                  Sign up
                </button>

                <!-- Register buttons -->
                
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Jumbotron -->
</section>
<!-- Section: Design Block --> 
</body>
</html>
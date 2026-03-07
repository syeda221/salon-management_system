<?php
session_start();
include '../config/connect.php';
include '../classes/profile.php';
$conn = (new Database)->connection();
$table = new profile($conn);
$id = $_SESSION['user_id'];
$user= $table->profAll($id);
?>
<!-- <h3>Profile</h3>
<img src="../asset/images/users/<?=$user['user_img']?>" style="width:100px; height:100px;" alt="">
<p>Name : <?=$user['user_name']?></p>
<p>Email : <?=$user['user_email']?></p> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        #prof{
            width:130px;
             height:130px;
        }
      </style>
     <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
     <div id="contact" class="contact  p-3" >
         <div class="container pb-5">
            <div class="row p-0 h-0 m-0">
               <div class="col-md-12 ">
                  <div class="titlepage pt-5" >
                     <h2> <img src="../asset/frontend/images/head.h.png" alt="#"/> <span class="white"> Profile </span></h2>
                  </div>
               </div>
            </div>
    <div class="container ">
    <div class="row justify-content-center ">
        <div class="col-md-6">

            <div class="card shadow-sm border-0 ">
                <div class="card-body text-center">

                    <!-- Profile Image -->
                    <img id="prof" src="../asset/images/users/<?=$user['user_img']?>" 
                         class="rounded-circle border border-5 border-primary mb-3"
                          
                         style="object-fit:cover;" 
                         alt="User Image">

                    <!-- User Name -->
                    <h4 class="fw-bold"><?=$user['user_name']?></h4>
                    <hr>

                    <!-- User Details -->
                    <div class="text-start">
                        <p><strong>Email:</strong> <?=$user['user_email']?></p>
                        <p><strong>Phone:</strong> <?=$user['user_phone']?></p>
                    </div>

                    <!-- Buttons -->
                    <div class="mt-3">
                     
                        <a href="../auth/logout.php" class="btn btn-danger">
                            Logout
                        </a>
                    </div>
</div>
                </div>
            </div>

        </div>
    </div>
</div>   </div>

        </div>
    </div>
</div>
</body>
</html>

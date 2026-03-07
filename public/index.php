<?php
require '../config/connect.php';
$conn = (new Database)->connection();

$data = $conn->query("
SELECT f.*, c.name
FROM feedback f
JOIN clients c ON f.client_id = c.id
ORDER BY f.id DESC
")->fetchAll(PDO::FETCH_ASSOC);
?>





<!DOCTYPE html>
<html lang="en">
   <head>
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
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
   </head>
   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="../asset/frontend/images/loading.gif" alt="#" /></div>
      </div>
      <!-- end loader -->
      <!-- header -->
      <header>
         <!-- header inner -->
         <div class="header">
            <div class="container">
               <div class="row">
                  <div class="col-xl-5 col-lg-5 col-md-9 col-sm-9">
                     <nav class="navigation navbar navbar-expand-md navbar-dark ">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarsExample04">
                           <ul class="navbar-nav mr-auto">
                              <li class="nav-item active">
                                 <a class="nav-link" href="index.html"> Home  </a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="#about">About</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="#service">Service</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="#customer">Customer</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="#contact">Contact Us</a>
                              </li>
                           </ul>
                        </div>
                     </nav>
                  </div>
                  <div class="col-xl-2 m-auto col-lg-2 col-md-3 col-sm-3 col logo_section">
                     <div class="full">
                        <div class="center-desk">
                           <div class="logo">
                              <a href="index.html"><img src="../asset/frontend/images/elogo.png" alt="#" /></a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class=" book col-xl-5 col-lg-5 col-md-5 col-sm-5">
                   
                     <a href="../auth/login.php" class="auto-ml">
                        <button class="btn">Login</button>
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- end header inner -->
      <!-- end header -->
      <!-- banner -->
      <section class="banner_main">
         <div id="banner1" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
               <li data-target="#banner1" data-slide-to="0" class="active"></li>
               <li data-target="#banner1" data-slide-to="1"></li>
               <li data-target="#banner1" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
               <div class="carousel-item active">
                  <div class="container-fluid">
                     <div class="carousel-caption">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="text-bg">
                                 <span>Welcome to</span>
                                 <h1>Elegant Salon</h1>
                                  <a href="../common/book.php">Book Now</a>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="text_img">
                                 <figure><img src="../asset/frontend/images/girl.png" alt="#"/></figure>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <div class="container-fluid">
                     <div class="carousel-caption">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="text-bg">
                                 <span>Welcome to</span>
                                 <h1>Elegant Salon</h1>
                                  <a href="../common/book.php">Book Now</a>
                               </div>
                           </div>
                           <div class="col-md-6">
                              <div class="text_img">
                                 <figure><img src="../asset/frontend/images/girl.png" alt="#"/></figure>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <div class="container-fluid">
                     <div class="carousel-caption">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="text-bg">
                                 <span>Welcome to</span>
                                 <h1>Elegant Salon</h1>
                                 <a href="../common/book.php">Book Now</a>
                               </div>
                           </div>
                           <div class="col-md-6">
                              <div class="text_img">
                                 <figure><img src="../asset/frontend/images/girl.png" alt="#"/></figure>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <a class="carousel-control-prev" href="#banner1" role="button" data-slide="prev">
            <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
            </a>
            <a class="carousel-control-next" href="#banner1" role="button" data-slide="next">
            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
            </a>
         </div>
      </section>
      <!-- end banner -->
      <!-- service -->
      <div id="service"  class="service">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
             <div class="titlepage">
   <h2> <img src="../asset/frontend/images/head.png" alt="#"/> Our Services</h2>
</div>
</div>
</div>
<div class="row">
   <div class="col-md-4">
      <div id="hover_chang" class="service_box">
         <i><img src="../asset/frontend/images/thr.png" alt="#"/></i>
         <h3>Mani-Pedi</h3>
         <p>Pamper your hands and feet with our relaxing manicure and pedicure treatments for clean, healthy, and beautiful nails.</p>
      </div>
   </div>

   <div class="col-md-4">
      <div id="hover_chang" class="service_box">
         <i><img src="../asset/frontend/images/thr1.png" alt="#"/></i>
         <h3>Facial</h3>
         <p>Refresh and rejuvenate your skin with our customized facial treatments designed to cleanse, hydrate, and glow.</p>
      </div>
   </div>

   <div class="col-md-4">
      <div id="hover_chang" class="service_box">
         <i><img src="../asset/frontend/images/thr2.png" alt="#"/></i>
         <h3>Hair Styling</h3>
         <p>Get the perfect look with professional hair styling, from trendy cuts to elegant styles for every occasion.</p>
      </div>
   </div>
</div>
</div>
      </div>
      <!-- service -->
      <!-- about -->
      <div id="about"  class="about">
         <div class="container">
            <div class="row">
               <div class="col-md-9">
                  <div class="titlepage">
                     <h2> <img src="../asset/frontend/images/head.h.png" alt="#"/> About Our Elegent  </h2>
                    <p>Where beauty meets perfection. At Salon Elegant, we offer premium beauty and grooming services in a relaxing and luxurious environment. Our expert professionals are dedicated to enhancing your natural beauty and giving you a refreshing, confident look every time you visit.</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end about -->
      <!-- customer -->
      <div id="customer" class="customer">
   <div class="container">

      <div class="row">
         <div class="col-md-12">
            <div class="titlepage">
               <h2>
                  <img src="../asset/frontend/images/head.png" alt="#"/> 
                  Our Customer Feedback
               </h2>
            </div>
         </div>
      </div>

      <div id="myCarousel" class="carousel slide customer_Carousel" data-ride="carousel">

         <div class="carousel-inner">

         <?php if(!empty($data)): ?>

            <?php 
            $first = true; 
            foreach($data as $f): 
            ?>

               <div class="carousel-item <?= $first ? 'active' : '' ?>">
                  <div class="container">
                  <div class="carousel-caption">
                     <div class="test_box">
                        <h4><?= htmlspecialchars($f['name']) ?></h4>
                        <span><?= htmlspecialchars($f['rating']) ?>/5</span>
                        <p><?= htmlspecialchars($f['message']) ?></p>
                        <img src="../asset/frontend/images/icon.png" alt="#"/>
                     </div>
                     </div>
                  </div>
               </div>

            <?php 
            $first = false; 
            endforeach; 
            ?>

         <?php else: ?>

            <div class="carousel-item active">
               <div class="carousel-caption">
                  <div class="test_box">
                     <h4>No Feedback Yet</h4>
                     <p>Be the first to give feedback 😊</p>
                  </div>
               </div>
            </div>

         <?php endif; ?>

         </div>

         <!-- Controls -->
         <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <i class="fa fa-chevron-left" aria-hidden="true"></i>
         </a>

         <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <i class="fa fa-chevron-right" aria-hidden="true"></i>
         </a>

      </div>

   </div>
</div>
                 
      <!-- end customer -->
      </div>
      <!--  contact -->
      <div id="contact" class="contact">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2> <img src="../asset/frontend/images/head.h.png" alt="#"/> Contact <span class="white">Us</span></h2>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
          
    <div style="max-width:800px;  color:white; margin:auto; text-align:;">
        
        <p style="color:fff; font-size:1.7rem; margin-bottom:70px; margin-top:50px;">
            We'd love to hear from you. Feel free to reach out through any of the following ways.
        </p>

        <!-- Contact Info -->
        <div style="margin-bottom:40px; font-size:large; ">
            <p style="font-size:1.1rem;"><strong>Email:</strong> salonelegent.com</p> <br>
            <p style="font-size:1.1rem;"><strong>Phone:</strong> +92 300 1234567</p>
            <p style="font-size:1.1rem;"><strong>Address:</strong> elegent Salon Street, Hyderabad City, Pakistan</p>
        </div>

        <!-- Social Media -->
        <div style="color:white;">
            <a href="#" style="margin:0 10px; text-decoration:none; font-size:20px;">
                <i style="color:white;font-size:1.5rem;" class="fab fa-facebook"></i>
            </a>

            <a href="#" style="margin:0 10px; text-decoration:none; font-size:20px;">
                <i style="color:white;font-size:1.5rem;" class="fab fa-instagram"></i>
            </a>

            <a href="#" style="margin:0 10px; text-decoration:none; font-size:20px;">
                <i style="color:white;font-size:1.5rem;" class="fab fa-whatsapp"></i>
            </a>

            <a href="#" style="margin:0 10px; text-decoration:none; font-size:20px;">
                <i style="color:white;font-size:1.5rem;" class="fab fa-twitter"></i>
            </a>
        </div>

    </div>

               </div>
               <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="map-responsive">
                      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3604.9173234831765!2d68.35111497385658!3d25.374087224516195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x394c70627aa05ad7%3A0x620c3f1e4c9721ba!2sAptech%20Learning%20Latifabad%20Center!5e0!3m2!1sen!2s!4v1772763806064!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                     </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end contact -->
      <!--  footer -->
      <footer id="contact">
         <div class="footer">
            <div class="container">
               <div class="row">
                  
               </div>
               <div class="row">
                  <div class="col-xl-6 col-md-12">
                     <div class="row">
                        <div class="col-md-7 padd_bottom">
                           <div class="heading3">
                              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros.Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros.</p>
                           </div>
                        </div>
                        <div class="col-md-5 padd_bottom padd_bott">
                           <div class="heading3">
                              <h3>Contact Us</h3>
                              <ul class="infometion">
                                 <li><a href="#">Donec odio. Quisque </a></li>
                                 <li><a href="#">volutpat mattis</a></li>
                                 <li><a href="#">eros.Lorem ipsum dolor</a></li>
                                 <li><a href="#">sit amet, consectetuer  </a></li>
                                 <li><a href="#">adipiscing elit. Donec  </a></li>
                                 <li><a href="#">odio. Quisque volutpat </a></li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-6 col-md-12">
                     <div class="row">
                        <div class="col-md-6 offset-md-1 padd_bottom">
                           <div class="heading3">
                              <h3>INFORMATION</h3>
                              <ul class="infometion">
                                 <li><a href="#">Donec odio. Quisque </a></li>
                                 <li><a href="#">volutpat mattis</a></li>
                                 <li><a href="#">eros.Lorem ipsum dolor</a></li>
                                 <li><a href="#">sit amet, consectetuer  </a></li>
                                 <li><a href="#">adipiscing elit. Donec  </a></li>
                                 <li><a href="#">odio. Quisque volutpat </a></li>
                              </ul>
                           </div>
                        </div>
                        <div class="col-md-5">
                           <div class="heading3">
                              <h3>MY ACCOUNT</h3>
                              <ul class="infometion">
                                 <li><a href="#">Donec odio. Quisque </a></li>
                                 <li><a href="#">volutpat mattis</a></li>
                                 <li><a href="#">eros.Lorem ipsum dolor</a></li>
                                 <li><a href="#">sit amet, consectetuer  </a></li>
                                 <li><a href="#">adipiscing elit. Donec  </a></li>
                                 <li><a href="#">odio. Quisque volutpat </a></li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="copyright ">
               <div class="container">
                  <div class="row bg-primary">
                     <div class="col-md-12">
                        <p>&copy; All Rights Reserved.Elegent Salon </a></p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <!-- end footer -->
      <!-- Javascript files-->
      <script src="../asset/frontend/js/jquery.min.js"></script>
      <script src="../asset/frontend/js/popper.min.js"></script>
      <script src="../asset/frontend/js/bootstrap.bundle.min.js"></script>
      <script src="../asset/frontend/js/jquery-3.0.0.min.js"></script>
      <!-- sidebar -->
      <script src="../asset/frontend/js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="../asset/frontend/js/custom.js"></script>
      <script>
         $('a[href^="#"]').on('click', function(event) {
         
          var target = $(this.getAttribute('href'));
         
          if( target.length ) {
              event.preventDefault();
              $('html, body').stop().animate({
                  scrollTop: target.offset().top
              }, 2000);
          }
         
         });
      </script>
      <script>
         // This example adds a marker to indicate the position of Bondi Beach in Sydney,
         // Australia.
         function initMap() {
           var map = new google.maps.Map(document.getElementById('map'), {
             zoom: 11,
             center: {lat: 40.645037, lng: -73.880224},
             });
         
         var image = 'images/maps-and-flags.png';
         var beachMarker = new google.maps.Marker({
             position: {lat: 40.645037, lng: -73.880224},
             map: map,
             icon: image
           });
         }
      </script>
      <!-- google map js -->
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8eaHt9Dh5H57Zh0xVTqxVdBFCvFMqFjQ&callback=initMap"></script>
      <!-- end google map js --> 
   </body>
</html>


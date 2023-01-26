<?php
/**
 * @author Miguel Ángel Medina Ramírez
 * @version 1.0
 * @package General
 * @Date: 2023-01-26
 * @email: migueliberto86@gmail.com
 * @Github:https://github.com/MiguelMR86
 */
session_start();
/** 
 * If exist POST request of the log out, and destroy the session
 */
if (isset($_POST['logoutSubmit'])){
    session_destroy();
    header('Location: ./index.php');
}
/** 
 * If exist a SESSION user, includes the database config (Environment Variables)
 * and admin check validates that you are an administrator
 */
if (isset($_SESSION["user"])){
    $config = include './database/config.php';
    include './controllers/adminCheck.php';
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Landing Page - Start Bootstrap Theme</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="./img/favicon.ico" />
        <!-- Custom fonts for this template-->
        <link href="./vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="./css/index.css" rel="stylesheet" />
        <link href="./css/sb-admin-2.min.css" rel="stylesheet" />

    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand <?= $admin ? 'navbar-primary bg-primary' :  'navbar-secondary bg-secondary'; ?> topbar  static-top shadow">
            <div class="container w-25"></div>
            <div class="container d-flex justify-content-center w-50">
                <a class="navbar-brand text-light" href="index.php">Restaurant</a>
            </div>
            <div class="container w-25 d-flex justify-content-end">
                <div>
                <?php if (!isset($_SESSION["user"])){ ?>
                    <a class="btn btn-success shadow mr-2" href="./views/login.php">Sign In</a>
                    <a class="btn btn-primary shadow" href="./views/register.php">Sign Up</a>
                <?php }else{ ?>
                    <a class="btn btn-success shadow mr-2" href="./views/user.php">Let's start!</a>
                <?php } ?>
                </div>
            
            
            <?php if (isset($_SESSION["user"])){ ?>
                <!-- Topbar Navbar -->
                <ul class="navbar-nav">

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="img-profile rounded-circle"
                                src="./img/undraw_profile.svg">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Settings
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                Activity Log
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>
            <?php } ?>
            </div>
        </nav>

        <!-- Image Showcases-->
        <section class="showcase">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('./img/restaurant.png')"></div>
                    <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                        <h2>Relax and take a seat</h2>
                        <p class="lead mb-0">Relax with the best views of Canary Islands!</p>
                    </div>
                </div>
                <div class="row g-0">
                    <div class="col-lg-6 text-white showcase-img" style="background-image: url('./img/restaurant-view.png')"></div>
                    <div class="col-lg-6 my-auto showcase-text">
                        <h2>The best restaurant to eat and relax</h2>
                        <p class="lead mb-0">Are you looking for a place where you can share your time with your familly and friends? Don't look further our restaurnt is your solution!</p>
                    </div>
                </div>
                <div class="row g-0">
                    <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('./img/restaurant-view-2.png')"></div>
                    <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                        <h2>Easy to Use & Customize</h2>
                        <p class="lead mb-0">You can customize your settings and preferences to have a better experience on our website. To make a reservation just sing up on the website and you will have full acces to our content!</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Testimonials-->
        <section class="testimonials text-center bg-light">
            <div class="container">
                <h2 class="mb-5">What people are saying...</h2>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                            <img class="img-fluid rounded-circle mb-3" src="./img/testimonials-1.jpg" alt="..." />
                            <h5>Margaret E.</h5>
                            <p class="font-weight-light mb-0">"Awesome! The best restaurant I've ever been, what what an experience!"</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                            <img class="img-fluid rounded-circle mb-3" src="./img/testimonials-2.jpg" alt="..." />
                            <h5>Fred S.</h5>
                            <p class="font-weight-light mb-0">"The restaurant is amazing. I have been coming for years and the service is still great."</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                            <img class="img-fluid rounded-circle mb-3" src="./img/testimonials-3.jpg" alt="..." />
                            <h5>Sarah W.</h5>
                            <p class="font-weight-light mb-0">"I just left and I already want to go back. I had never seen such a beautifull views"</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
        <?php include "./views/parts/footer.php" ?>
    </body>
</html>

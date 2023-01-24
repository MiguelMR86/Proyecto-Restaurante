<?php
session_start();

if (isset($_POST['logoutSubmit'])){
    session_destroy();
    header('Location: ../views/user.php');
}

if (!isset($_SESSION["user"])){
    header('Location: ../views/login.php');
}

// Reservation Check
if (isset($_POST['reservationSubmit'])){
    include '../controllers/makeReservation.php';
}

include '../controllers/adminCheck.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Restaurant - User</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-secondary <?= $admin ? 'bg-primary' :  'bg-secondary'; ?> topbar mb-4 static-top shadow">
                    <a class="navbar-brand text-light" href="../index.php">Restaurant</a>
                    <div class="topbar-divider d-none d-sm-block"></div>

                    <?php if($admin){ ?>
                    <div class="w-50 d-flex justify-content-end">
                        <i class="fas fa-fw fa-tachometer-alt navbar-brand text-light"></i>
                        <a class="navbar-brand text-light">Admin Dashboard</a>   
                    </div>
                    <?php } ?>

                    <!-- User Make Reservation -->
                    <?php if(!$admin){ ?>
                        <button class="btn btn-success btn-icon-split" 
                            data-toggle="modal" data-target="#reservationModal">
                            
                            <span class="text">Make a reservation</span>
                        </button>
                    <?php } ?>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle"
                                    src="../img/undraw_profile.svg">
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

                </nav>
                
                <!-- Show Result -->
                <?php
                    if (isset($resultado)){
                    ?>
                    <div class="container mt-3">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-<?= $resultado['error'] ? 'danger' : "success" ?>" role="alert">
                                    <?= $resultado['mensaje'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                ?>

                <!-- User Show Booking -->
                <?php if (!$admin){ ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row d-flex justify-content-center">
                            <!-- Show Booking  -->
                            <?php
                            include '../controllers/showUsers.php';
                            ?>
                    </div>
                </div>
                <?php } ?>

                <!-- Admin Show Tables -->
                <?php if ($admin){ ?>
                <!-- Begin Page Content -->
                <div class="container-fluid d-flex justify-content-center w-100 flex-wrap">
                    <div class="row w-50 d-flex justify-content-center align-items-start">
                            <!-- Show Booking  -->
                            <?php
                            include '../controllers/showNoAdmin.php';
                            ?>
                    </div>
                    <div class="row w-50 d-flex justify-content-center align-items-start">
                            <!-- Show Booking  -->
                            <?php
                            include '../controllers/showAdmin.php';
                            ?>
                    </div>
                </div>
                <?php } ?>
            </div>

            <?php if(!$admin)?>

            <!-- Reservation Modal-->
            <div class="modal fade" id="reservationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <form action="user.php" method="post">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">When are you coming?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">x</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <label for="reserveClients">Reserve Date: </label>
                                <input id="reserveDate" name="reserveDate" type="date" class="ml-1">
                            </div>
                            <div class="modal-body">
                                <label for="reserveClients">Number of companions: </label>
                                <input id="reserveClients" name="reserveClients" type="number" min="1" max="10" class="ml-1">
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <button id="reservationSubmit" name="reservationSubmit"class="btn btn-success" type="submit">
                                    <span class="icon text-white-50 mr-2">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    Reserve
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <?php?>
            <!-- End of Main Content -->

<?php include("./parts/footer.php") ?>
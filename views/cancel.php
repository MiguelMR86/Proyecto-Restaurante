<?php
session_start();

if (isset($_POST['logoutSubmit'])) {
    session_destroy();
    header('Location: ../views/user.php');
}

if (!isset($_SESSION["user"])) {
    header('Location: ../views/login.php');
}

/**
 * If GET request with an id exists, saves an id
 */
if (isset($_GET["id"])){
    $id = $_GET["id"];
}

/**
 * If POST request submit exists, includes the delete reservation controller
 */
if(isset($_POST['deleteSubmit'])){
    include '../controllers/deleteReserve.php';
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

    <title>Reserve - Cancel</title>

    <!-- Custom fonts for this template-->
    <link href="../public/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
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
                <nav class="navbar navbar-expand navbar-secondary bg-secondary topbar mb-4 static-top shadow">
                    <a class="navbar-brand text-light" href="../index.php">Restaurant</a>
                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
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

                <!-- Update Reserve -->
                <div class="w-100 h-75 d-flex justify-content-center">
                    <!-- Nested Row within Card Body -->
                    <div class="row d-flex justify-content-center align-items-center shadow w-50 mt-5">
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Are you sure you want to cancel the reservation?</h1>
                                </div>
                                <form action="cancel.php" method="post" class="user">
                                    <div class="form-group d-flex">
                                        <input name="id" id="id" type="hidden" value="<?= $id ?>">
                                        <button type="submit" id="deleteSubmit" name="deleteSubmit" class="btn btn-danger btn-user btn-block m-1">
                                            Delete
                                        </button>
                                        <a href="./user.php" id="cancelSubmit" name="cancelSubmit" class="btn btn-secondary btn-user btn-block m-1">
                                            Go back
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End of Main Content -->

<?php include("./parts/footer.php") ?>
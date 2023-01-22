<?php
session_start();

if (isset($_POST['logoutSubmit'])) {
    session_destroy();
    header('Location: ../views/user.php');
}

if (!isset($_SESSION["user"])) {
    header('Location: ../views/login.php');
}

if (isset($_GET["id"])){
    $id = $_GET["id"];
    $reservDate = $_GET["reservDate"];
    $nclients = $_GET["nclients"];
}

if(isset($_POST['updateSubmit'])){
    $id = $_POST['id'];
    $reservDate = $_POST['updateDate'];
    $nclients = $_POST['updateClients'];
    include '../controllers/updateReserve.php';
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

    <title>SB Admin 2 - Dashboard</title>

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
                                    <h1 class="h4 text-gray-900 mb-4">What changes do you wana make?</h1>
                                </div>
                                <form action="./update.php" method="post" class="user">
                                    <div class="form-group">
                                        <input name="id" id="id" type="hidden" value="<?= $id ?>">
                                        <input type="date" class="form-control form-control-user"
                                            id="updateDate" name="updateDate" aria-describedby="date"
                                            value="<?= date("Y-m-d", strtotime($reservDate)) ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" min="1" max="10" class="form-control form-control-user"
                                            id="updateClients" name="updateClients" placeholder="Companions"
                                            value="<?= intval($nclients) ?>">
                                    </div>
                                    <div class="form-group d-flex">
                                        <button type="submit" id="updateSubmit" name="updateSubmit" class="btn btn-primary btn-user btn-block m-1">
                                            Update
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

            <!-- Footer -->
            <footer class="text-center p-4 bg-secondary text-light" style="background-color: rgba(0, 0, 0, 0.05);">
                © 2021 Copyright:
                <a class="text-reset fw-bold" href="https://mdbootstrap.com/">MDBootstrap.com</a>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form action="user.php" method="post">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button id="logoutSubmit" name="logoutSubmit"class="btn btn-primary" type="submit">Logout</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

</body>

</html>

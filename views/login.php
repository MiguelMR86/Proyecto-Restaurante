<?php
session_start();

if (isset($_SESSION["user"])){
    header("Location: ./user.php");
}

if (isset($_POST['submitLogin'])){
    $resultado = [
        'error' => false,
        'mensaje' => 'El usuario se ha sido logeado con exito'
    ];
    $config = include '../database/config.php';

    try {
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

        // Login parameters
        $dni = $_POST['loginInputDni'];
        $login_pass = $_POST['loginInputPassword'];
        
        // DB query
        $sentencia = $conexion->prepare("SELECT dni, password FROM User WHERE dni = ?");
        $sentencia->bindParam(1, $dni, PDO::PARAM_STR, 9);
        $sentencia->execute();

        // Query result
        $user = $sentencia->fetchAll();
        $userPass = $user[0]['password'];

        if (password_verify($login_pass, $userPass)){
            $_SESSION["user"] = $dni;
            header("Location: ./user.php");
        }

        else{
            $resultado['error'] = true;
            $resultado['mensaje'] = 'Wrong password';
        }
        

    } catch(PDOException $error){
        $resultado['error'] = true;
        $resultado['mensaje'] = $error->getMessage();
    }
}

include "./parts/header.php"; ?>
    <title>Restaurant- Login</title>
</head>

<body class="bg-gradient-primary">
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
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form action="login.php" method="post" class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="loginInputDni" name="loginInputDni" aria-describedby="emailHelp"
                                                placeholder="DNI">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="loginInputPassword" name="loginInputPassword" placeholder="Password">
                                        </div>
                                        <button type="submitLogin" name="submitLogin" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
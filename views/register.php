<?php
if (isset($_POST['submit'])){
    $resultado = [
        'error' => false,
        'mensaje' => 'El usuario ' . $_POST['nombre'] . ' ha sido agregado con exito'
    ];
    $config = include '../database/config.php';


    try {
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

        $cliente = array(
            "dni" => $_POST['nombre'],
            "name" => $_POST['nombre'],
            "lastname" => $_POST['apellido'],
            "telephone" => $_POST['apellido'],
            "email" => $_POST['apellido'],
            "password" => hash("SHA-256", $_POST['apellido'])
        );

        $consultaSQL = "INSERT INTO User (dni, name, lastname, telephone, email, password)";
        $consultaSQL .= " VALUES (:" .implode(",:", array_keys($cliente)) . ")";
        
        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute($cliente);
    }catch(PDOException $error){
        $resultado['error'] = true;
        $resultado['mensaje'] = $error->getMessage();
    }
}
 
include "./parts/header.php"; ?>
    <title>Restaurant - Register</title>
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user">
                            <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="registerInputEmail" name="registerInputEmail"
                                        placeholder="DNI">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="registerFirstName" name="registerFirstName"
                                            placeholder="First Name">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="registerLastName" name="registerLastName"
                                            placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <input type="tel" class="form-control form-control-user" id="registerInputTel" name="registerInputTel"
                                            placeholder="Phone number">
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="email" class="form-control form-control-user" id="registerInputEmail" name="registerInputEmail"
                                            placeholder="Email Address">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="registerInputPassword" name="registerInputPassword" placeholder="Password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="registerRepeatPassword" name="registerRepeatPassword" placeholder="Repeat Password">
                                    </div>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="login.html">Already have an account? Login!</a>
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
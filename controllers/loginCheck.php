<?php
$resultado = [
    'error' => false,
    'mensaje' => 'El usuario se ha sido logeado con exito'
];
$config = include '../database/config.php';

try {
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

    // Login parameters
    $email = $_POST['loginInputEmail'];
    $login_pass = $_POST['loginInputPassword'];
    
    // DB query
    $sentencia = $conexion->prepare("SELECT email, password FROM User WHERE email = ?");
    $sentencia->bindParam(1, $email);
    $sentencia->execute();

    // Query result
    $user = $sentencia->fetch();
    $userPass = $user['password'];

    if (password_verify($login_pass, $userPass)){
        $_SESSION["user"] = $email;
        header("Location: ../index.php");
    }

    else{
        $resultado['error'] = true;
        $resultado['mensaje'] = 'Wrong password';
    }
    

} catch(PDOException $error){
    $resultado['error'] = true;
    $resultado['mensaje'] = $error->getMessage();
}
?>
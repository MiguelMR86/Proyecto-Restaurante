<?php
    /** 
     * Controller that checks users llog
     * @package Login-Controller
     * @version 1.0
     */
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
    if ($user){
        $userPass = $user['password'];

        // Password verification 
        if (password_verify($login_pass, $userPass)){
            $_SESSION["user"] = $email;
            header("Location: ../index.php");
        }

        else{
            $resultado['error'] = true;
            $resultado['mensaje'] = 'Wrong password';
        }
    }else{
        $resultado['error'] = true;
        $resultado['mensaje'] = 'That user does not exist';
    }
    

} catch(PDOException $error){
    $resultado['error'] = true;
    $resultado['mensaje'] = $error->getMessage();
}
?>
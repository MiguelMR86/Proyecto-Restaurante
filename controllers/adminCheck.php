<?php
    // Admin check
    $adminResult = [
        'error' => false,
        'mensaje' => 'El usuario se ha logeado correctamente'
    ];
    $config = include '../database/config.php';

    try {
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
        
        // DB query
        $sentencia = $conexion->prepare("SELECT admin FROM User WHERE dni = ?");
        $sentencia->bindParam(1, $_SESSION["user"], PDO::PARAM_STR);
        $sentencia->execute();

        // Query result
        $user = $sentencia->fetch();
        $admin = $user['admin'];

    } catch(PDOException $error){
        $adminResult['error'] = true;
        $adminResult['mensaje'] = $error->getMessage();
    }
?>
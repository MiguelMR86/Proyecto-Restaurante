<?php
    /** 
     * Controller that check if user is admin
     * @package Admin-Controller
     * @version 1.0
     */

    // Admin check
    $adminResult = [
        'error' => false,
        'mensaje' => 'El usuario se ha logeado correctamente'
    ];
    
    // If database config does not exist, Includes a default config
    if (!isset($config)){
        $config = include '../database/config.php';
    }    
    
    try {
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
        
        // DB query to check if user is admin
        $sentencia = $conexion->prepare("SELECT admin FROM User WHERE email = ?");
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
<?php
    /** 
     * Controller that deletes a user reservation
     * @package User-Controller
     * @version 1.0
     */
    $resultado = [
        'error' => false,
        'mensaje' => 'La reserva se cancelo con exito'
    ];
    $config = include '../database/config.php';
    
    try {
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

        // DB query to delete a user reservation
        $sentencia = $conexion->prepare('DELETE FROM Booking WHERE bemail = ? AND id = ?');
        $sentencia->bindParam(1, $_SESSION['user'], PDO::PARAM_STR);
        $sentencia->bindParam(2, $_POST['id'], PDO::PARAM_STR);
        $sentencia->execute();

    } catch(PDOException $error){
        $resultado['error'] = true;
        $resultado['mensaje'] = $error->getMessage();
    }
    header('Location: ./user.php')
?>
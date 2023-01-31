<?php
    /** 
     * Controller that update a user data
     * @package User-Controller
     * @version 1.0
     */
    $resultado = [
        'error' => false,
        'mensaje' => 'La reserva se actualizo con exito'
    ];
    $config = include '../database/config.php';
    
    try {
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

        // DB query to get all user reservations
        $sentencia = $conexion->prepare('SELECT id, bemail, reserveDate, nclients FROM Booking WHERE bemail = ?');
        $sentencia->bindParam(1, $_SESSION['user'], PDO::PARAM_STR);
        $sentencia->execute();

        // Query result
        $reserveList = $sentencia->fetchAll();

        $valid1 = $valid2 = true;
        $today = date('Y-m-d');
        $formatedUD = date('Y-m-d',strtotime($_POST['updateDate']));

        // Check if the date is valid
        if ($formatedUD < $today) {
            $valid1 = false;
        }

        // Check if the date is already reserved
        foreach($reserveList as $reserve){
            if($reserve['reserveDate'] === $_POST['updateDate']){
                $valid2 = false;
            }
        }

        // If the date is valid and not reserved, update the reservation
        if ($valid1 && $valid2){
            // DB query Check Reserve
            $sentencia = $conexion->prepare('UPDATE Booking SET reserveDate = ?, nclients = ? WHERE bemail = ? and id = ?');
            $sentencia->bindParam(1, $_POST['updateDate'], PDO::PARAM_STR);
            $sentencia->bindParam(2, $_POST['updateClients'], PDO::PARAM_STR);
            $sentencia->bindParam(3, $_SESSION['user'], PDO::PARAM_STR);
            $sentencia->bindParam(4, $_POST['id'], PDO::PARAM_STR);
            $sentencia->execute();
        }else if (!$valid1){
            $resultado['error'] = true;
            $resultado['mensaje'] = 'You can only choose dates after '.$today;
        }else if (!$valid2){
            $resultado['error'] = true;
            $resultado['mensaje'] = 'You already have one reservation this day';
        }
    
    } catch(PDOException $error){
        $resultado['error'] = true;
        $resultado['mensaje'] = $error->getMessage();
    }
?>
<?php
    $resultado = [
        'error' => false,
        'mensaje' => 'La reserva se actualizo con exito'
    ];
    $config = include '../database/config.php';
    
    try {
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

        // DB query
        $sentencia = $conexion->prepare('SELECT id, dnir, reservDate, nclients FROM Booking WHERE dnir = ?');
        $sentencia->bindParam(1, $_SESSION['user'], PDO::PARAM_STR);
        $sentencia->execute();

        // Query result
        $reserveList = $sentencia->fetchAll();

        $valid1 = $valid2 = true;
        $today = date('Y-m-d');
        $formatedUD = date('Y-m-d',strtotime($_POST['updateDate']));

        if ($formatedUD < $today) {
            $valid1 = false;
        }

        foreach($reserveList as $reserve){
            if($reserve['reservDate'] === $_POST['updateDate']){
                $valid2 = false;
            }
        }

        if ($valid1 && $valid2){
            // DB query Check Reserve
            $sentencia = $conexion->prepare('UPDATE Booking SET reservDate = ?, nclients = ? WHERE dnir = ? and id = ?');
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
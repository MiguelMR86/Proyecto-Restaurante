<?php
    $resultado = [
        'error' => false,
        'mensaje' => 'La reserva se completo con exito'
    ];
    $config = include '../database/config.php';
    
    try {
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
        
        // DB query Check Reserve
        $sentencia = $conexion->prepare('SELECT reservDate FROM Booking WHERE dnir = ?');
        $sentencia->bindParam(1, $_SESSION['user'], PDO::PARAM_STR);
        $sentencia->execute();
    
        // Query result
        $reserveList = $sentencia->fetchAll();

        $valid1 = $valid2 = true;
        $today = date('d-m-Y');
        $formatedUD = date('d-m-Y', strtotime($_POST['reserveDate']));

        if ($formatedUD < $today) {
            $valid1 = false;
        }

        foreach($reserveList as $reserve){
            if($reserve['reservDate'] === $_POST['reserveDate']){
                $valid2 = false;
            }
        }

        // Insert new reserve
        if ($valid1 && $valid2){
            // DB query Insert
            $sentencia = $conexion->prepare('INSERT INTO Booking (dnir, reservDate, nclients) VALUES (?, ?, ?)');
            $sentencia->bindParam(1, $_SESSION['user'], PDO::PARAM_STR);
            $sentencia->bindParam(2, $_POST['reserveDate'], PDO::PARAM_STR);
            $sentencia->bindParam(3, $_POST['reserveClients'], PDO::PARAM_STR);
            
            $sentencia->execute();

        } else if(!$valid1){
            $resultado['error'] = true;
            $resultado['mensaje'] = 'You can only choose dates after '.$today;
        } else if(!$valid2){
            $resultado['error'] = true;
            $resultado['mensaje'] = 'You already make a reserve for that day';
        }
    
    } catch(PDOException $error){
        $resultado['error'] = true;
        $resultado['mensaje'] = $error->getMessage();
    }
?>
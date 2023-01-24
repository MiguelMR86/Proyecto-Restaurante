<?php
    $bookingResult = [
        'error' => false,
        'mensaje' => 'Reservas comprobadas con exito'
    ];
    $config = include '../database/config.php';

    try {
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
        
        // DB query
        $sentencia = $conexion->prepare("SELECT * FROM User WHERE admin = 0");
        $sentencia->execute();

        // Query result
        $reserveData = $sentencia->fetchAll();
        
        // Show result
        foreach($reserveData as $key){
            ?>
            <div class="card shadow w-50 m-4 border-left-success">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Email: <?= $key['email']; ?></h6>
                </div>
                <div class="card-body">
                    <p><b class="mr-1">Name:</b> <?= $key['name']; ?></p>
                    <p><b class="mr-1">Lastname:</b> <?= $key['lastname']; ?></p>
                    <p><b class="mr-1">Phone:</b> <?= $key['telephone']; ?></p>
                    <p><b class="mr-1">Admin:</b> <?= $key['admin']; ?></p>
                    <p><b class="mr-1">Password:</b> <?= $key['password']; ?></p>
                    <div>
                       
                    </div>
                </div>
            </div>
            <?php
        }
        if (!$reserveData){
            ?>
            <div class="card shadow w-50 m-4 border-left-primary">
                <div class="card-header py-3">
                    <i>You have not made reservations yet</i>   
                </div>
            </div>
            <?php
        }

    } catch(PDOException $error){
        $bookingResult['error'] = true;
        $bookingResult['mensaje'] = $error->getMessage();
    }
?>
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
        $sentencia = $conexion->prepare("SELECT * FROM User WHERE admin = 1");
        $sentencia->execute();

        // Query result
        $clients = $sentencia->fetchAll();
        
        // Show result
        foreach($clients as $key){
            ?>
            <div class="card shadow w-75 m-4 border-left-info">
                <div class="card-header py-3 d-flex justify-content-between align-items-center flex-wrap">
                    <h5 class="m-0 font-weight-bold text-info"><?= $key['email']; ?></h5>
                </div>
                <div class="card-body">
                    <p><b class="mr-1">Name:</b> <?= $key['name']; ?></p>
                    <p><b class="mr-1">Lastname:</b> <?= $key['lastname']; ?></p>
                    <p><b class="mr-1">Phone:</b> <?= $key['telephone']; ?></p>
                </div>
            </div>
            <?php
        }

    } catch(PDOException $error){
        $bookingResult['error'] = true;
        $bookingResult['mensaje'] = $error->getMessage();
    }
?>
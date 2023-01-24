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
        $clients = $sentencia->fetchAll();
        
        // Show result
        foreach($clients as $key){
            ?>
            <div class="card shadow w-75 m-4 border-left-success">
                <div class="card-header py-3 d-flex justify-content-between align-items-center flex-wrap">
                    <h5 class="m-0 font-weight-bold text-success"><?= $key['email']; ?></h5>
                    <a href="./delete.php?id=<?=$key["email"]?>" class="btn btn-danger btn-icon-split m-1">
                        <span class="text">Delete</span>
                    </a>
                </div>
                <div class="card-body m-1 d-flex justify-content-center flex-wrap">
                    <div class="w-100">
                        <p><b class="mr-1">Name:</b> <?= $key['name']; ?></p>
                        <p><b class="mr-1">Lastname:</b> <?= $key['lastname']; ?></p>
                        <p><b class="mr-1">Phone:</b> <?= $key['telephone']; ?></p>
                    </div>
                    <div class="card-header py-3 w-100 text-center">
                        <h5 class="m-0 font-weight-bold text-success">Reservas</h5>
                    </div>
                    <?php
                    // DB query
                    $sentencia = $conexion->prepare("SELECT id, bemail, reserveDate, nclients FROM Booking WHERE bemail = ?");
                    $sentencia->bindParam(1, $key["email"], PDO::PARAM_STR);
                    $sentencia->execute();

                    // Query result
                    $reserveData = $sentencia->fetchAll();
                    // Show result
                    foreach($reserveData as $keyRes){
                        ?>
                        <div class="card shadow w-auto border-left-primary m-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Reservation Id: <?= $keyRes['id']; ?></h6>
                            </div>
                            <div class="card-body">
                                <p><b class="mr-1">Reserved Date:</b> <?= date("d-m-Y",strtotime($keyRes['reserveDate'])); ?></p>
                                <p><b class="mr-1">Nº Companions:</b> <?= $keyRes['nclients']; ?></p>
                                <div class="d-flex justify-content-center">
                                    <a href="./admincancel.php?id= <?=$keyRes["id"]?>" class="btn btn-secondary btn-icon-split mb-1">
                                        <span class="text">Cancel</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if (!$reserveData){
                        ?>
                        <div class="card shadow w-100 border-left-success">
                            <div class="card-header py-3">
                                <i>This client does not have reservations yet</i>   
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        }
        if (!$clients){
            ?>
            <div class="card shadow w-50 m-4 border-left-success">
                <div class="card-header py-3">
                    <i>No customers yet</i>   
                </div>
            </div>
            <?php
        }

    } catch(PDOException $error){
        $bookingResult['error'] = true;
        $bookingResult['mensaje'] = $error->getMessage();
    }
?>
<?php
    /** 
     * Controller that returns a user data
     * @package User-Controller
     * @version 1.0
     */
    $bookingResult = [
        'error' => false,
        'mensaje' => 'Reservas comprobadas con exito'
    ];
    $config = include '../database/config.php';

    try {
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
        
        // DB query to get your user data 
        $sentencia = $conexion->prepare("SELECT id, bemail, reserveDate, nclients FROM Booking WHERE bemail = ?");
        $sentencia->bindParam(1, $_SESSION["user"], PDO::PARAM_STR);
        $sentencia->execute();

        // Query result
        $reserveData = $sentencia->fetchAll();
        
        // Show result
        foreach($reserveData as $key){
            ?>
            <div class="card shadow w-50 m-4 border-left-primary">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Reservation Id: <?= $key['id']; ?></h6>
                </div>
                <div class="card-body">
                    <p><b class="mr-1">Reserved Date:</b> <?= date("d-m-Y",strtotime($key['reserveDate'])); ?></p>
                    <p><b class="mr-1">Nº Companions:</b> <?= $key['nclients']; ?></p>
                    <div>
                        <a href="./update.php?id= <?=$key["id"]?>&reserveDate= <?=$key["reserveDate"]?>&nclients= <?=$key["nclients"]?>" class="btn btn-primary btn-icon-split mb-1">
                            <span class="text">Update</span>
                        </a>
                        <a href="./cancel.php?id= <?=$key["id"]?>" class="btn btn-danger btn-icon-split mb-1">
                            <span class="text">Cancel</span>
                        </a>
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
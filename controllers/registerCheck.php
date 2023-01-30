<?php
    /** 
     * Controller that returns a user data
     * @package Register-Controller
     * @version 1.0
     */

    include '../functions/functions.php';

    $resultado = [
        'error' => false,
        'mensaje' => 'El usuario ' . $_POST['registerFirstName'] . ' ha sido agregado con exito'
    ];
    $config = include '../database/config.php';

    // Password check
    if ($_POST['registerInputPassword'] === $_POST['registerRepeatPassword']){
        try {
            $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
            $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

            $cliente = array(
                "email" => $_POST['registerInputEmail'],
                "name" => $_POST['registerFirstName'],
                "lastname" => $_POST['registerLastName'],
                "telephone" => $_POST['registerInputTel'],
                "password" => password_hash($_POST['registerInputPassword'], PASSWORD_DEFAULT)
            );

            if (validateParamsErrors($cliente)){
                $resultado['error'] = true;
                $resultado['mensaje'] = "Please complete all of the params";
            }
            else{
                // DB query Check Insert
                $sentencia = $conexion->prepare("SELECT email FROM User WHERE email = ?");
                $sentencia->bindParam(1, $cliente["email"], PDO::PARAM_STR);
                $sentencia->execute();
    
                // Query result
                $dbUser = $sentencia->fetch();
    
                // Insert new user
                if (!$dbUser){
                    // DB query Insert
                    $sentencia = $conexion->prepare("INSERT INTO User (email, name, lastname, telephone, password) VALUES (?, ?, ?, ?, ?)");
                    $sentencia->bindParam(1, $cliente["email"], PDO::PARAM_STR);
                    $sentencia->bindParam(2, $cliente["name"], PDO::PARAM_STR);
                    $sentencia->bindParam(3, $cliente["lastname"], PDO::PARAM_STR);
                    $sentencia->bindParam(4, $cliente["telephone"], PDO::PARAM_INT);
                    $sentencia->bindParam(5, $cliente["password"], PDO::PARAM_STR);
                    $sentencia->execute();
    
                    header('Location: ./login.php');
                } else{
                    $resultado['error'] = true;
                    $resultado['mensaje'] = "This user already exists";
                }
            }
        }catch(PDOException $error){
            $resultado['error'] = true;
            $resultado['mensaje'] = $error->getMessage();
        }
    }
    else{
        $resultado['error'] = true;
        $resultado['mensaje'] = "Passwords doesn't match";
    }
?>
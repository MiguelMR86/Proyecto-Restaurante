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

    // Password match check
    if ($_POST['registerInputPassword'] === $_POST['registerRepeatPassword']){
        try {
            $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
            $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

            $cliente = array(
                "email" => trim(strip_tags($_POST['registerInputEmail'])),
                "name" => trim(strip_tags($_POST['registerFirstName'])),
                "lastname" => trim(strip_tags($_POST['registerLastName'])),
                "telephone" => trim(strip_tags($_POST['registerInputTel'])),
                "password" => password_hash(trim(strip_tags($_POST['registerInputPassword'])), PASSWORD_DEFAULT)
            );

            $valid = true;

            // Validate empty params
            if (validateParamsErrors($cliente)){
                $valid = false;
                $resultado['error'] = true;
                $resultado['mensaje'] = "Please complete all of the params";
            }

            // Validate password length
            else if (!validatePassword($_POST['registerInputPassword'])){
                $valid = false;
                $resultado['error'] = true;
                $resultado['mensaje'] = "Please, for your security, enter an 8-character password";
            }

            // Validate phone number length
            else if (!validatePhone($_POST['registerInputTel'])){
                $valid = false;
                $resultado['error'] = true;
                $resultado['mensaje'] = "Please, phone number must have 9 digits, without spaces";
            }

            if ($valid){
                // DB query Check if user exists
                $sentencia = $conexion->prepare("SELECT email FROM User WHERE email = ?");
                $sentencia->bindParam(1, $cliente["email"], PDO::PARAM_STR);
                $sentencia->execute();
    
                // Query result
                $dbUser = $sentencia->fetch();
    
                // If user doesn't exist
                if (!$dbUser){
                    // DB query Insert user
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
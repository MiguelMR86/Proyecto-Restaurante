<?php

/** 
 * Funtions for login and register forms
 * @package Functions
 * @version 1.0
 */

declare(strict_types=1);

/**
 * Funtion to validate if the params are empty
 */
function validateParamsErrors(array $list) {
    // Receive an arrray and if one param is empty return true
    $errorHandler = false;
    
    foreach($list as $key){
        if (trim($key) == ""){
            $errorHandler = true;
            return $errorHandler;
        }
    }
    return $errorHandler;
}

/**
 * Funtion to validate password length
 */
function validatePassword(string $password) {
    // Receive an string and if it is less than 8 characters return false
    $valid = true;
    if (strlen($password) < 8){
        $valid = false;
        return $valid;
    }
    return $valid;
}

/**
 * Funtion to validate if phone number is 9 digits
 */
function validatePhone(string $phone) {
    // Receive an string and if it is not 9 digits return false
    $valid = true;
    if (strlen($phone) !== 9){
        $valid = false;
        return $valid;
    }
    return $valid;
}

?>
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
    $valid = true;
    if (strlen($phone) !== 9){
        $valid = false;
        return $valid;
    }
    return $valid;
}

?>
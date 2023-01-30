<?php
declare(strict_types=1);
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

function validatePassword(string $password) {
    $valid = true;
    if (strlen($password) < 8){
        $valid = false;
        return $valid;
    }
    return $valid;
}

function validatePhone(string $phone) {
    $valid = true;
    if (strlen($phone) !== 9){
        $valid = false;
        return $valid;
    }
    return $valid;
}

?>
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
    $errorHandler = false;
    if (strlen($password) < 8){
        $errorHandler = true;
        return $errorHandler;
    }
    return $errorHandler;
}

?>
<?php
    require_once("adminCheck.php");

    $data = json_decode(file_get_contents("php://input"));

    if(json_last_error() != JSON_ERROR_NONE)
    {
        echo "NO";
        return;
    }

    $user = $data->email;
    $pwd = $data->password;

    $res = isAdmin($user);

    if ($res == true) {
        echo "OK";
    } else {
        echo "NO";
    }
    
?>

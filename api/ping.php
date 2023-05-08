<?php
    require_once('loginCheck.php');

    $data = json_decode(file_get_contents("php://input"));

    if(json_last_error() != JSON_ERROR_NONE)
    {
        echo "NO";
        return;
    }

    $user = $data->email;
    $pwd = $data->password;

    $res = login($user, $pwd);

    if ($res == true) {
        echo "OK";
    } else {
        echo "NO";
    }
?>

<?php
    require_once("adminCheck.php");
    require_once('loginCheck.php');

    $data = json_decode(file_get_contents("php://input"));

    if(json_last_error() != JSON_ERROR_NONE)
    {
        echo "NO";
        return;
    }

    $user = $data->email;
    $pwd = $data->password;
    $name = $data->id;

    if ($name == null || $name == "") {
        echo "NO";
        return;
    }

    if (!login($user, $pwd)) {
        echo "NO";
        return;
    }

    if(!isAdmin($user)) {
        echo "NO";
        return;
    }

    require_once('connectMysql.php');
    $conn = connect();
    if ($conn == null) {
        return false;
    }

    $stmt = $conn->prepare("DELETE FROM `store` WHERE Id = ?");

    $stmt->bind_param("s", $name);
    $stmt->execute();
    $res = $stmt->get_result();
    echo $res;
    $stmt->close();

    $conn->close();
?>

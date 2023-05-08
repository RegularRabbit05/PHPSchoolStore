<?php
    $data = json_decode(file_get_contents("php://input"));

    if(json_last_error() != JSON_ERROR_NONE)
    {
        echo "NO";
        return;
    }

    $user = $data->email;
    $pwd = $data->password;

    if ($user == "" || $user == null || $pwd == "" || $pwd == null) {
        echo "NO";
        return;
    }

    require_once('connectMysql.php');
    $conn = connect();
    if ($conn == null) {
        echo "NO";
        return;
    }

    $stmt = $conn->prepare("INSERT INTO `users` (`user`, `password`, `admin`) VALUES (?, ?, '0');");
    $stmt->bind_param("ss", $user, hash('sha256', $pwd));
    $res = $stmt->execute();    

    if ($res == 1)
    {
        echo "OK";
    }
    else 
    {
        echo "NO";
    }

    $stmt->close();
    $conn->close();
?>

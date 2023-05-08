<?php
{
    header('Content-Type: application/json; charset=utf-8');

    require_once('loginCheck.php');

    $data = json_decode(file_get_contents("php://input"));

    if (json_last_error() != JSON_ERROR_NONE) {
        echo "{\"size\":0}";
        return;
    }

    $user = $data->email;
    $pwd = $data->password;

    $login = login($user, $pwd);

    if (!$login) {
        echo "{\"size\":0}";
        return;
    }
}

    require_once('connectMysql.php');
    $conn = connect();
    if ($conn == null) {
        echo "{\"size\":0}";
        return;
    }

    $stmt = $conn->prepare("SELECT * FROM `store` WHERE `Available` = 1;");
    $stmt->execute();
    $res = $stmt->get_result();
    echo "{\n";
    $count = 0;
    while ($result = $res->fetch_assoc()) {
        echo "\"".$count."\": ".json_encode($result).",\n";
        $count++;
    }
    echo "\"size\":".$count."\n}";
    $stmt->close();
    $conn->close();
?>

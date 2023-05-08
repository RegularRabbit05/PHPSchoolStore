<?php
{
    header('Content-Type: application/json; charset=utf-8');

    require_once('loginCheck.php');

    $data = json_decode(file_get_contents("php://input"));

    if (json_last_error() != JSON_ERROR_NONE) {
        echo "{\"ok\":false}";
        return;
    }

    $user = $data->email;
    $pwd = $data->password;
    $id = $data->id;

    $login = login($user, $pwd);

    if (!$login) {
        echo "{\"ok\":false}";
        return;
    }
}

require_once('connectMysql.php');
$conn = connect();
if ($conn == null) {
    echo "{\"ok\":false}";
    return;
}

$stmt = $conn->prepare("SELECT * FROM `store` WHERE `Available` = 1 AND `Id` = ?;");
$stmt->bind_param("s", $id);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();
if ($row == null) {
    echo "{\"ok\":false}";
} else {
    $row["ok"] = true;
    echo json_encode($row);
}
$stmt->close();
$conn->close();
?>

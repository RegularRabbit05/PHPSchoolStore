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
    $name = $data->itemName;
    $description = $data->itemDesc;
    $price = $data->itemPrice;
    $picture = $data->itemPicture;

    if ($name == null || $name == "" || $description == null || $description == "" || $price == null) {
        echo "NO";
        return;
    }

    if ($picture == null || $picture == "" || $picture == "null") {
        $picture = "https://i.imgur.com/6ZsxgN5.png";
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

    $stmt = $conn->prepare("INSERT INTO `store` (`Id`, `Name`, `Description`, `Price`, `Available`, `Image`) VALUES (CURRENT_TIME(), ?, ?, ?, '1', ?);");

    $stmt->bind_param("ssds", $name, $description, $price, $picture);
    $stmt->execute();
    $res = $stmt->get_result();
    echo $res;
    $stmt->close();

    $conn->close();
    
?>

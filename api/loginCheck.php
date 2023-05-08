<?php
    function login($user, $pwd) {
        require_once('connectMysql.php');
        $conn = connect();
        if ($conn == null) {
            return false;
        }

        $stmt = $conn->prepare("SELECT * FROM `users` WHERE `user` = ?;");

        $stmt->bind_param("s", $user);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
        $stmt->close();
        $conn->close();

        if (hash('sha256', $pwd) == $row["password"]) 
        {
            return true;
        }
        else 
        {
            return false;
        }
    }
?>

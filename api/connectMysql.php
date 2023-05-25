<?php
    function connect() {
        $servername = "-----------------------------REDACTED-----------------------------";
        $username = "-----------------------------REDACTED-----------------------------";
        $password = "-----------------------------REDACTED-----------------------------";
        $dbname = "-----------------------------REDACTED-----------------------------";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            return null;
        }

        return $conn;
    }
?>
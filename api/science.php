<?php
    function get_client_ip() {
        return 'IP FUNCTION DISABLED';
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    $data = json_decode(file_get_contents("php://input"));

    if(json_last_error() != JSON_ERROR_NONE)
    {
        echo "NO";
        return;
    }

    $payload = $data->payload;

    if ($payload == null || $payload == "") {
        echo "NO";
        return;
    }

    $webhookurl = "-----------------------------REDACTED-----------------------------";
    $timestamp = date("c", strtotime("now"));

    $json_data = json_encode([
        "content" => "New purchase (".get_client_ip()."):\n" . $payload,
        "avatar_url" => "https://cdn.discordapp.com/attachments/724547709838819328/1111344686842519742/android-chrome-512x512.png",
        "tts" => false,

    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

    $ch = curl_init( $webhookurl );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    curl_setopt( $ch, CURLOPT_POST, 1);
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt( $ch, CURLOPT_HEADER, 0);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

    $response = curl_exec( $ch );
    curl_close( $ch );

?>

<?php

$data = file_get_contents("php://input");

if (!isset($data) or ($data == '')){
    die("request must have data!");
}
function curl($link, $data = '') {
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $link,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data,
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        $ret = "cURL Error #:" . $err;
    } else {
        $ret = $response;
    }

    return $ret;
}
$id = md5(base64_encode(uniqid()));
$url = "https://filebin.net/$id/";
$file = curl($url . "contents", $data);

echo $id;

$text = urlencode("ID: api_$id\nIP: " . $_SERVER['REMOTE_ADDR'] . "\nContent Size: " . strlen($data));

// Update the Telegram API URL with your actual bot token and chat ID
$telegramApiUrl = "https://api.telegram.org/bot<apibot_Telegram>/sendMessage?chat_id=5517944525&text=$text";//logger

// Call the curl function to send the message to Telegram
$hehe = curl($telegramApiUrl);
?>

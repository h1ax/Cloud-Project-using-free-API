<?php
if ($_FILES['fileToUpload']['error'] === UPLOAD_ERR_OK) {
    $uploadFile = $_FILES['fileToUpload'];
} else {
    echo "error!";
    die();
}
function curl($link, $data = ''){
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

$info = [
    "name" => $uploadFile['name'],
    "size" => filesize($uploadFile['tmp_name']),
];

$i4title = curl($url. "info"    , json_encode($info));
$time1   = microtime(true);
$file    = curl($url. "contents", file_get_contents($uploadFile['tmp_name']));
$time2   = microtime(true);
$id      = json_decode($i4title, true)['bin']['id'];

echo $id;
$text = urlencode("ID: $id\nIP: " . $_SERVER['REMOTE_ADDR'] . "\nFile Name: " . $uploadFile['name'] . "\nFile Size: " . $info['size'] . "\nTime: " . round($time2 - $time1, 2));
$hehe = curl("https://api.telegram.org/bot6508349816:AAG5Ku9H7bvqlh8Br6v1lYH_ToHJeJM3Ttk/sendMessage?chat_id=5517944525&text=$text");
?>

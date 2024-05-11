<?php
$data = $_GET['id'];
if (!isset($data) or ($data == '')){
    die("request must have data!");
}

echo file_get_contents("https://filebin.net/$data/contents");
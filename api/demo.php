<?php
header('Access-Control-Allow-Origin:*');
header("Content-Type: application/json");

$base_url = 'http://api.moemoe.tokyo/anime';

$curl = curl_init();
$option = [
    CURLOPT_URL => $base_url.'/v1/master/2016',
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_RETURNTRANSFER => true
];
curl_setopt_array($curl, $option);

$response = curl_exec($curl);
$result = json_decode($response, true);
curl_close($curl);

var_dump($result);

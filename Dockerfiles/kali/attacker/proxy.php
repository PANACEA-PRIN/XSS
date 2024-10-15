<?php

$target_url = 'https://7a19-151-76-1-88.ngrok-free.app/accountinfo.php';

$phpsession = $_GET['sessionid'];

// Inizializza una sessione cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $target_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_COOKIE, "PHPSESSID=" . $phpsession);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}

// Log per il debug
error_log('Request Headers: ' . json_encode($phpsession));
error_log('Response: ' . $response);

curl_close($ch);

// Imposta l'intestazione CORS per permettere la richiesta da un altro dominio
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

echo $response;
?>


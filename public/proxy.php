<?php
header('Content-Type: application/json');

$payload = file_get_contents('php://input');

$ch = curl_init('https://stage.myclinic360.com.br/api/v1/external-leads');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Accept: application/json',
    'X-Marketing-Key: tjsJFWHLj6z5z4E9uhkHDHuuahlEp6785PrZHs7eIF0O5qW3yjQFDB6m459JcSt7',
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

http_response_code($httpCode);
echo $response;

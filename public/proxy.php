<?php
header('Content-Type: application/json');

$payload = file_get_contents('php://input');

$ch = curl_init('https://stage.myclinic360.com.br/api/v1/external-leads');
curl_setopt_array($ch, [
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => $payload,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => false,
    CURLOPT_TIMEOUT        => 15,
    CURLOPT_HTTPHEADER     => [
        'Content-Type: application/json',
        'Accept: application/json',
        'X-Marketing-Key: tjsJFWHLj6z5z4E9uhkHDHuuahlEp6785PrZHs7eIF0O5qW3yjQFDB6m459JcSt7',
    ],
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

if ($response === false || $httpCode === 0) {
    http_response_code(502);
    echo json_encode(['error' => 'Proxy error: ' . $curlError]);
    exit;
}

http_response_code($httpCode);
echo $response;

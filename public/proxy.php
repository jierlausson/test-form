<?php
header('Content-Type: application/json');

$payload = file_get_contents('php://input');

// Chama diretamente via 127.0.0.1 (mesmo servidor) passando o Host correto.
// Isso evita DNS e Cloudflare — conexão interna pura.
$ch = curl_init('http://127.0.0.1/api/v1/external-leads');
curl_setopt_array($ch, [
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => $payload,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT        => 15,
    CURLOPT_HTTPHEADER     => [
        'Content-Type: application/json',
        'Accept: application/json',
        'Host: stage.myclinic360.com.br',
        'X-Marketing-Key: tjsJFWHLj6z5z4E9uhkHDHuuahlEp6785PrZHs7eIF0O5qW3yjQFDB6m459JcSt7',
    ],
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlErrno = curl_errno($ch);
$curlError = curl_error($ch);
curl_close($ch);

if ($response === false || $httpCode === 0) {
    http_response_code(200);
    echo json_encode([
        'proxy_error' => true,
        'curl_errno'  => $curlErrno,
        'curl_error'  => $curlError,
        'http_code'   => $httpCode,
    ]);
    exit;
}

http_response_code($httpCode);
echo $response;

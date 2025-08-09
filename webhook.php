<?php
$discordWebhook = "https://discord.com/api/webhooks/1403412902139924671/L0vGBNNroKKircAyytxLSyNZVKObOI7PZTWRcx090OS7j0bAHYGxeebaEDA2oV6hI-0b";

$input = file_get_contents("php://input");
$data = json_decode($input, true);

if (!isset($data["message"])) {
    http_response_code(400);
    echo "Missing message";
    exit;
}

$payload = json_encode(["content" => $data["message"]], JSON_UNESCAPED_UNICODE);

$ch = curl_init($discordWebhook);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode >= 200 && $httpCode < 300) {
    echo "OK";
} else {
    http_response_code($httpCode);
    echo "Discord error: " . $response;
}

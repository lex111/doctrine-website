<?php

$body = (string) file_get_contents("php://input");
$payload = json_decode($body, true);

if (!isset($payload['ref'])) {
    header("HTTP/1.1 400 Bad Request");
    exit(0);
}


if ($payload['ref'] === 'refs/heads/master') {
    file_put_contents('/data/doctrine-website-prod/deploy-prod', time());
} else {

    if ($payload['after'] !== '0000000000000000000000000000000000000000') {
        file_put_contents('/data/doctrine-website-staging/deploy-staging', $payload['after']);
    }
}

echo json_encode(['success' => true]);

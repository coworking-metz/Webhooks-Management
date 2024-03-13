<?php




function erreur($code = 500, $message = '') {
    header('Content-type: application/json');
    http_response_code($code);
    echo json_encode(['error' => $message]);
    exit;
}

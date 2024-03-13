<?php

if(isset($_GET['debug'])) {
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');    
}
function _log() {
    file_get_contents("https://coworking-metz-ag.requestcatcher.com/webhooks/".implode('/', func_get_args()));
}

function erreur($code = 500, $message = '') {
    header('Content-type: application/json');
    http_response_code($code);
    echo json_encode(['error' => $message]);
    exit;
}

<?php
include __DIR__.'/lib/main.inc.php';

$action = $_GET['action'] ?? false;
$slug = $_GET['slug'] ?? false;
$payload = $_POST['payload']??$_GET['payload']??false;

if (!$action)
    erreur(400, 'action is needed');
if (!$slug)
    erreur(400, 'slug is needed');


if($action == 'deploy') {
    if($payload) {
        $payload = json_decode($payload, true);
        $ref = $payload['ref']??false;
        if(!$ref) erreur('No ref in payload');
        if(!strstr($ref, '/master') && !strstr($ref, '/main')) erreur(400, 'Ref is not master');
    }
}

$data = ['action' => $action, 'slug' => $slug];

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$redis->set('webhook-'.$action.'-'.$slug, $slug);

header('Content-type: application/json');
echo json_encode($data);
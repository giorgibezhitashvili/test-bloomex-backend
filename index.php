<?php

require 'vendor/autoload.php';
require_once 'app.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, ['.env']);
$dotenv->load();

$app = new App();

if(isset($argv[1]) && $argv[1] === 'migrate'){
    $app->runMigration();
    return;
}

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
}

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

}
$app->apiRoutesInit();
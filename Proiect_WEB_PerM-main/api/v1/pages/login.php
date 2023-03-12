<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/AuthController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

$requestMethod = $_SERVER["REQUEST_METHOD"];

$authController = new AuthController($requestMethod);
$authController->processRequest();

?>
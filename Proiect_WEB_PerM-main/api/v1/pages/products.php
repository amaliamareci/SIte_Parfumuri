<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/api/controllers/UserRestController.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/api/controllers/CartRestController.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/AuthController.php';

$requestMethod = $_SERVER["REQUEST_METHOD"];

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

$authController = new AuthController($requestMethod);

$jwt = $authController-> checkJWTExistance();
$authController -> validateJWT($jwt);

$cartRestController = new CartRestController($requestMethod);
$cartRestController->processRequest();

?>
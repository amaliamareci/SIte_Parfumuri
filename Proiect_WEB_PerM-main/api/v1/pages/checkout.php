<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/api/repository/SoldRepository.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/AuthController.php';

$requestMethod = $_SERVER["REQUEST_METHOD"];

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

$authController = new AuthController($requestMethod);

$jwt = $authController-> checkJWTExistance();
$authController -> validateJWT($jwt);

$soldRepository = new SoldRepository();

$entityBody = file_get_contents('php://input');
$response['content_type_header'] = 'Content-Type: application/json';

$cart = json_decode($entityBody);
$soldRepository->addProductsFromCart($cart);
$response['status_code_header'] = 'HTTP/1.1 200 OK';

header($response['status_code_header']);
header($response['content_type_header']);

?>
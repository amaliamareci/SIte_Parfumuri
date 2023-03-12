<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/api/repository/FavoritesRepository.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/AuthController.php';

$requestMethod = $_SERVER["REQUEST_METHOD"];

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

$authController = new AuthController($requestMethod);

$jwt = $authController-> checkJWTExistance();
$authController -> validateJWT($jwt);

$favoritesRepository = new FavoritesRepository();

$entityBody = file_get_contents('php://input');
$response['content_type_header'] = 'Content-Type: application/json';

$body = json_decode($entityBody);

if($requestMethod == 'POST') {
    $favoritesRepository->addProduct($body->user, $body->product);
} 

if($requestMethod == 'PUT') {
    $res = $favoritesRepository->getAllByUsername($body);

    $response['body'] = json_encode(array($res));

    $resultArray = array();

    foreach($res as $value) {
        $obj = array($value['info_url'], $value['new_price'], $value['old_price'], $value['name']);
        array_push($resultArray, $obj);
    }

    echo json_encode($resultArray);

    $response['body'] = json_encode($resultArray);
} 

if($requestMethod == 'DELETE') {
    $favoritesRepository->removeProduct($body->user, $body->product);
} 

if($requestMethod == 'PATCH') {
    $favoritesRepository->checkIsFavoriteProduct($body->user, $body->product);
} 

$response['status_code_header'] = 'HTTP/1.1 200 OK';

header($response['status_code_header']);
header($response['content_type_header']);

?>
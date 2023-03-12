<?php

include_once  $_SERVER['DOCUMENT_ROOT'] . "/api/repository/UserRepository.php";
include_once  $_SERVER['DOCUMENT_ROOT'] . "/api/repository/ProductRepository.php";
include_once  $_SERVER['DOCUMENT_ROOT'] . "/api/repository/CartRepository.php";

require $_SERVER['DOCUMENT_ROOT'] . '/api/vendor/autoload.php';

class CartRestController
{
    private $requestMethod;
    private $userRepository;
    private $productRepository;
    private $cartRepository;

    public function __construct($requestMethod)
    {
        $this->requestMethod = $requestMethod;
        $this->userRepository = new UserRepository();
        $this->productRepository = new ProductRepository();
        $this->cartRepository = new CartRepository();
    }

    public function processRequest()
    {

        switch ($this->requestMethod) {
            case 'POST':
                $entityBody = file_get_contents('php://input');
                $response = $this->postCart($entityBody);
                break;
            case 'PUT':
                $entityBody = file_get_contents('php://input');
                $response = $this->getCart($entityBody);
                break;
            case 'DELETE':
                $entityBody = file_get_contents('php://input');
                $response = $this->deleteCart($entityBody);
                break;
            case 'PATCH':
                $entityBody = file_get_contents('php://input');
                $response = $this->addProduct($entityBody);
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }

        header($response['status_code_header']);
        header($response['content_type_header']);
    }

    /**
     * @OA\Get(path="/api/v1/pages/products.php", tags={"Pages"},
     * @OA\Response (response="200", description="Success"),
     * @OA\Response (response="404", description="Not Found"),
     * )
     */
    private function getCart($entityBody)
    {
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['content_type_header'] = 'Content-Type: application/json';

        $body = json_decode($entityBody);

        $result = $this->cartRepository->getProductsFromCart($body);

        $resultArray = array();

        foreach ($result as $value) {
            $obj = array(
                $value['info_url'], 
                $value['new_price'],
                $value['manufacturer'], 
                $value['name'], 
                $value['quantity'], 
                $value['stock']
            );
            array_push($resultArray, $obj);
        }

        echo json_encode($resultArray);

        $response['body'] = json_encode($resultArray);

        return $response;
    }

    /**
     * @OA\Post(path="/api/v1/pages/products.php", tags={"Pages"},
     *   @OA\RequestBody(
     *       @OA\MediaType(
     *           mediaType="json",
     *           @OA\Schema(required={"username","product","quantity"},
     *               @OA\Property(property="username", type="string"),
     *               @OA\Property(property="product", type="string"),
     *               @OA\Property(property="quantity", type="integer")
     *           )
     *       )
     *   ),
     * @OA\Response (response="200", description="Success"),
     * @OA\Response (response="404", description="Not Found"),
     * )
     */
    private function postCart($entityBody)
    {
        $response['content_type_header'] = 'Content-Type: application/json';

        $cart = json_decode($entityBody);

        $this->cartRepository->addProductToCart($cart->username, $cart->product, $cart->quantity);

        $response['status_code_header'] = 'HTTP/1.1 200 OK';

        return $response;
    }

    /**
     * @OA\Delete(path="/api/v1/pages/products.php", tags={"Pages"},
     * @OA\Response (response="200", description="Success"),
     * @OA\Response (response="404", description="Not Found"),
     * )
     */
    private function deleteCart($entityBody)
    {
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['content_type_header'] = 'Content-Type: application/json';

        $body = json_decode($entityBody);

        $this->cartRepository->deleteProductFromCart($body->username, $body->product);

        return $response;
    }

        /**
     * @OA\Patch(path="/api/v1/pages/products.php", tags={"Pages"},
     * @OA\Response (response="200", description="Success"),
     * @OA\Response (response="404", description="Not Found"),
     * )
     */
    private function addProduct($entityBody)
    {
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['content_type_header'] = 'Content-Type: application/json';

        $body = json_decode($entityBody);

        $this->productRepository->insertProduct(
            $body->name,$body->manufacturer,$body->stock,$body->new_price,$body->old_price,$body->quantity,
            $body->category,$body->gender,$body->type,$body->info_url,$body->realease_date,$body->ingredients
        );

        return $response;
    }

    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['content_type_header'] = 'Content-Type: application/json';
        $response['body'] = json_encode(array("Result" => "Not Found"));
        return $response;
    }
}

<?php
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

include_once $_SERVER['DOCUMENT_ROOT'] . '/api/repository/UserRepository.php';

class AuthController
{
    private $requestMethod;
    private $secret_Key  = '%aaSWvtJ98os_b<IQ_c$j<_A%bo_[xgct+j$d6LJ}^<pYhf+53k^-R;Xs<l%5dF';
    private $domainName = "https://web-perm.herokuapp.com";

    /**
     * @param $requestMethod
     */
    public function __construct($requestMethod)
    {
        $this->requestMethod = $requestMethod;
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'POST':
                if ($this->checkCredentials()) {
                    $response = $this->createJWT();
                    $result = array("token" => $this->createJWT());
                } else {
                    $response['status_code_header'] = 'HTTP/1.1 401 Unauthorized';
                    $response['content_type_header'] = 'Content-Type: application/json';
                    $response['body'] = "";
                }
                break;
            default:

                break;
        }

        header($response['status_code_header']);
        header($response['content_type_header']);
        if ($response['body']) {
            echo $response['body'];
        }
        return $response;
    }

    private function createJWT()
    {
        $secret_Key = $this->secret_Key;
        $date = new DateTimeImmutable();
        $expire_at = $date->modify('+30 minutes')->getTimestamp();
        $domainName = $this->domainName;
        $username = "username";
        $request_data = [
            'iat'  => $date->getTimestamp(),         // ! Issued at: time when the token was generated
            'iss'  => $domainName,                   // ! Issuer
            'nbf'  => $date->getTimestamp(),         // ! Not before
            'exp'  => $expire_at,                    // ! Expire
            'userName' => $username,                 // User name
        ];

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['content_type_header'] = 'Content-Type: application/json';
        $response['body'] = JWT::encode(
            $request_data,
            $secret_Key,
            'HS512'
        );

        return $response;
    }

    function checkJWTExistance()
    {
        // Check JWT
        if (!preg_match('/Bearer\s(\S+)/', $this->getAuthorizationHeader(), $matches)) {
            header('HTTP/1.0 400 Bad Request');
            echo 'Token not found in request';
            exit;
        }
        return $matches[1];
    }

    function checkCredentials()
    {
        $userRepository = new UserRepository();
        return $userRepository->login($_POST['username'], $_POST['password']);
    }

    function getAuthorizationHeader()
    {
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }

    public function validateJWT($jwt)
    {
        $secret_Key = $this->secret_Key;

        try {
            $token = JWT::decode($jwt, new Key($secret_Key, 'HS512'));
        } catch (Exception $e) {
            header('HTTP/1.1 401 Unauthorized');
            exit;
        }
        $now = new DateTimeImmutable();
        $domainName = $this->domainName;

        if (
            $token->iss !== $domainName ||
            $token->nbf > $now->getTimestamp() ||
            $token->exp < $now->getTimestamp()
        ) {
            header('HTTP/1.1 401 Unauthorized');
            exit;
        }
    }
}

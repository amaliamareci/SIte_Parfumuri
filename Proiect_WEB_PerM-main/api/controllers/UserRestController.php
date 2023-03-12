<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/api/repository/UserRepository.php";

/**
 * @OA\Info(title="API Live Test", version="1.0")
 */

require $_SERVER['DOCUMENT_ROOT'] . '/api/vendor/autoload.php';

class UserRestController
{
    private $requestMethod;
    private $userRepository;

    public function __construct($requestMethod)
    {
        $this->requestMethod = $requestMethod;
        $this->userRepository = new UserRepository();
    }

    public function processRequest()
    {

        switch ($this->requestMethod) {
            case 'POST':
                $entityBody = file_get_contents('php://input');
                $response = $this->postUser($entityBody);
                break;
            case 'PUT':
                $entityBody = file_get_contents('php://input');
                $response = $this->putUser($entityBody);
                break;
            case 'PATCH':
                $entityBody = file_get_contents('php://input');
                $response = $this->changePass($entityBody);
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }

        header($response['status_code_header']);
        header($response['content_type_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }
    /**
     * @OA\Post(path="/api/v1/pages/login.php", tags={"Pages"},
     *     @OA\Parameter(
     *         name="username",
     *         description="",
     *         @OA\Schema(
     *             type="string"
     *         ),
     * 
     *    in="formData",
     *   required=true 
     *     ),
     *          @OA\Parameter(
     *         name="password",
     *         description="",
     *         @OA\Schema(
     *             type="string"
     *         ),
     * 
     *    in="formData",
     *   required=true 
     * ),
     * @OA\Response (response="200", description="Success"),
     * @OA\Response (response="404", description="Not Found"),
     * )
     */
    private function postUser($entityBody)
    {
        $response['content_type_header'] = 'Content-Type: application/json';

        $user = json_decode($entityBody);

        if ($this->userRepository->login($user->username,$user->password) == true) {
            $response['status_code_header'] = 'HTTP/1.1 200 OK';
            $result = array("Result" => "You are logged in!");
        } else {
            $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
            $result = array("Result" => "Incorrect password or username!");
        }

        $response['body'] = json_encode($result);
        return $response;
    }
    /**
     * @OA\Put(path="/api/v1/pages/register", tags={"Pages"},
     *   @OA\RequestBody(
     *       @OA\MediaType(
     *           mediaType="json",
     *           @OA\Schema(required={"password","username","firstname","lastname","gender","address","birthday","email"},
     *               @OA\Property(property="username", type="string"),
     *               @OA\Property(property="password", type="string"),
     *               @OA\Property(property="firstname", type="string"),
     *               @OA\Property(property="lastname", type="string"),
     *               @OA\Property(property="gender", type="string"),
     *               @OA\Property(property="birthday", type="string"),
     *               @OA\Property(property="email", type="string")
     *           )
     *       )
     *   ),
     * @OA\Response (response="200", description="Success"),
     * @OA\Response (response="404", description="Not Found"),
     * )
     */
    private function putUser($entityBody)
    {
        $response['status_code_header'] = 'HTTP/1.1 201 CREATED';
        $response['content_type_header'] = 'Content-Type: application/json';

        $user = json_decode($entityBody);

        $result = $this->userRepository->register(
            password_hash($user->password,PASSWORD_DEFAULT),
            $user->username,
            $user->firstname,
            $user->lastname,
            $user->gender,
            $user->address,
            $user->birthday,
            $user->email
        );

        if ($result == NULL)
            $result = array("Result" => "Username already exists!");
        else
            $result = array("Result" => "You are registered!");

        $response['body'] = json_encode($result);
        return $response;
    }

    /**
     * @OA\Patch(path="/api/v1/pages/register", tags={"Pages"},
     *   @OA\RequestBody(
     *       @OA\MediaType(
     *           mediaType="json",
     *           @OA\Schema(required={"password","username"},
     *               @OA\Property(property="username", type="string"),
     *               @OA\Property(property="password", type="string")
     *           )
     *       )
     *   ),
     * @OA\Response (response="200", description="Success"),
     * @OA\Response (response="404", description="Not Found"),
     * )
     */
    private function changePass($entityBody)
    {
        $response['status_code_header'] = 'HTTP/1.1 201 CREATED';
        $response['content_type_header'] = 'Content-Type: application/json';

        $user = json_decode($entityBody);

        $result = $this->userRepository->changePassword(
            $user->username,
            $user->password_old,
            $user->password_new
        );

        if ($result == NULL)
            $result = array("Result" => "Parola gresita sau parola coincide cu cea veche");
        else
            $result = array("Result" => "Parola schimbata!");

        $response['body'] = json_encode($result);
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

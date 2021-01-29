<?php

namespace Controller;
use Core\View;
use Model\Services\UserService;
//session_start();

class UserController
{
    const ID_MIN = 0;
    const CYPHER = "AES-128-CTR";
    const KEY = "Na1Lud1tP1|_|_|atN@PHP";
    const OPTIONS = 0;
    const IV = '8565825542115032';
    const MAX_PASSWORD = 32;

    public function add(): array
    {
        $result = [
            'success' => false
        ];

        $password = $_POST['Password'] ?? '';
        $name = $_POST['Username'] ?? '';
        $mail = $_POST['Email'] ?? '';

        $service = new UserService();

        if (
        $this->validateUserName($name)
        || $this->validateUserName($mail)){
            View::render('register');
            echo json_encode("Name or Mail is already in use.");
            return $result;
        }

        if ($this->validatePassword($password)){
            View::render('register');
            echo json_encode("Password is too long, try less than 32 character.");
            return $result;
        }

        $hash = openssl_encrypt($password, self::CYPHER, self::KEY, self::OPTIONS, self::IV);

        $result1 = $service->saveUser($name, $mail, $hash);

        //Session id added.
        $_SESSION["UserId"] = $result1['id'];
        View::redirect('index.php?target=user&action=loadMain');
        //echo json_encode($_SESSION["UserId"], JSON_PRETTY_PRINT);
    }

    public function authenticate(){
        $password = $_POST['Pass'] ?? '';
        $name = $_POST['Name'] ?? '';


        $service = new UserService();

        $hash = openssl_encrypt($password, self::CYPHER, self::KEY, self::OPTIONS, self::IV);

        $result = $service->getUserByNameAndPassword($name, $hash);
        if($result['success'] == false){
            View::render('login');
            echo json_encode("Wrong credentials");
        }else{
            //Session id added.
            $_SESSION["UserId"] = $result['id'];
            echo json_encode($_SESSION["UserId"], JSON_PRETTY_PRINT);
            View::redirect('index.php?target=user&action=loadMain');
        }

    }

    public function loadMain(){
        View::render('main');
    }

    public function getById($userId)
    {
        if (!$this->validateSize($userId)) {
            $result['msg'] = 'Invalid player id';
            return $result;
        }

        $service = new UserService();
        $result = $service->getUser($userId);

        return $result;
    }

    public function getAll()
    {
        $service = new UserService();
        $result = $service->getAllUsers();

    }

    private function validateSize($userId): bool
    {
        return $userId>=self::ID_MIN;
    }

    private function validateUserName($userName): bool
    {
        $service = new UserService();
        $result = $service->getUserByName($userName);

        return $result['success'] == 'false';
    }

    private function validatePassword($userPassword): bool
    {
        return strlen($userPassword) > self::MAX_PASSWORD;
    }
}
<?php

namespace Controller;
use Core\View;
use Model\Services\UserService;
//session_start();

class UserController
{
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
            $url = 'http://localhost/Diploma-Project-Math-Site/View/register.php';
            header( "Location: " . $url);

            setcookie('Status', "Mail or username already in use.", time()+3600);
            return $result;
        }

        if ($this->validatePassword($password)){
            $url = 'http://localhost/Diploma-Project-Math-Site/View/register.php';
            header( "Location: " . $url);

            setcookie('Status', "Password too long.", time()+3600);
            return $result;
        }

        $hash = openssl_encrypt($password, \PassInfo::CYPHER, \PassInfo::KEY, \PassInfo::OPTIONS, \PassInfo::IV);

        $result1 = $service->saveUser($name, $mail, $hash);

        //Session id added.
        $_SESSION["UserId"] = $result1['id'];
        setcookie('Status', 0, time()-3600);
        View::redirect('index.php?target=user&action=loadMain');
        //echo json_encode($_SESSION["UserId"], JSON_PRETTY_PRINT);
    }

    public function authenticate(){
        $password = $_POST['Pass'] ?? '';
        $name = $_POST['Name'] ?? '';


        $service = new UserService();

        $hash = openssl_encrypt($password, \PassInfo::CYPHER, \PassInfo::KEY, \PassInfo::OPTIONS, \PassInfo::IV);

        $result = $service->getUserByNameAndPassword($name, $hash);
        if($result['success'] == false){
            $url = 'http://localhost/Diploma-Project-Math-Site/View/login.php';
            header( "Location: " . $url);

            setcookie('Status', "Wrong credentials.", time()+3600);
        }else{
            //Session id added.
            $_SESSION["UserId"] = $result['id'];
            //echo json_encode($_SESSION["UserId"], JSON_PRETTY_PRINT);
            setcookie('Status', 0, time()-3600);
            View::redirect('index.php?target=user&action=loadMain');
        }

    }

    public function loadMain(){
        View::render('main');
    }

    public function loadLogin(){
        View::render('login');
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
        return $userId>=\PassInfo::ID_MIN;
    }

    private function validateUserName($userName): bool
    {
        $service = new UserService();
        $result = $service->getUserByName($userName);

        return $result['success'] == 'false';
    }

    private function validatePassword($userPassword): bool
    {
        return strlen($userPassword) > \PassInfo::MAX_PASSWORD;
    }
}
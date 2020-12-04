<?php


namespace Controller;
use Core\View;
use Model\Services\UserService;

class UserController
{
    const ID_MIN = 0;
    const CYPHER = "AES-128-CTR";
    const KEY = "Na1Lud1tP1|_|_|atN@PHP";
    const OPTIONS = 0;
    const IV = '8565825542115032';

    public function add(){
        $result = [
            'success' => false
        ];

        $password = $_POST['Password'] ?? '';
        $name = $_POST['Username'] ?? '';
        $mail = $_POST['Email'] ?? '';

        $hash = openssl_encrypt($password, self::CYPHER, self::KEY, self::OPTIONS, self::IV);

        $service = new UserService();
        $result1 = $service->saveUser($name, $mail, $hash);

        View::redirect('index.php?target=user&action=loadMain');
    }

    public function authenticate(){
        $password = $_POST['Pass'] ?? '';
        $name = $_POST['Name'] ?? '';
        unset($_COOKIE['MyUserId']);

        $service = new UserService();

        $hash = openssl_encrypt($password, self::CYPHER, self::KEY, self::OPTIONS, self::IV);

        $result = $service->getUserByNameAndPassword($name, $hash);
        if($result['success'] == false){
            View::render('login');
        }else{
            $cookieName = 'MyUserId';
            $date = time() + (60*60*24*7*2);
            setcookie($cookieName, $result['user'], $date, '/');

            View::redirect('index.php?target=user&action=loadMain');
        }

    }

    public function loadMain(){
        View::render('main');
    }

    public function reTry(){
        View::render('login');
    }

    public function getById($userId)
    {
        $result = [
            'success' => false
        ];

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

    private function validateSize($userId)
    {
        return $userId>=self::ID_MIN;
    }

}
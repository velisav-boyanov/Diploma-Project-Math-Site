<?php


namespace Controller;
use Core\View;
use Model\Services\UserService;

class UserController
{
    const ID_MIN = 0;

    public function add(){
        $result = [
            'success' => false
        ];

        $password = $_POST['Password'] ?? '';
        $name = $_POST['Username'] ?? '';
        $mail = $_POST['Email'] ?? '';

        //$hash = password_hash($password, PASSWORD_DEFAULT);

        $service = new UserService();
        $result1 = $service->saveUser($name, $mail, $password);

        View::redirect('index.php?target=user&action=loadMain');
    }

    public function authenticate(){
        $password = $_POST['Password'] ?? '';
        $name = $_POST['Name'] ?? '';
        unset($_COOKIE['MyUserId']);

        $service1 = new UserService();
        $service2 = new UserService();

        $result1 = $service1->getUserByName($name);
        $result2 = $service2->getUserByPassword($password);

        if(($result1['success'] ==  true)
                && ($result2['success'] == true) &&
            ($result1['user'] == $result2['user'])){
            $cookieName = 'MyUserId';
            $date = time() + (60*60*24*7*2);
            setcookie($cookieName, $result2['user'], $date);

            View::redirect('index.php?target=user&action=loadMain');

        }else{
            View::redirect('index.php?target=user&action=reTry');
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

    public function getByPassword($userPassword)
    {
        //$hash = password_hash($userPassword, PASSWORD_DEFAULT);

        $service = new UserService();
        $result = $service->getUser($userPassword);

        return $result;
    }

    public function getByName($userName)
    {
        $service = new UserService();
        $result = $service->getUser($userName);

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
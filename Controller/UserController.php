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

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $service = new UserService();
        $result1 = $service->saveUser($name, $mail, $hash);

        View::redirect('index.php?target=user&action=loadMain');
    }

    public function loadMain(){
        View::render('main');
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
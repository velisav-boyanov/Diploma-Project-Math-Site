<?php


namespace Controller;
use Core\View;
use Model\Services\PlayerService;

class UserController
{
    const MAX_USER_PASSWORD = 32;
    const MAX_USER_NAME = 30;

    public function add(){
        $result = [
            'success' => false
        ];

        $password = $_POST['Password'] ?? '';
        $name = $POST['Username'] ?? '';

        if(
            !$this->validatePasswordLength($password)
            || !$this->validateNameLength($name)
        )
        {
            $result['msg'] = 'Invalid player parameters';

            return $result;
        }

        $service = new PlayerService();
        $result1 = $service->savePlayer($password, $name);

        View::redirect('main.php');
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
        $result = $service->getAllUser();

    }
}
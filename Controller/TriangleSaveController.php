<?php


namespace Controller;

use Core\View;
use Model\Services\SaveService;
use Model\Services\UserService;

class TriangleSaveController
{
    public function add($argument)
    {
        $result = [
            'success' => false
        ];

        $given = $_COOKIE['Given'] ?? '';
        $how = $_COOKIE['HowWasItSolved'] ?? '';
        $param = $_COOKIE['Parameters'] ?? '';
        $userId = $_SESSION['UserId'] ?? '';
        $type = "Triangle";
        $isBlog = $argument;

        //unset doesn't delete the cookie from storage
        setcookie('Blog', '', 1);
        $service = new SaveService();

        $result1 = $service->saveTriangle($type, $given, $how, $param, $userId, $isBlog);
        View::redirect('index.php?target=triangleSave&action=renderSaves');
    }

    public function addCustom(){
        $result = [
            'success' => false
        ];

        $given = $_POST['Given'] ?? '';
        $how = '';
        $param = $_POST['Find'] ?? '';
        $userId = $_SESSION['UserId'] ?? '';
        $type = $_POST['options'];
        $isBlog = (int)$_POST['blog'];

        $service = new SaveService();

        $result1 = $service->saveTriangle($type, $given, $how, $param, $userId, $isBlog);
        View::redirect('index.php?target=triangleSave&action=renderSaves');
    }

    public function renderSaves(){
        View::render('user');
    }

    public function getByUserId($userId): array
    {
        if (!$this->validateSize($userId)) {
            $result['msg'] = 'Invalid user id';
            return $result;
        }

        $service = new SaveService();
        $result = $service->getTriangleByUserId($userId);
        return $result;
    }

    public function getBlogs(): array
    {
        $service = new SaveService();
        return $service->getBlogs();
    }

    public function getById($triangleId): array
    {
        $result = [
            'success' => false
        ];

        if (!$this->validateSize($triangleId)) {
            $result['msg'] = 'Invalid triangle id';
            return $result;
        }

        $service = new SaveService();
        $result = $service->getTriangle($triangleId);

        return $result;
    }

    public function validateSize($number){
        return $number >= 0;
    }

}

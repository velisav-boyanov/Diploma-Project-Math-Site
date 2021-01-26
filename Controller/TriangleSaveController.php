<?php


namespace Controller;

use Core\View;
use Model\Services\SaveService;
use Model\Services\UserService;

class TriangleSaveController
{
    public function add()
    {
        $result = [
            'success' => false
        ];

        $given = $_COOKIE['Given'] ?? '';
        $how = $_COOKIE['HowWasItSolved'] ?? '';
        $param = $_COOKIE['Parameters'] ?? '';
        $userId = $_SESSION['UserId'] ?? '';
        $type = "Triangle";

        $service = new SaveService();

        $result1 = $service->saveTriangle($type, $given, $how, $param, $userId);
        View::redirect('index.php?target=triangleSave&action=renderSaves');
    }

    public function renderSaves(){
        View::render('user');
    }

    public function getByUserId($userId)
    {
        if (!$this->validateSize($userId)) {
            $result['msg'] = 'Invalid user id';
            return $result;
        }

        $service = new SaveService();
        $result = $service->getTriangleByUserId($userId);
        return $result;
    }

    public function getById($triangleId)
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

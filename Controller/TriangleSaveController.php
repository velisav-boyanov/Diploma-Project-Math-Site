<?php


namespace Controller;

use Core\View;
use Model\Services\TriangleSaveService;
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

        $service = new TriangleSaveService();

        $result1 = $service->saveTriangle($given, $how, $param, $userId);
    }

    public function getByUserId($userId)
    {
        $result = [
            'success' => false
        ];

        if (!$this->validateSize($userId)) {
            $result['msg'] = 'Invalid user id';
            return $result;
        }

        $service = new TriangleSaveService();
        $result = $service->getTriangle($userId);

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

        $service = new TriangleSaveService();
        $result = $service->getTriangle($triangleId);

        return $result;
    }

    public function validateSize($number){
        return $number >= 0;
    }

}

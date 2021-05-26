<?php


namespace Controller;
use Core\View;
use Model\Repository\TestRepository;
use Model\Services\SaveService;
use Model\Services\TestService;
use Dompdf\Dompdf;

class TestController
{
    public function add()
    {
        ob_start();
        $result = [
            'success' => false
        ];

        $userId = $_SESSION['UserId'] ?? '';
        $exercises = $_COOKIE['Exercises'] ?? '';

        $service = new TestService();

        $saveService = new SaveService();
        $saveService->cleanOldTests();

        $result1 = $service->saveTest((int)$userId, $exercises);
        setcookie("Exercises", json_encode((array) null), time()+3600);

        $_SESSION['TestId'] = $result1['id'];

        $this->loadTest();
    }

    public function getById($testId): array
    {
        $result = [
            'success' => false
        ];

        $service = new TestService();
        $result = $service->getById($testId);

        return $result;
    }

    public function loadTest()
    {
        View::render('exam');
    }

}
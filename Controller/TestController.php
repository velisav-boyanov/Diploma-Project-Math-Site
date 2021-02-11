<?php


namespace Controller;
use Core\View;
use Model\Repository\TestRepository;
use Model\Services\TestService;

class TestController
{
    public function add(): array
    {
        $result = [
            'success' => false
        ];

        $userId = $_SESSION['UserId'] ?? '';
        $exercises = $_POST['Username'] ?? '';

        $service = new TestService();

        $result1 = $service->saveTest($userId, $exercises);

        View::redirect('index.php?target=user&action=loadMain');

    }

    public function loadTest(){
        View::render('tests');
    }

}
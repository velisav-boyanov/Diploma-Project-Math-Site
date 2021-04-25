<?php


namespace Controller;

use Core\View;
use Model\Services\CommentService;
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
        $param = json_encode(array_map('strval', json_decode($_COOKIE['Parameters']))) ?? '';
        $userId = $_SESSION['UserId'] ?? '';
        $type = "Triangle";
        $isBlog = $argument;

        //unset doesn't delete the cookie from storage
        setcookie('Blog', '', 1);
        $service = new SaveService();

        $result1 = $service->saveTriangle($type, $given, $how, $param, $userId, $isBlog);
        View::redirect('index.php?target=triangleSave&action=renderSaves');
    }

    ///////////////////////////////
    public function generateSimilar(): bool
    {
        $triangle = new TriangleController();
        $postId = $_COOKIE['PostId'];
        $post = $this->getById($postId);
        $givenCount = json_decode($post['$post']['triangle']['Given']);
        $givenValues = json_decode($post['$post']['triangle']['Parameters']);
        $generatedValues = (array) null;
        $sign = rand(0, 1) == 1;
        $sign = $sign ? 1 : -1;
        $coefficient = $sign*mt_rand(0, 20)/100;

        //THIS NEEDS A REWORK
        foreach($givenCount as $i){
            $generatedValues[$i] = abs($givenValues[$givenCount[$i]] - $givenValues[$givenCount[$i]]*$coefficient);
        }
        $_SESSION['Given'] = json_encode($generatedValues);
        $_SESSION['Generating'] = 1;
        $triangle->fillTriangle();
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

    public function remove(): array
    {
        $result = [
            'success' => false
        ];

        $postId = $_COOKIE["PostId"];

        $controllerComment = new CommentController();
        $serviceComment = new CommentService();
        $commentsOnPost = $controllerComment->getByPostId($postId);
        foreach($commentsOnPost as $i) {
            $serviceComment->removeComment($i['Id']);
        }

        if (!$this->validateSize($postId)) {
            $result['msg'] = 'Invalid comment id';
            return $result;
        }
        $serviceSave = new SaveService();
        $serviceSave->removePost($postId);
        View::redirect('index.php?target=triangleSave&action=renderSaves');
    }

    public function getBlogs(): array
    {
        $service = new SaveService();
        return $service->getBlogs();
    }

    public function markAsUnAdded(): void
    {
        $service = new SaveService();
        $service->markAsAdded($_COOKIE['PostId'], 0);
    }

    public function addToSaveArray(){
        $exercises = json_decode($_COOKIE['Exercises']) ?? (array) null;
        array_push($exercises, $_COOKIE['PostId']);
        $exercises = json_encode($exercises);
        $service = new SaveService();
        $service->markAsAdded($_COOKIE['PostId'], 1);
        setcookie('Exercises', $exercises, time()+3600);
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
        $result['$post'] = $service->getTriangle($triangleId);

        return $result;
    }

    public function validateSize($number): bool
    {
        return $number >= 0;
    }

}

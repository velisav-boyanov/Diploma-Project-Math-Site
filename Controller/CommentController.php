<?php


namespace Controller;
use Core\View;
use Model\Services\CommentService;


class CommentController
{
    public function add()
    {
        $result = [
            'success' => false
        ];

        $user = new UserController();
        $userName = $user->getById($_SESSION['UserId']);

        $userId = $_SESSION['UserId'] ?? '';
        $postId = $_COOKIE['HowWasItSolved'] ?? '';
        $username = $message['user']['Username'] ?? '';
        $message = $_COOKIE['Message'] ?? '';

        $service = new CommentService();

        $result1 = $service->saveComment($userId, $postId, $username, $message);
        View::redirect('index.php?target=triangleSave&action=renderSaves');
    }

    public function renderSaves(){
        View::render('blog');
    }

    public function renderBlogs(){
        View::render('blogs');
    }

    public function getByCommentId($commentId): array
    {
        if (!$this->validateSize($commentId)) {
            $result['msg'] = 'Invalid comment id';
            return $result;
        }

        $service = new CommentService();
        $result = $service->getComment($commentId);
        return $result;
    }

    public function getByPostId($userId): array
    {
        $result = [
            'success' => false
        ];

        if (!$this->validateSize($userId)) {
            $result['msg'] = 'Invalid user id';
            return $result;
        }

        $service = new CommentService();
        $result = $service->getCommentByPostId($userId);

        return $result;
    }

    public function getByParentId($parentId): array
    {
        $result = [
            'success' => false
        ];

        if (!$this->validateSize($parentId)) {
            $result['msg'] = 'Invalid parent id';
            return $result;
        }

        $service = new CommentService();
        $result = $service->getCommentByParentCommentId($parentId);

        return $result;
    }

    public function validateSize($number): bool
    {
        return $number >= 0;
    }
}
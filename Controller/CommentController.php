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
        $userName = $user->getById($_SESSION['UserId']['Id']);

        $userId = $_SESSION['UserId']['Id'] ?? $_SESSION['UserId'];
        $postId = $_COOKIE['PostId'] ?? '';
        $username = $userName['user']['Username'];
        $message = $_POST['Message'] ?? '';
        echo json_encode($_SESSION['UserId']['Id']);
        $service = new CommentService();

        $result1 = $service->saveComment($userId, $postId, $username, $message);
        View::redirect('index.php?target=comment&action=renderBlog');
    }

    public function renderBlog(){
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

    public function getByPostId($postId): array
    {
        $result = [
            'success' => false
        ];

        if (!$this->validateSize($postId)) {
            $result['msg'] = 'Invalid post id';
            return $result;
        }

        $service = new CommentService();
        $result = $service->getCommentByPostId($postId);

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